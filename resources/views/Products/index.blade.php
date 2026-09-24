@extends('layouts.master')

@section('title', 'المنتجات')

@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    {{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection



@section('content')
    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    {{-- Success Session --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show h5 w-25" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Error Session --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show h5 w-25" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show h5 w-25" role="alert">
                            {{ $errors->first() }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="col-sm-4 col-md-1">
                        <div class="d-flex justify-content-between">
                            <a class="modal-effect btn btn-outline-primary btn-block font-weight-bold add-product"
                                data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة منتج</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-nowrap w-100 text-center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0" style="font-size: 15px;">إسم المنتج</th>
                                    <th class="border-bottom-0" style="font-size: 15px;">إسم القسم</th>
                                    <th class="border-bottom-0 h5" style="font-size: 15px;"> السعر</th>
                                    <th class="border-bottom-0 h5" style="font-size: 15px;">الوصف</th>
                                    <th class="border-bottom-0 h5" style="font-size: 15px;">الصورة</th>
                                    <th class="border-bottom-0" style="font-size: 15px;">الإجراءات</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $product->product_name }}</td>

                                            <td>{{ $product->section->section_name }}</td>

                                            <td>{{ number_format($product->product_price, 2) }}</td>

                                    <td>
                                        <div style="width: 250px; height:30px; overflow-y: scroll; white-space: nowrap; direction: ltr !important;">
                                            {{ $product->product_description }}
                                        </div>
                                    </td>

                                            <td>
                                                @if ($product->product_image)
                                                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="50"
                                                        height="50" style="object-fit: cover; border-radius: 5px;">
                                                @else
                                                    <span class="text-muted">لا توجد صورة</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">

                                                    {{-- Edit --}}
                                                    <a href="#" class="text-primary mx-2 edit-product" title="تعديل" data-id="{{ $product->id }}"
                                                        data-name="{{ $product->product_name }}" data-price="{{ $product->product_price }}"
                                                        data-product_description="{{ $product->product_description }}"
                                                        data-section_id="{{ $product->section_id }}" data-image="{{ $product->product_image }}"
                                                        data-toggle="modal" data-target="#modaldemo8">

                                                        <i class="fas fa-edit fa-lg"></i>
                                                    </a>

                                                    {{-- Delete --}}
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block m-0">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn p-0 border-0 bg-transparent text-danger mx-2" title="حذف"
                                                            onclick="return confirm('هل أنت متأكد من حذف المنتج؟')">

                                                            <i class="fas fa-trash-alt fa-lg"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-bold bg-danger h5 text-center">
                                            لا توجد منتجات حاليا
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>



                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


        <!-- Basic modal Add-->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">

                    <div class="modal-header">
                        <h6 class="modal-title" id="productModalTitle"></h6>

                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="productForm" action="{{ route('products.store') }}" method="POST"
                            enctype="multipart/form-data" autocomplete="off">

                            @csrf

                            <div class="form-group">
                                <label for="product_name">اسم المنتج</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required
                                    placeholder="أدخل اسم المنتج">
                            </div>

                            <div class="form-group">
                                <label for="section_id">القسم</label>

                                <select class="form-control" id="section_id" name="section_id" required>

                                    <option value="">-- اختر القسم --</option>

                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->section_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_price">سعر المنتج</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" min="0"
                                    step="0.01" required placeholder="أدخل سعر المنتج">
                            </div>

                            <div class="form-group">
                                <label for="product_description">ملاحظات</label>
                                <textarea class="form-control" id="product_description" name="product_description" rows="4"
                                    placeholder="أدخل الملاحظات"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="product_image">صورة المنتج</label>
                                <input type="file" class="form-control" id="product_image" name="product_image"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                <small class="text-muted">
                                    JPG, JPEG, PNG, WEBP - بحد أقصى 2 ميجابايت
                                </small>
                            </div>

                             <div class="form-group">
                                 <label>الصورة الحالية</label>
                                 <div>
                                     <img id="productImagePreview" src="" alt="صورة المنتج" width="100" height="100"
                                         style="object-fit: cover; border-radius: 5px; display: none;">
                                 </div>
                             </div>
                            <div class="modal-footer">
                                <button id="productSubmit" class="btn ripple btn-success" type="submit">
                                </button>

                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                    إغلاق
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Basic modal Add-->

    </div>
    <!-- row closed  -->
    <!-- main-content closed -->
@endsection


@section('js')
    <!-- Internal Data tables -->


    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>

    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    {{-- <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script> --}}
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>


    {{-- تعديل بيانات الفورم حسب الأكشن --}}
    <script>
    // إضافة منتج جديد
    $('.add-product').click(function () {

        $('#productModalTitle').text('إضافة منتج');
        $('#productSubmit').text('تأكيد');

        $('#product_name').val('');
        $('#product_price').val('');
        $('#product_description').val('');
        $('#section_id').val('');

        // تفريغ صورة المنتج
        $('#product_image').val('');
        $('#productImagePreview').hide().attr('src', '');
        // Delete Current Method If Existed
        $('#productForm input[name="_method"]').remove();

        $('#productForm').attr(
            'action',
            '{{ route('products.store') }}'
        );
    });


    // تعديل المنتج
        $('.edit-product').click(function () {

            $('#productSubmit').text('تعديل');
            $('#productModalTitle').text('تعديل المنتج');

            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            let description = $(this).data('product_description');
            let section_id = $(this).data('section_id');
            let image = $(this).data('image');

            $('#product_name').val(name);
            $('#product_price').val(price);
            $('#product_description').val(description);
            $('#section_id').val(section_id);

            // تفريغ اختيار صورة جديدة
            $('#product_image').val('');

            // عرض الصورة الحالية
            if (image) {
                $('#productImagePreview')
                    .attr('src', "{{ asset('storage') }}/" + image)
                    .show();
            } else {
                $('#productImagePreview').hide();
            }

            // Delete Current Method If Existed
            $('#productForm input[name="_method"]').remove();

            let updateUrl = "{{ url('products') }}/" + id;

            $('#productForm').attr('action', updateUrl);

            // Laravel لا يرسل PUT مباشرة من الـ form
            $('#productForm').prepend(
                '<input type="hidden" name="_method" value="PUT">'
            );
        });

    </script>

@endsection