<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('usertype', 'employee')
            ->latest()
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'attachment_front' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'attachment_back'  => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
            'is_active' => ['required', 'boolean'],
        ]);

        try {
            $attachmentFront = null;
            $attachmentBack  = null;

            if ($request->hasFile('attachment_front')) {
                $attachmentFront = $request
                    ->file('attachment_front')
                    ->store('employees/id-cards', 'public');
            }

            if ($request->hasFile('attachment_back')) {
                $attachmentBack = $request
                    ->file('attachment_back')
                    ->store('employees/id-cards', 'public');
            }

            User::create([
                'name'             => $request->name,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'job_title'        => $request->job_title,

                'attachment_front' => $attachmentFront,
                'attachment_back'  => $attachmentBack,

                'password'         => $request->password,
                'is_active'        => $request->is_active,
                'created_by'        => Auth::user()->name,
                'usertype'         => 'employee',
            ]);
            return redirect()
                ->route('employees.index')
                ->with('success', 'تم إضافة الموظف بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ ما');
        }
    }

    public function show(User $employee)
    {

        return view('employees.show', compact('employee'));
    }

    public function edit(User $employee)
    {

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $employee->id,
            ],

            'phone' => ['nullable', 'string', 'max:255'],

            'job_title' => ['nullable', 'string', 'max:255'],

            'attachment_front' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'attachment_back' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'password' => ['nullable', 'confirmed', 'min:8'],

            'password_confirmation' => ['nullable'],

            'is_active' => ['required', 'boolean'],
        ]);

        try {

            /*
        |--------------------------------------------------------------------------
        | Employee ID - Front
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('attachment_front')) {

                $oldFrontImage = $employee->attachment_front;

                $employee->attachment_front = $request
                    ->file('attachment_front')
                    ->store('employees/id-cards', 'public');

                if ($oldFrontImage) {
                    Storage::disk('public')->delete($oldFrontImage);
                }
            }


            /*
        |--------------------------------------------------------------------------
        | Employee ID - Back
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('attachment_back')) {

                $oldBackImage = $employee->attachment_back;

                $employee->attachment_back = $request
                    ->file('attachment_back')
                    ->store('employees/id-cards', 'public');

                if ($oldBackImage) {
                    Storage::disk('public')->delete($oldBackImage);
                }
            }


            /*
        |--------------------------------------------------------------------------
        | Basic Information
        |--------------------------------------------------------------------------
        */

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->job_title = $request->job_title;
            $employee->is_active = $request->is_active;


            /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

            if ($request->filled('password')) {
                $employee->password = $request->password;
            }


            $employee->save();


            return redirect()
                ->route('employees.show', $employee->id)
                ->with('success', 'تم تعديل بيانات الموظف بنجاح');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تعديل بيانات الموظف: ' . $e->getMessage());
        }
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return back()->with('success', 'تم حذف الموظف بنجاح');
    }
}
