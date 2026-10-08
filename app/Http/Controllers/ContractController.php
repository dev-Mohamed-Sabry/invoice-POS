<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    public function index()
    {
        $contract = Contract::all();
        return view('contracts.index', compact("contract"));
    }

    public function create()
    {
        $sections = Section::orderBy('section_name')->get();
        return view('contracts.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_number' => 'nullable|string|max:255|unique:contracts,contract_number',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'sale_type' => 'required|in:cash,installment',
            'contract_date' => 'required|date',

            'commission_rate' => 'nullable|numeric|min:0|max:100',

            'down_payment' => 'nullable|numeric|min:0',

            'grace_days' => 'nullable|integer|min:0',
            'late_fee_type' => 'nullable|in:fixed,percentage',
            'late_fee_value' => 'nullable|numeric|min:0',

            'notes' => 'nullable|string',

            // بنود العقد
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.interest_rate' => 'nullable|numeric|min:0|max:100',
            'items.*.administrative_fees' => 'nullable|numeric|min:0',
            'items.*.installment_months' => 'nullable|integer|min:0',
        ]);

        if ($validated['sale_type'] === 'cash') {
            $validated['down_payment'] = 0;
        }

        if ($validated['late_fee_type'] === null) {
            $validated['late_fee_value'] = null;
        }

        if (
            $validated['late_fee_type'] === 'percentage' &&
            ($validated['late_fee_value'] ?? 0) > 100
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'late_fee_value' => 'نسبة غرامة التأخير لا يمكن أن تتجاوز 100%.',
                ]);
        }

        $contract = DB::transaction(function () use ($validated) {

            $cashTotal = 0;
            $installmentTotal = 0;
            $commissionBase = 0;
            $contractMonths = 0;

            $contractNumber = $validated['contract_number']
                ?: 'CNT-' . now()->format('YmdHis') . '-' . random_int(100, 999);

            $contract = Contract::create([
                'contract_number' => $contractNumber,
                'customer_id' => $validated['customer_id'],
                'user_id' => $validated['user_id'],
                'sale_type' => $validated['sale_type'],
                'contract_date' => $validated['contract_date'],
                'contract_months' => 0,

                'commission_rate' => $validated['commission_rate'] ?? 0,
                'commission_amount' => 0,

                'cash_total' => 0,
                'installment_total' => 0,
                'down_payment' => $validated['down_payment'] ?? 0,

                'grace_days' => $validated['grace_days'] ?? 0,
                'late_fee_type' => $validated['late_fee_type'] ?? null,
                'late_fee_value' => $validated['late_fee_value'] ?? null,

                'status' => 'active',

                'notes' => $validated['notes'] ?? null,
                'created_by' => Auth::user()->name,
            ]);

            foreach ($validated['items'] as $item) {

                $product = Product::findOrFail($item['product_id']);

                $quantity = (int) $item['quantity'];

                /*
             * product_price هو السعر النهائي للبيع النقدي
             * ويكون شامل VAT إذا كان المنتج خاضعًا لها.
             */
                $cashProductPrice = (float) $product->product_price;

                $cashItemTotal = round(
                    $cashProductPrice * $quantity,
                    2
                );

                /*
             * الفائدة تطبق فقط على البيع بالتقسيط.
             */
                $interestRate = (float) ($item['interest_rate'] ?? 0);

                if ($validated['sale_type'] === 'cash') {
                    $interestRate = 0;
                }

                $interestAmount = round(
                    $cashItemTotal * ($interestRate / 100),
                    2
                );

                /*
             * المصاريف الإدارية.
             */
                $administrativeFees = (float) (
                    $item['administrative_fees'] ?? 0
                );

                /*
             * إجمالي ما يدفعه العميل لهذا البند.
             *
             * سعر المنتج بالفعل سعر نهائي شامل VAT إن وجدت،
             * لذلك لا نضيف VAT مرة أخرى.
             */
                $itemInstallmentTotal = round(
                    $cashItemTotal
                        + $interestAmount
                        + $administrativeFees,
                    2
                );

                $installmentMonths = (int) (
                    $item['installment_months'] ?? 0
                );

                if ($validated['sale_type'] === 'cash') {
                    $installmentMonths = 0;
                }

                $cashTotal += $cashItemTotal;

                $installmentTotal += $itemInstallmentTotal;

                /*
             * أساس العمولة:
             * سعر المنتج + الفائدة + المصاريف الإدارية
             *
             * ولا توجد VAT إضافية نضيفها هنا.
             */
                $commissionBase +=
                    $cashItemTotal
                    + $interestAmount
                    + $administrativeFees;

                $contractMonths = max(
                    $contractMonths,
                    $installmentMonths
                );

                $contract->contractItems()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'quantity' => $quantity,

                    'cash_product_price' => $cashProductPrice,
                    'cash_total' => $cashItemTotal,

                    'interest_rate' => $interestRate,
                    'interest_amount' => $interestAmount,

                    'administrative_fees' => $administrativeFees,

                    'installment_total' => $itemInstallmentTotal,
                    'installment_months' => $installmentMonths,
                ]);
            }

            $commissionAmount = round(
                $commissionBase * (
                    (float) ($validated['commission_rate'] ?? 0) / 100
                ),
                2
            );

            if (
                $validated['sale_type'] === 'installment' &&
                ($validated['down_payment'] ?? 0) > $installmentTotal
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'down_payment' => 'الدفعة المقدمة لا يمكن أن تتجاوز إجمالي العقد.',
                ]);
            }

            $contract->update([
                'contract_months' => $contractMonths,
                'commission_amount' => $commissionAmount,
                'cash_total' => round($cashTotal, 2),
                'installment_total' => round($installmentTotal, 2),
            ]);

            return $contract;
        });

        return redirect()
            ->route('contracts.index')
            ->with('success', 'تم إنشاء العقد بنجاح.');
    }













    public function searchCustomers(Request $request)
    {
        if ($request->filled('id')) {

            $customer = Customer::query()
                ->select('id', 'name', 'phone')
                ->find($request->id);

            if (!$customer) {
                return response()->json([]);
            }

            return response()->json([
                [
                    'id' => $customer->id,
                    'text' => $customer->name . ' - ' . $customer->phone,
                ]
            ]);
        }

        $search = $request->get('q');

        $customers = Customer::query()
            ->where('is_active', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->select('id', 'name', 'phone')
            ->orderBy('name')
            ->limit(20)
            ->get();

        return response()->json(
            $customers->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'text' => $customer->name . ' - ' . $customer->phone,
                ];
            })
        );
    }


    public function searchUsers(Request $request)
    {
        if ($request->filled('id')) {

            $user = User::query()
                ->where('is_active', true)
                ->where('usertype', 'employee')
                ->select('id', 'name')
                ->find($request->id);

            if (!$user) {
                return response()->json([]);
            }

            return response()->json([
                [
                    'id' => $user->id,
                    'text' => $user->name,
                ]
            ]);
        }

        $search = $request->get('q');

        $users = User::query()
            ->where('is_active', true)
            ->where('usertype', 'employee')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(20)
            ->get();

        return response()->json(
            $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->name,
                ];
            })
        );
    }
}
