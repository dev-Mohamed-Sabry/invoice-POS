<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('section')->get();
        $sections = Section::select('id', 'section_name')->get();
        return view('Products.index', compact('products', 'sections'));
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
        // dd();
        $request->validate(
            [
                'product_name' => ['required', 'unique:products,product_name', 'max:255'],
                'product_description' => ['nullable', 'min:4'],
                'section_id' => ['required', 'exists:sections,id'],
            ],
            [
                'product_name.required' => 'إسم المنتج مطلوب.',
                'product_name.unique' => 'إسم المنتج موجود بالفعل.',
                'product_name.max' => 'إسم المنتج يجب ألا يتجاوز 255 حرفًا.',
                'product_description.min' => 'الوصف يجب ألا يقل عن 4 أحرف.',
            ]
        );

        try {
            Product::create([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description ?: 'لا يوجد',
                'section_id' => $request->section_id,
            ]);

            return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المنتج');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_description' => 'nullable|min:4',
            'section_id' => ['required', 'exists:sections,id'],
        ]);

        $product->update([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description ?: 'لا يوجد',
            'section_id' => $request->section_id,

        ]);

        return redirect()->back()
            ->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->delete();

        return back()->with('success', 'تم حذف المنتج بنجاح');
    }
}
