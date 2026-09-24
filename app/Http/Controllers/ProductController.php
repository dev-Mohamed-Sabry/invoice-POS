<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $request->validate(
            [
                'product_name' => ['required', 'unique:products,product_name', 'max:255'],
                'product_price' => ['required', 'numeric', 'min:0'],
                'product_description' => ['nullable', 'min:4'],
                'product_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
                'section_id' => ['required', 'exists:sections,id'],
            ],
            [
                'product_name.required' => 'اسم المنتج مطلوب.',
                'product_name.unique' => 'اسم المنتج موجود بالفعل.',
                'product_name.max' => 'اسم المنتج يجب ألا يتجاوز 255 حرفًا.',

                'product_price.required' => 'سعر المنتج مطلوب.',
                'product_price.numeric' => 'سعر المنتج يجب أن يكون رقمًا.',
                'product_price.min' => 'سعر المنتج لا يمكن أن يكون أقل من صفر.',

                'product_description.min' => 'الوصف يجب ألا يقل عن 4 أحرف.',

                'product_image.image' => 'الملف المرفق يجب أن يكون صورة.',
                'product_image.mimes' => 'صورة المنتج يجب أن تكون بصيغة JPG أو JPEG أو PNG أو WEBP.',
                'product_image.max' => 'حجم صورة المنتج يجب ألا يتجاوز 2 ميجابايت.',

                'section_id.required' => 'يجب اختيار القسم.',
                'section_id.exists' => 'القسم المحدد غير موجود.',
            ]
        );

        try {

            $productImage = null;

            if ($request->hasFile('product_image')) {
                $productImage = $request->file('product_image')
                    ->store('products', 'public');
            }

            Product::create([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description ?: 'لا يوجد',
                'product_image' => $productImage,
                'section_id' => $request->section_id,
                'created_by' => Auth::user()->name,
            ]);

            return redirect()
                ->back()
                ->with('success', 'تم إضافة المنتج بنجاح');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'حدث خطأ أثناء إضافة المنتج');
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
        $request->validate(
            [
                'product_name' => [
                    'required',
                    'max:255',
                    'unique:products,product_name,' . $product->id,
                ],
                'product_price' => ['required', 'numeric', 'min:0'],
                'product_description' => ['nullable', 'min:4'],
                'product_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
                'section_id' => ['required', 'exists:sections,id'],
            ],
            [
                'product_name.required' => 'اسم المنتج مطلوب.',
                'product_name.unique' => 'اسم المنتج موجود بالفعل.',
                'product_name.max' => 'اسم المنتج يجب ألا يتجاوز 255 حرفًا.',

                'product_price.required' => 'سعر المنتج مطلوب.',
                'product_price.numeric' => 'سعر المنتج يجب أن يكون رقمًا.',
                'product_price.min' => 'سعر المنتج لا يمكن أن يكون أقل من صفر.',

                'product_description.min' => 'الوصف يجب ألا يقل عن 4 أحرف.',

                'product_image.image' => 'الملف المرفق يجب أن يكون صورة.',
                'product_image.mimes' => 'صورة المنتج يجب أن تكون بصيغة JPG أو JPEG أو PNG أو WEBP.',
                'product_image.max' => 'حجم صورة المنتج يجب ألا يتجاوز 2 ميجابايت.',

                'section_id.required' => 'يجب اختيار القسم.',
                'section_id.exists' => 'القسم المحدد غير موجود.',
            ]
        );

        try {

            $data = [
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description ?: 'لا يوجد',
                'section_id' => $request->section_id,
            ];

            if ($request->hasFile('product_image')) {

                // حفظ مسار الصورة القديمة
                $oldImage = $product->product_image;

                // رفع الصورة الجديدة
                $newImage = $request->file('product_image')
                    ->store('products', 'public');

                $data['product_image'] = $newImage;

                // حذف الصورة القديمة بعد نجاح رفع الجديدة
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $product->update($data);

            return redirect()
                ->back()
                ->with('success', 'تم تعديل المنتج بنجاح');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'حدث خطأ أثناء تعديل المنتج');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // if ($product->section()->exists()) {
        //     return back()->with('error', 'ليس لديك الصلاحيات لحذف المنتج');
        // }
        $product->delete();

        return back()->with('success', 'تم حذف المنتج بنجاح');
    }
}
