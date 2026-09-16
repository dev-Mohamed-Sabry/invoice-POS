<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'section_name' => ['required', 'unique:sections,section_name', 'max:255'],
                'section_description' => ['nullable', 'min:4'],
            ],
            [
                'section_name.required' => 'إسم القسم مطلوب.',
                'section_name.unique' => 'إسم القسم موجود بالفعل.',
                'section_name.max' => 'إسم القسم يجب ألا يتجاوز 255 حرفًا.',
                'section_description.min' => 'الوصف يجب ألا يقل عن 4 أحرف.',
            ]
        );

        try {
            sections::create([
                'section_name' => $request->section_name,
                'section_description' => $request->section_description ?: 'لا يوجد',
                'created_by' => Auth::user()->name,
            ]);

            return redirect()->back()->with('success', 'تم إضافة القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة القسم');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sections $section)
    {
        $request->validate([
            'section_name' => 'required|max:255',
            'section_description' => 'nullable|min:4',
        ]);

        $section->update([
            'section_name' => $request->section_name,
            'section_description' => $request->section_description,
        ]);

        return redirect()->back()
            ->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sections $section)
    {
        $section->delete();

        return back()->with('success', 'تم حذف القسم بنجاح');
    }
}
