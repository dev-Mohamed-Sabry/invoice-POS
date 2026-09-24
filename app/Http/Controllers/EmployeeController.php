<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
            'is_active' => ['required', 'boolean'],
        ]);

        try {
            $attachment = null;

            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment')->store('employees', 'public');
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'job_title' => $request->job_title,
                'attachment' => $attachment,
                'password' => $request->password,
                'is_active' => $request->is_active,
                'usertype' => 'employee',
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

    public function edit()
    {
        //
    }
    public function update()
    {
        //
    }
    public function destroy()
    {
        //
    }
}
