<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                       => 'required|string|max:255',
            'phone'                      => 'required|string|max:20',
            'secondary_phone'            => 'nullable|string|max:20',

            'national_id'                => 'required|string|max:20|unique:customers,national_id',
            'national_id_front'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'national_id_back'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'date_of_birth'              => 'nullable|date',

            'address'                    => 'required|string',

            'job'                        => 'nullable|string|max:255',
            'workplace'                  => 'nullable|string|max:255',

            'emergency_contact_name'     => 'nullable|string|max:255',
            'emergency_contact_phone'    => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:255',

            'additional_data'            => 'nullable|string',
            'notes'                      => 'nullable|string',

            'is_active'                  => 'nullable|boolean',
        ]);

        try {

            $nationalIdFront = $request->hasFile('national_id_front')
                ? $request->file('national_id_front')->store('customers/id-cards', 'public')
                : null;

            $nationalIdBack = $request->hasFile('national_id_back')
                ? $request->file('national_id_back')->store('customers/id-cards', 'public')
                : null;

            Customer::create([
                'name'                         => $request->name,
                'phone'                        => $request->phone,
                'secondary_phone'              => $request->secondary_phone,
                'national_id'                   => $request->national_id,
                'national_id_front'             => $nationalIdFront,
                'national_id_back'              => $nationalIdBack,
                'date_of_birth'                 => $request->date_of_birth,
                'address'                       => $request->address,
                'job'                           => $request->job,
                'workplace'                     => $request->workplace,
                'emergency_contact_name'        => $request->emergency_contact_name,
                'emergency_contact_phone'       => $request->emergency_contact_phone,
                'emergency_contact_relation'    => $request->emergency_contact_relation,
                'additional_data'               => $request->additional_data,
                'notes'                         => $request->notes,
                'is_active'                     => $request->is_active,
                'created_by'                    => Auth::user()->name,
            ]);

            return redirect()
                ->route('customers.index')
                ->with('success', 'تم إضافة العميل بنجاح');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إضافة العميل: ' . $e->getMessage());
        }
    }

    public function show(Customer $customer)
    {

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'                       => 'required|string|max:255',
            'phone'                      => 'required|string|max:20',
            'secondary_phone'            => 'nullable|string|max:20',

            'national_id'                => 'required|string|max:20|unique:customers,national_id,' . $customer->id,
            'national_id_front'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'national_id_back'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'date_of_birth'              => 'nullable|date',

            'address'                    => 'required|string',

            'job'                        => 'nullable|string|max:255',
            'workplace'                 => 'nullable|string|max:255',

            'emergency_contact_name'     => 'nullable|string|max:255',
            'emergency_contact_phone'    => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:255',

            'additional_data'            => 'nullable|string',
            'notes'                      => 'nullable|string',

            'is_active'                  => 'nullable|boolean',
        ]);

        try {

            // Update front ID image
            if ($request->hasFile('national_id_front')) {

                $oldFrontImage = $customer->national_id_front;

                $customer->national_id_front = $request
                    ->file('national_id_front')
                    ->store('customers/id-cards', 'public');

                if ($oldFrontImage) {
                    Storage::disk('public')->delete($oldFrontImage);
                }
            }

            // Update back ID image
            if ($request->hasFile('national_id_back')) {

                $oldBackImage = $customer->national_id_back;

                $customer->national_id_back = $request
                    ->file('national_id_back')
                    ->store('customers/id-cards', 'public');

                if ($oldBackImage) {
                    Storage::disk('public')->delete($oldBackImage);
                }
            }

            $customer->name                       = $request->name;
            $customer->phone                      = $request->phone;
            $customer->secondary_phone            = $request->secondary_phone;
            $customer->national_id                = $request->national_id;
            $customer->date_of_birth              = $request->date_of_birth;
            $customer->address                    = $request->address;
            $customer->job                        = $request->job;
            $customer->workplace                  = $request->workplace;
            $customer->emergency_contact_name     = $request->emergency_contact_name;
            $customer->emergency_contact_phone    = $request->emergency_contact_phone;
            $customer->emergency_contact_relation = $request->emergency_contact_relation;
            $customer->additional_data            = $request->additional_data;
            $customer->notes                      = $request->notes;
            $customer->is_active                  = $request->is_active;

            $customer->save();

            return redirect()
                ->route('customers.index')
                ->with('success', 'تم تعديل بيانات العميل بنجاح');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تعديل بيانات العميل: ' . $e->getMessage());
        }
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('success', 'تم حذف العميل بنجاح');
    }
}
