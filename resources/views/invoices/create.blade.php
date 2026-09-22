@extends('layouts.master')

@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('title', 'إضافة فاتورة')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

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

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="invoice_number" class="control-label">رقم الفاتورة</label>
                                <input type="number" class="form-control" id="invoice_number" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="date" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ استحقاق الفاتورة </label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="date" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="section" class="control-label">البنك</label>
                                <select id="section" name="Section" class="form-control SlectBox">

                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد البنك</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="product" class="control-label">الخدمة</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="" selected disabled>حدد الخدمة</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="Amount_collection" class="control-label">مبلغ التحصيل</label>
                                <input type="number" class="form-control" id="Amount_collection" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="Commission_Rate" class="control-label">نسبة العمولة (%)</label>

                                <input type="number" class="form-control form-control-lg" id="Commission_Rate"
                                    name="Commission_Rate" min="0" max="100" step="0.01" placeholder="مثال: 10" required>
                            </div>



                            <div class="col">
                                <label for="Rate_VAT" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control"
                                    onchange="calculateInvoiceTotal()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                    <option value="0">لا توجد ضريبة</option>
                                    <option value="14">14%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="Value_VAT" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="number" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="Total" class="control-label"> إجمالي العمولة شامل الضريبة </label>
                                <input type="number" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div><br>
                        <div class="col">
                            <label for="Amount_Commission" class="control-label">مبلغ العمولة</label>

                            <input type="number" class="form-control" id="Amount_Commission" name="Amount_Commission"
                                readonly>
                        </div>
                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="image" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection



@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datestatusker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $('#section').change(function () {

            let sectionId = $(this).val();
            let product = $('#product');

            product.html('<option selected disabled>جاري تحميل الخدمات...</option>');

            if (!sectionId) return;

            $.get("{{ url('invoices/products') }}/" + sectionId, function (products) {

                product.html('<option selected disabled>حدد الخدمة</option>');

                if (!products.length) {
                    product.append('<option disabled>لا توجد خدمات لهذا البنك</option>');
                    return;
                }

                // index = رقم العنصر، item = بيانات المنتج الحالي
                $.each(products, function (index, item) {
                    product.append(
                        '<option value="' + item.id + '">' +
                        item.product_name +
                        '</option>'
                    );
                });

            }).fail(function () {

                product.html(
                    '<option selected disabled>حدث خطأ أثناء تحميل الخدمات</option>'
                );

            });
        });
    </script>


    <script>
        function calculateInvoiceTotal() {

            const amountCollection = parseFloat($('#Amount_collection').val()) || 0;
            const commissionRate = parseFloat($('#Commission_Rate').val()) || 0;
            const rateVAT = parseFloat($('#Rate_VAT').val()) || 0;

            // حساب مبلغ العمولة الأساسي
            const baseCommission =
                amountCollection * commissionRate / 100;

            // حساب قيمة ضريبة القيمة المضافة
            const valueVAT =
                baseCommission * rateVAT / 100;

            // مبلغ العمولة بعد إضافة الضريبة
            const amountCommission =
                baseCommission + valueVAT;

            // إجمالي العمولة شامل الضريبة
            const total =
                amountCommission;

            $('#Amount_Commission').val(amountCommission.toFixed(2));
            $('#Value_VAT').val(valueVAT.toFixed(2));
            $('#Total').val(total.toFixed(2));
        }

        $('#Amount_collection, #Commission_Rate, #Rate_VAT').on('input change', function () {
            calculateInvoiceTotal();
        });
    </script>


@endsection