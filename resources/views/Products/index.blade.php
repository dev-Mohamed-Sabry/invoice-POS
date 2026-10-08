@extends('layouts.master')

@section('title', 'المنتجات')

@section('css') <!-- DataTables -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('page-header') <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex align-items-center">
                <h4 class="content-title mb-0 my-auto">
                    المنتجات </h4>

                <span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    / قائمة المنتجات
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->


@endsection

@section('content')


    <div class="row row-sm">

        <div class="col-xl-12">

            <div class="card mg-b-20">

                {{-- ================================================= --}}
                {{-- Header --}}
                {{-- ================================================= --}}

                <div class="card-header pb-0">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>
                            <h5 class="card-title mb-1">
                                قائمة المنتجات
                            </h5>

                            <p class="text-muted mb-0">
                                إدارة المنتجات وأسعارها وأقسامها
                            </p>
                        </div>

                        <div class="mt-2 mt-md-0">

                            <button type="button" class="btn btn-primary font-weight-bold add-product" data-toggle="modal"
                                data-target="#productModal">
                                <i class="fas fa-plus ml-1"></i>
                                إضافة منتج
                            </button>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- Alerts --}}
                {{-- ================================================= --}}

                <div class="card-body pb-0">

                    @if (session('success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                    @endif


                    @if (session('error'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                    @endif


                    @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            {{ $errors->first() }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- Products Table --}}
                {{-- ================================================= --}}

                <div class="card-body pt-2">

                    <div class="table-responsive">

                        <table id="productsTable" class="table table-bordered text-nowrap text-center w-100">

                            <thead>

                                <tr>

                                    <th class="border-bottom-0">
                                        #
                                    </th>

                                    <th class="border-bottom-0">
                                        اسم المنتج
                                    </th>

                                    <th class="border-bottom-0">
                                        القسم
                                    </th>

                                    <th class="border-bottom-0">
                                        السعر
                                    </th>

                                    <th class="border-bottom-0">
                                        الوصف
                                    </th>

                                    <th class="border-bottom-0">
                                        الصورة
                                    </th>

                                    <th class="border-bottom-0">
                                        العمليات
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($products as $product)

                                    <tr>

                                        {{-- Number --}}
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>


                                        {{-- Product Name --}}
                                        <td>
                                            {{ $product->product_name }}
                                        </td>


                                        {{-- Section --}}
                                        <td>
                                            {{ $product->section->section_name ?? 'لا يوجد' }}
                                        </td>


                                        {{-- Price --}}
                                        <td>
                                            {{ number_format($product->product_price, 2) }}
                                        </td>


                                        {{-- Description --}}
                                        <td>

                                            @if ($product->product_description)

                                                <div style="
                                                                    max-width: 250px;
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;
                                                                    white-space: nowrap;
                                                                    margin: auto;
                                                                " title="{{ $product->product_description }}">
                                                    {{ $product->product_description }}
                                                </div>

                                            @else

                                                <span class="text-muted">
                                                    لا يوجد
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Image --}}
                                        <td>

                                            @if ($product->product_image)

                                                <img src="{{ asset('storage/' . $product->product_image) }}"
                                                    alt="{{ $product->product_name }}" width="50" height="50" style="
                                                                    object-fit: cover;
                                                                    border-radius: 5px;
                                                                ">

                                            @else

                                                <span class="text-muted">
                                                    لا توجد صورة
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td>

                                            <div class="d-flex justify-content-center align-items-center">

                                                {{-- Edit --}}
                                                <button type="button" class="btn btn-sm btn-primary mx-1 edit-product"
                                                    title="تعديل" data-id="{{ $product->id }}"
                                                    data-name="{{ $product->product_name }}"
                                                    data-price="{{ $product->product_price }}"
                                                    data-product_description="{{ $product->product_description }}"
                                                    data-section_id="{{ $product->section_id }}"
                                                    data-image="{{ $product->product_image }}" data-toggle="modal"
                                                    data-target="#productModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>


                                                {{-- Delete --}}
                                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                    class="d-inline-block m-0">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger mx-1" title="حذف"
                                                        onclick="return confirm('هل أنت متأكد من حذف المنتج؟')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="7" class="text-center text-muted py-4">
                                            لا توجد منتجات حاليًا
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- Add / Edit Product Modal --}}
    {{-- ============================================================= --}}

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="productModalTitle">
                        إضافة منتج
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>


                <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">

                    @csrf


                    <div class="modal-body">

                        {{-- Product Name --}}
                        <div class="form-group">

                            <label for="product_name">
                                اسم المنتج
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="product_name" name="product_name"
                                value="{{ old('product_name') }}" required placeholder="أدخل اسم المنتج">

                        </div>


                        {{-- Section --}}
                        <div class="form-group">

                            <label for="section_id">
                                القسم
                                <span class="text-danger">*</span>
                            </label>

                            <select class="form-control" id="section_id" name="section_id" required>

                                <option value="">
                                    -- اختر القسم --
                                </option>

                                @foreach ($sections as $section)

                                    <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                        {{ $section->section_name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Product Price --}}
                        <div class="form-group">

                            <label for="product_price">
                                سعر المنتج
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number" class="form-control" id="product_price" name="product_price"
                                value="{{ old('product_price') }}" min="0" step="0.01" required
                                placeholder="أدخل سعر المنتج">

                        </div>


                        {{-- Description --}}
                        <div class="form-group">

                            <label for="product_description">
                                الوصف
                            </label>

                            <textarea class="form-control" id="product_description" name="product_description" rows="4"
                                placeholder="أدخل وصف المنتج">{{ old('product_description') }}</textarea>

                        </div>


                        {{-- Product Image --}}
                        <div class="form-group">

                            <label for="product_image">
                                صورة المنتج
                            </label>

                            <input type="file" class="form-control" id="product_image" name="product_image"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                            <small class="text-muted">
                                JPG, JPEG, PNG, WEBP - بحد أقصى 2 ميجابايت
                            </small>

                        </div>


                        {{-- Current Image --}}
                        <div class="form-group mb-0" id="currentProductImageContainer">

                            <label>
                                الصورة الحالية
                            </label>

                            <div>

                                <img id="productImagePreview" src="" alt="صورة المنتج" width="100" height="100" style="
                                            object-fit: cover;
                                            border-radius: 5px;
                                            display: none;
                                        ">

                                <span id="noProductImage" class="text-muted" style="display: none;">
                                    لا توجد صورة
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button id="productSubmit" class="btn btn-success" type="submit">
                            تأكيد
                        </button>

                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            إغلاق
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


@endsection

@section('js')


    {{-- ============================================================= --}}
    {{-- DataTables --}}
    {{-- ============================================================= --}}

    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>


    <script>

        $(document).ready(function () {


            /*
             * ========================================================
             * DataTable
             * ========================================================
             */

            $('#productsTable').DataTable({
                responsive: true,
                pageLength: 10,
                ordering: true,
                searching: true,
                language: {
                    search: 'بحث:',
                    lengthMenu: 'عرض _MENU_ سجل',
                    info: 'عرض _START_ إلى _END_ من أصل _TOTAL_ سجل',
                    infoEmpty: 'لا توجد سجلات',
                    zeroRecords: 'لا توجد نتائج مطابقة',
                    emptyTable: 'لا توجد منتجات حاليًا',
                    paginate: {
                        first: 'الأول',
                        last: 'الأخير',
                        next: 'التالي',
                        previous: 'السابق'
                    }
                }
            });


            /*
             * ========================================================
             * Add Product
             * ========================================================
             */

            $('.add-product').on('click', function () {

                $('#productModalTitle').text('إضافة منتج');

                $('#productSubmit').text('تأكيد');

                $('#productForm').attr(
                    'action',
                    '{{ route('products.store') }}'
                );


                $('#product_name').val('');

                $('#section_id').val('');

                $('#product_price').val('');

                $('#product_description').val('');

                $('#product_image').val('');


                /*
                 * Reset current image
                 */

                $('#productImagePreview')
                    .hide()
                    .attr('src', '');

                $('#noProductImage').hide();


                /*
                 * Remove Laravel method override
                 */

                $('#productForm input[name="_method"]').remove();

            });


            /*
             * ========================================================
             * Edit Product
             * ========================================================
             */

            $('.edit-product').on('click', function () {

                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');
                let description = $(this).data('product_description');
                let sectionId = $(this).data('section_id');
                let image = $(this).data('image');


                $('#productModalTitle').text('تعديل المنتج');

                $('#productSubmit').text('تعديل');


                /*
                 * Fill form
                 */

                $('#product_name').val(name);

                $('#section_id').val(sectionId);

                $('#product_price').val(price);

                $('#product_description').val(
                    description ? description : ''
                );


                /*
                 * Reset new image selection
                 */

                $('#product_image').val('');


                /*
                 * Display current image
                 */

                if (image) {

                    $('#productImagePreview')
                        .attr(
                            'src',
                            "{{ asset('storage') }}/" + image
                        )
                        .show();

                    $('#noProductImage').hide();

                } else {

                    $('#productImagePreview')
                        .hide()
                        .attr('src', '');

                    $('#noProductImage').show();

                }


                /*
                 * Remove previous method override
                 */

                $('#productForm input[name="_method"]').remove();


                /*
                 * Update URL
                 */

                $('#productForm').attr(
                    'action',
                    "{{ url('products') }}/" + id
                );


                /*
                 * Laravel method spoofing
                 */

                $('#productForm').prepend(
                    '<input type="hidden" name="_method" value="PUT">'
                );

            });

        });

    </script>


@endsection