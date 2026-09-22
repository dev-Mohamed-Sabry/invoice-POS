<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all("id", "section_name");

        return view('invoices.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'invoice_number' => ['required', 'unique:invoices,invoice_number'],
                'invoice_Date' => ['required', 'date'],
                'Due_date' => ['required', 'date', 'after_or_equal:invoice_Date'],

                'Section' => ['required', 'exists:sections,id'],
                'product' => ['required', 'exists:products,id'],

                'Amount_collection' => ['required', 'numeric', 'min:0'],
                'Commission_Rate' => ['required', 'numeric', 'min:0', 'max:100'],
                'Rate_VAT' => ['required', 'numeric', 'min:0', 'max:100'],

                'note' => ['nullable'],
                'image' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:2048'],
            ],
            [
                'invoice_number.required' => 'رقم الفاتورة مطلوب.',
                'invoice_number.unique' => 'رقم الفاتورة موجود بالفعل.',

                'invoice_Date.required' => 'تاريخ الفاتورة مطلوب.',
                'Due_date.required' => 'تاريخ الاستحقاق مطلوب.',
                'Due_date.after_or_equal' => 'تاريخ الاستحقاق يجب أن يكون بعد أو يساوي تاريخ الفاتورة.',

                'Section.required' => 'يجب اختيار البنك.',
                'Section.exists' => 'البنك المحدد غير موجود.',

                'product.required' => 'يجب اختيار الخدمة.',
                'product.exists' => 'الخدمة المحددة غير موجودة.',

                'Amount_collection.required' => 'مبلغ التحصيل مطلوب.',
                'Amount_collection.numeric' => 'مبلغ التحصيل يجب أن يكون رقمًا.',

                'Commission_Rate.required' => 'نسبة العمولة مطلوبة.',
                'Commission_Rate.numeric' => 'نسبة العمولة يجب أن تكون رقمًا.',
                'Commission_Rate.max' => 'نسبة العمولة لا يمكن أن تتجاوز 100%.',

                'Rate_VAT.required' => 'نسبة الضريبة مطلوبة.',
                'Rate_VAT.numeric' => 'نسبة الضريبة يجب أن تكون رقمًا.',
                'Rate_VAT.max' => 'نسبة الضريبة لا يمكن أن تتجاوز 100%.',

                'image.file' => 'الملف المرفق غير صالح.',
                'image.mimes' => 'المرفق يجب أن يكون بصيغة PDF أو JPG أو JPEG أو PNG أو WEBP.',
                'image.max' => 'حجم المرفق يجب ألا يتجاوز 2 ميجابايت.',
            ]
        );

        try {

            $amountCollection = (float) $request->Amount_collection;
            $commissionRate = (float) $request->Commission_Rate;
            $rateVAT = (float) $request->Rate_VAT;

            // مبلغ العمولة الأساسي
            $baseCommission = $amountCollection * $commissionRate / 100;

            // قيمة ضريبة القيمة المضافة
            $valueVAT = $baseCommission * $rateVAT / 100;

            // مبلغ العمولة شامل الضريبة
            $amountCommission = $baseCommission + $valueVAT;

            // إجمالي العمولة شامل الضريبة
            $total = $amountCommission;

            $invoice = new Invoice();

            $invoice->invoice_number = $request->invoice_number;
            $invoice->invoice_date = $request->invoice_Date;
            $invoice->due_date = $request->Due_date;

            // العلاقات
            $invoice->section_id = $request->Section;
            $invoice->product_id = $request->product;

            // المبالغ
            $invoice->amount_collection = $amountCollection;
            $invoice->commission_rate = $commissionRate;
            $invoice->amount_commission = $amountCommission;

            $invoice->rate_vat = $rateVAT;
            $invoice->value_vat = $valueVAT;
            $invoice->total = $total;

            $invoice->note = $request->note;

            // المرفق
            if ($request->hasFile('image')) {
                $invoice->image = $request->file('image')
                    ->store('invoices', 'public');
            }

            $invoice->save();

            return redirect()
                ->back()
                ->with('success', 'تم إضافة الفاتورة بنجاح');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit() {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoices)
    {
        //
    }

    public function getProductsBySection(Section $section)
    {
        $products = $section->products()
            ->select('id', 'product_name')
            ->get();
        return response()->json($products);
    }
}
