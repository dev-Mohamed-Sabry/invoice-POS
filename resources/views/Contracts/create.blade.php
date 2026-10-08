@extends('layouts.master')

@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Datepicker css -->
    {{--
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jquery-ui/themes/base/jquery-ui.min.css') }}"> --}}
@endsection

@section('title', 'إضافة عقد')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العقود</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة عقد</span>
            </div>
        </div>
    </div>
@endsection

@section('content')



    <div class="row">
        <div class="col-lg-12 col-md-12">

            <div class="card">
                <div class="card-body">

                    {{-- Success Session --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Error Session --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('contracts.store') }}" method="POST" autocomplete="off">
                        @csrf

                        {{-- ========================= --}}
                        {{-- بيانات العقد --}}
                        {{-- ========================= --}}

                        <h5 class="card-title">بيانات العقد</h5>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="contract_number_display" class="control-label">
                                    رقم العقد
                                </label>

                                <input type="text" class="form-control" id="contract_number_display"
                                    value="سيتم توليده تلقائياً" readonly>

                                <input type="hidden" name="contract_number" value="{{ old('contract_number') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="contract_date" class="control-label">
                                    تاريخ العقد
                                </label>

                                <input type="date" class="form-control" id="contract_date" name="contract_date"
                                    value="{{ old('contract_date', date('Y-m-d')) }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sale_type" class="control-label">
                                    نوع البيع
                                </label>

                                <select id="sale_type" name="sale_type" class="form-control" required>
                                    <option value="" selected disabled>
                                        حدد نوع البيع
                                    </option>

                                    <option value="cash" {{ old('sale_type') === 'cash' ? 'selected' : '' }}>
                                        نقدي
                                    </option>

                                    <option value="installment" {{ old('sale_type') === 'installment' ? 'selected' : '' }}>
                                        تقسيط
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            {{-- ========================= --}}
                            {{-- العميل --}}
                            {{-- ========================= --}}

                            <div class="col-md-6 mb-3">

                                <label for="customer_id" class="control-label">
                                    العميل
                                </label>

                                <select id="customer_id" name="customer_id" class="form-control" required
                                    data-placeholder="ابحث عن العميل بالاسم أو رقم الهاتف">
                                    <option value=""></option>
                                </select>

                                <small class="text-muted">
                                    اكتب اسم العميل أو رقم الهاتف للبحث.
                                </small>

                            </div>

                            {{-- ========================= --}}
                            {{-- الموظف المسؤول --}}
                            {{-- ========================= --}}

                            <div class="col-md-6 mb-3">

                                <label for="user_id" class="control-label">
                                    الموظف المسؤول عن العقد
                                </label>

                                <select id="user_id" name="user_id" class="form-control" required
                                    data-placeholder="ابحث عن الموظف بالاسم">
                                    <option value=""></option>
                                </select>

                                <small class="text-muted">
                                    اختر الموظف المسؤول عن تنفيذ العقد.
                                </small>

                            </div>

                        </div>

                        <hr>

                        {{-- ========================= --}}
                        {{-- إضافة منتج --}}
                        {{-- ========================= --}}

                        <h5 class="card-title">إضافة المنتجات</h5>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="section_id" class="control-label">
                                    القسم
                                </label>

                                <select id="section_id" class="form-control">

                                    <option value="" selected disabled>
                                        حدد القسم
                                    </option>

                                    @isset($sections)

                                        @foreach ($sections as $section)

                                            <option value="{{ $section->id }}">
                                                {{ $section->section_name }}
                                            </option>

                                        @endforeach

                                    @endisset

                                </select>

                            </div>

                            <div class="col-md-5 mb-3">

                                <label for="product_id" class="control-label">
                                    المنتج
                                </label>

                                <select id="product_id" class="form-control" disabled>

                                    <option value="" selected disabled>
                                        حدد المنتج
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-3 mb-3">

                                <label for="item_quantity" class="control-label">
                                    الكمية
                                </label>

                                <input type="number" id="item_quantity" class="form-control" min="1" step="1" value="1">

                            </div>

                        </div>

                        <div class="d-flex justify-content-center mt-2 mb-4">

                            <button type="button" class="btn btn-success" id="addProductBtn">
                                <i class="fas fa-plus"></i>
                                إضافة المنتج
                            </button>

                        </div>

                        {{-- ========================= --}}
                        {{-- جدول المنتجات --}}
                        {{-- ========================= --}}

                        <div class="table-responsive">

                            <table class="table table-bordered text-nowrap text-center w-100">

                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>المنتج</th>
                                        <th>الكمية</th>
                                        <th>السعر النقدي</th>
                                        <th>المدة</th>
                                        <th>الفائدة</th>
                                        <th>إجمالي التقسيط</th>
                                        <th>الإجراء</th>
                                    </tr>

                                </thead>

                                <tbody id="contractItemsTable">

                                    <tr id="emptyItemsRow">

                                        <td colspan="8" class="text-muted">
                                            لا توجد منتجات مضافة للعقد
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        {{-- ========================= --}}
                        {{-- بيانات المنتج --}}
                        {{-- ========================= --}}

                        <div id="productDetailsSection" style="display: none;">

                            <hr>

                            <h5 class="card-title">
                                تفاصيل المنتج
                            </h5>

                            <input type="hidden" id="current_item_index" value="">

                            <input type="hidden" id="current_product_id" value="">

                            <input type="hidden" id="current_product_name" value="">

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="control-label">
                                        اسم المنتج
                                    </label>

                                    <input type="text" id="detail_product_name" class="form-control" readonly>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="control-label">
                                        سعر البيع النقدي النهائي
                                    </label>

                                    <input type="number" id="detail_cash_product_price" class="form-control" min="0"
                                        step="0.01" readonly>

                                    <small class="text-muted">
                                        السعر النهائي للمنتج، شامل VAT إن كان المنتج خاضعًا لها.
                                    </small>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="control-label">
                                        إجمالي السعر النقدي
                                    </label>

                                    <input type="number" id="detail_cash_total" class="form-control" readonly>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="control-label">
                                        نسبة الفائدة (%)
                                    </label>

                                    <input type="number" id="detail_interest_rate" class="form-control" min="0" max="100"
                                        step="0.01" value="0">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="control-label">
                                        مبلغ الفائدة
                                    </label>

                                    <input type="number" id="detail_interest_amount" class="form-control" min="0"
                                        step="0.01" value="0" readonly>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="control-label">
                                        المصاريف الإدارية
                                    </label>

                                    <input type="number" id="detail_administrative_fees" class="form-control" min="0"
                                        step="0.01" value="0">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="control-label">
                                        مدة التقسيط (شهر)
                                    </label>

                                    <input type="number" id="detail_installment_months" class="form-control" min="0"
                                        step="1" value="0">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="control-label">
                                        إجمالي التقسيط
                                    </label>

                                    <input type="number" id="detail_installment_total" class="form-control" min="0"
                                        step="0.01" value="0" readonly>

                                </div>

                            </div>

                            <div class="d-flex justify-content-center mt-2 mb-4">

                                <button type="button" class="btn btn-primary" id="saveProductDetailsBtn">
                                    <i class="fas fa-save"></i>
                                    حفظ بيانات المنتج
                                </button>

                            </div>

                        </div>

                        <hr>

                        {{-- ========================= --}}
                        {{-- الملخص المالي --}}
                        {{-- ========================= --}}

                        <h5 class="card-title">
                            الملخص المالي للعقد
                        </h5>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="cash_total" class="control-label">
                                    إجمالي النقدي
                                </label>

                                <input type="number" class="form-control" id="cash_total" name="cash_total" value="0.00"
                                    readonly>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="control-label">
                                    إجمالي الفائدة
                                </label>

                                <input type="number" class="form-control" id="total_interest" value="0.00" readonly>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="control-label">
                                    إجمالي المصاريف الإدارية
                                </label>

                                <input type="number" class="form-control" id="total_administrative_fees" value="0.00"
                                    readonly>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="installment_total" class="control-label">
                                    إجمالي التقسيط
                                </label>

                                <input type="number" class="form-control" id="installment_total" name="installment_total"
                                    value="0.00" readonly>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="contract_months" class="control-label">
                                    مدة العقد
                                </label>

                                <input type="number" class="form-control" id="contract_months" name="contract_months"
                                    value="0" readonly>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="down_payment" class="control-label">
                                    المقدم
                                </label>

                                <input type="number" class="form-control" id="down_payment" name="down_payment" min="0"
                                    step="0.01" value="{{ old('down_payment', 0) }}">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="control-label">
                                    المتبقي
                                </label>

                                <input type="number" class="form-control" id="remaining_balance" value="0.00" readonly>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="commission_rate" class="control-label">
                                    نسبة العمولة (%)
                                </label>

                                <input type="number" class="form-control" id="commission_rate" name="commission_rate"
                                    min="0" max="100" step="0.01" value="{{ old('commission_rate', 0) }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="commission_amount" class="control-label">
                                    مبلغ العمولة
                                </label>

                                <input type="number" class="form-control" id="commission_amount" name="commission_amount"
                                    min="0" step="0.01" value="0" readonly>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="grace_days" class="control-label">
                                    مدة السماح للتأخير (بالأيام)
                                </label>

                                <input type="number" class="form-control" id="grace_days" name="grace_days" min="0" step="1"
                                    value="{{ old('grace_days', 0) }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="late_fee_type" class="control-label">
                                    نوع غرامة التأخير
                                </label>

                                <select id="late_fee_type" name="late_fee_type" class="form-control">

                                    <option value="">
                                        بدون غرامة
                                    </option>

                                    <option value="fixed" {{ old('late_fee_type') === 'fixed' ? 'selected' : '' }}>
                                        مبلغ ثابت
                                    </option>

                                    <option value="percentage" {{ old('late_fee_type') === 'percentage' ? 'selected' : '' }}>
                                        نسبة مئوية
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="late_fee_value" class="control-label">
                                    قيمة غرامة التأخير
                                </label>

                                <input type="number" class="form-control" id="late_fee_value" name="late_fee_value" min="0"
                                    step="0.01" value="{{ old('late_fee_value') }}">

                            </div>

                        </div>

                        <hr>

                        {{-- ========================= --}}
                        {{-- الملاحظات --}}
                        {{-- ========================= --}}

                        <div class="row">

                            <div class="col-12 mb-3">

                                <label for="notes">
                                    ملاحظات
                                </label>

                                <textarea class="form-control" id="notes" name="notes"
                                    rows="3">{{ old('notes') }}</textarea>

                            </div>

                        </div>

                        {{-- ========================= --}}
                        {{-- أزرار الحفظ --}}
                        {{-- ========================= --}}

                        <div class="d-flex justify-content-center mt-3">

                            <a href="{{ route('contracts.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-times"></i>
                                إلغاء
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                حفظ العقد
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>


@endsection




@section('js')

    <!-- Internal Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        /*
     * ==========================================================
     * استرجاع العميل بعد Validation Error
     * ==========================================================
     */

        @if(old('customer_id'))

            $.ajax({
                url: "{{ route('contracts.search-customers') }}",
                data: {
                    id: "{{ old('customer_id') }}"
                },
                dataType: 'json'
            }).done(function (data) {

                if (data.length) {

                    const option = new Option(
                        data[0].text,
                        data[0].id,
                        true,
                        true
                    );

                    $('#customer_id')
                        .append(option)
                        .trigger('change');
                }

            });

        @endif


        /*
         * ==========================================================
         * استرجاع الموظف بعد Validation Error
         * ==========================================================
         */

        @if(old('user_id'))

            $.ajax({
                url: "{{ route('contracts.search-users') }}",
                data: {
                    id: "{{ old('user_id') }}"
                },
                dataType: 'json'
            }).done(function (data) {

                if (data.length) {

                    const option = new Option(
                        data[0].text,
                        data[0].id,
                        true,
                        true
                    );

                    $('#user_id')
                        .append(option)
                        .trigger('change');
                }

            });

        @endif
    </script>


    <script>
        $(document).ready(function () {

            let contractItems = [];
            let currentItemIndex = null;

            /*
             * ==========================================================
             * البحث عن العملاء
             * ==========================================================
             */

            $('#customer_id').select2({

                placeholder: 'ابحث عن العميل بالاسم أو رقم الهاتف',

                allowClear: true,

                width: '100%',

                minimumInputLength: 1,

                ajax: {

                    url: "{{ route('contracts.search-customers') }}",

                    dataType: 'json',

                    delay: 300,

                    data: function (params) {

                        return {
                            q: params.term
                        };

                    },

                    processResults: function (data) {

                        return {
                            results: data
                        };

                    },

                    cache: true

                }

            });


            /*
             * ==========================================================
             * البحث عن الموظفين
             * ==========================================================
             */

            $('#user_id').select2({

                placeholder: 'ابحث عن الموظف بالاسم',

                allowClear: true,

                width: '100%',

                minimumInputLength: 1,

                ajax: {

                    url: "{{ route('contracts.search-users') }}",

                    dataType: 'json',

                    delay: 300,

                    data: function (params) {

                        return {
                            q: params.term
                        };

                    },

                    processResults: function (data) {

                        return {
                            results: data
                        };

                    },

                    cache: true

                }

            });
            /*
             * ==========================================================
             * Helpers
             * ==========================================================
             */

            function formatMoney(value) {

                value = parseFloat(value) || 0;

                return value.toFixed(2);
            }


            function calculateItem(item) {

                const cashProductPrice = parseFloat(item.cash_product_price) || 0;
                const quantity = parseInt(item.quantity) || 1;
                const interestRate = parseFloat(item.interest_rate) || 0;
                const administrativeFees = parseFloat(item.administrative_fees) || 0;

                const cashTotal = cashProductPrice * quantity;

                const interestAmount =
                    cashTotal * (interestRate / 100);

                const installmentTotal =
                    cashTotal +
                    interestAmount +
                    administrativeFees;

                item.cash_total = parseFloat(cashTotal.toFixed(2));
                item.interest_amount = parseFloat(interestAmount.toFixed(2));
                item.installment_total = parseFloat(installmentTotal.toFixed(2));

                return item;
            }


            function calculateSummary() {

                let cashTotal = 0;
                let totalInterest = 0;
                let totalAdministrativeFees = 0;
                let installmentTotal = 0;
                let contractMonths = 0;

                contractItems.forEach(function (item) {

                    cashTotal += parseFloat(item.cash_total) || 0;
                    totalInterest += parseFloat(item.interest_amount) || 0;
                    totalAdministrativeFees += parseFloat(item.administrative_fees) || 0;
                    installmentTotal += parseFloat(item.installment_total) || 0;

                    contractMonths = Math.max(
                        contractMonths,
                        parseInt(item.installment_months) || 0
                    );

                });

                $('#cash_total').val(formatMoney(cashTotal));
                $('#total_interest').val(formatMoney(totalInterest));
                $('#total_administrative_fees').val(
                    formatMoney(totalAdministrativeFees)
                );
                $('#installment_total').val(
                    formatMoney(installmentTotal)
                );

                $('#contract_months').val(contractMonths);

                calculateRemaining();
                calculateCommission();
            }


            function calculateRemaining() {

                const installmentTotal =
                    parseFloat($('#installment_total').val()) || 0;

                const downPayment =
                    parseFloat($('#down_payment').val()) || 0;

                const remaining =
                    Math.max(installmentTotal - downPayment, 0);

                $('#remaining_balance').val(
                    formatMoney(remaining)
                );
            }


            function calculateCommission() {

                const commissionRate =
                    parseFloat($('#commission_rate').val()) || 0;

                const cashTotal =
                    parseFloat($('#cash_total').val()) || 0;

                const totalInterest =
                    parseFloat($('#total_interest').val()) || 0;

                const totalAdministrativeFees =
                    parseFloat($('#total_administrative_fees').val()) || 0;

                /*
                 * أساس العمولة:
                 * النقدي + الفائدة + المصاريف الإدارية
                 *
                 * بدون VAT إضافية.
                 */
                const commissionBase =
                    cashTotal +
                    totalInterest +
                    totalAdministrativeFees;

                const commissionAmount =
                    commissionBase * (commissionRate / 100);

                $('#commission_amount').val(
                    formatMoney(commissionAmount)
                );
            }


            function renderItemsTable() {

                const tbody = $('#contractItemsTable');

                tbody.find('tr.item-row').remove();

                if (contractItems.length === 0) {

                    $('#emptyItemsRow').show();

                    return;
                }

                $('#emptyItemsRow').hide();

                contractItems.forEach(function (item, index) {

                    const row = `
                                                            <tr class="item-row">

                                                                <td>
                                                                    ${index + 1}
                                                                </td>

                                                                <td>
                                                                    ${escapeHtml(item.product_name)}
                                                                </td>

                                                                <td>
                                                                    ${item.quantity}
                                                                </td>

                                                                <td>
                                                                    ${formatMoney(item.cash_product_price)}
                                                                </td>

                                                                <td>
                                                                    ${item.installment_months}
                                                                </td>

                                                                <td>
                                                                    ${formatMoney(item.interest_rate)}%
                                                                </td>

                                                                <td>
                                                                    ${formatMoney(item.installment_total)}
                                                                </td>

                                                                <td>

                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-sm btn-info edit-item"
                                                                        data-index="${index}"
                                                                        title="تعديل"
                                                                    >
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>

                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-sm btn-danger delete-item"
                                                                        data-index="${index}"
                                                                        title="حذف"
                                                                    >
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>

                                                                </td>

                                                            </tr>
                                                        `;

                    tbody.append(row);
                });
            }


            function escapeHtml(text) {

                return $('<div>')
                    .text(text ?? '')
                    .html();
            }


            /*
             * ==========================================================
             * Hidden Inputs
             * ==========================================================
             *
             * يتم إنشاء inputs الخاصة بـ items ديناميكيًا.
             *
             * Controller يستقبل:
             *
             * items[index][product_id]
             * items[index][quantity]
             * items[index][interest_rate]
             * items[index][administrative_fees]
             * items[index][installment_months]
             *
             */

            function renderHiddenInputs() {

                $('#contractHiddenItems').remove();

                const container = $('<div>', {
                    id: 'contractHiddenItems'
                });

                contractItems.forEach(function (item, index) {

                    container.append(
                        $('<input>', {
                            type: 'hidden',
                            name: `items[${index}][product_id]`,
                            value: item.product_id
                        })
                    );

                    container.append(
                        $('<input>', {
                            type: 'hidden',
                            name: `items[${index}][quantity]`,
                            value: item.quantity
                        })
                    );

                    container.append(
                        $('<input>', {
                            type: 'hidden',
                            name: `items[${index}][interest_rate]`,
                            value: item.interest_rate
                        })
                    );

                    container.append(
                        $('<input>', {
                            type: 'hidden',
                            name: `items[${index}][administrative_fees]`,
                            value: item.administrative_fees
                        })
                    );

                    container.append(
                        $('<input>', {
                            type: 'hidden',
                            name: `items[${index}][installment_months]`,
                            value: item.installment_months
                        })
                    );

                });

                $('form[action="{{ route('contracts.store') }}"]')
                    .append(container);
            }


            /*
             * ==========================================================
             * نوع البيع
             * ==========================================================
             */

            $('#sale_type').on('change', function () {

                const saleType = $(this).val();

                if (saleType === 'cash') {

                    $('#down_payment').val(0);
                    $('#contract_months').val(0);

                    contractItems.forEach(function (item) {

                        item.interest_rate = 0;
                        item.interest_amount = 0;
                        item.installment_months = 0;

                        calculateItem(item);
                    });

                    renderItemsTable();
                    renderHiddenInputs();
                    calculateSummary();
                }

                if (saleType === 'installment') {

                    calculateSummary();
                }

            });


            /*
             * ==========================================================
             * تحميل المنتجات حسب القسم
             * ==========================================================
             */

            $('#section_id').on('change', function () {

                const sectionId = $(this).val();
                const product = $('#product_id');

                product.prop('disabled', true);

                product.html(
                    '<option selected disabled>جاري تحميل المنتجات...</option>'
                );

                if (!sectionId) {

                    product.html(
                        '<option selected disabled>حدد المنتج</option>'
                    );

                    return;
                }

                $.ajax({

                    url: "{{ route('products.by-section', ':section') }}"
                        .replace(':section', sectionId),

                    type: 'GET',

                    dataType: 'json',

                    success: function (response) {

                        product.html(
                            '<option value="" selected disabled>حدد المنتج</option>'
                        );

                        if (!response || response.length === 0) {

                            product.append(
                                '<option value="" disabled>لا توجد منتجات في هذا القسم</option>'
                            );

                            product.prop('disabled', true);

                            return;
                        }

                        $.each(response, function (index, item) {

                            product.append(
                                $('<option>', {
                                    value: item.id,
                                    text: item.product_name
                                }).attr('data-price', item.product_price)
                            );

                        });

                        product.prop('disabled', false);
                    },

                    error: function () {

                        product.html(
                            '<option value="" selected disabled>تعذر تحميل المنتجات</option>'
                        );

                        product.prop('disabled', true);

                        alert('حدث خطأ أثناء تحميل المنتجات.');
                    }

                });

            });


            /*
             * ==========================================================
             * اختيار المنتج
             * ==========================================================
             */

            $('#product_id').on('change', function () {

                const productId = $(this).val();

                if (!productId) {
                    return;
                }

                /*
                 * السعر سيتم جلبه من endpoint المنتجات.
                 * مؤقتًا نحتاج endpoint يرجع product_price.
                 */
            });


            /*
             * ==========================================================
             * إضافة المنتج
             * ==========================================================
             */

            $('#addProductBtn').on('click', function () {

                const productId = $('#product_id').val();
                const productName =
                    $('#product_id option:selected').text().trim();

                const quantity =
                    parseInt($('#item_quantity').val()) || 0;

                const saleType =
                    $('#sale_type').val();


                if (!saleType) {

                    alert('يرجى تحديد نوع البيع أولاً');

                    return;
                }


                if (!productId) {

                    alert('يرجى تحديد المنتج أولاً');

                    return;
                }


                if (quantity < 1) {

                    alert('الكمية يجب أن تكون 1 على الأقل');

                    return;
                }


                /*
                 * منع إضافة نفس المنتج أكثر من مرة.
                 */

                const existingItem = contractItems.find(
                    function (item) {
                        return item.product_id == productId;
                    }
                );

                if (existingItem) {

                    alert('هذا المنتج مضاف بالفعل إلى العقد.');

                    return;
                }


                /*
                 * في هذه المرحلة السعر يحتاج أن يأتي من بيانات المنتج.
                 *
                 * سيتم استكماله بمجرد ربط endpoint المنتجات
                 * بإرجاع product_price.
                 */

                const productPrice =
                    parseFloat(
                        $('#product_id option:selected').data('price')
                    ) || 0;


                if (productPrice <= 0) {

                    alert('لم يتم الحصول على سعر المنتج.');

                    return;
                }


                const item = {

                    product_id: productId,

                    product_name: productName,

                    quantity: quantity,

                    cash_product_price: productPrice,

                    cash_total: 0,

                    interest_rate:
                        saleType === 'cash' ? 0 : 0,

                    interest_amount: 0,

                    administrative_fees: 0,

                    installment_total: 0,

                    installment_months:
                        saleType === 'cash' ? 0 : 0

                };


                calculateItem(item);

                contractItems.push(item);

                currentItemIndex =
                    contractItems.length - 1;


                renderItemsTable();
                renderHiddenInputs();
                calculateSummary();

                openProductDetails(currentItemIndex);

            });


            /*
             * ==========================================================
             * فتح تفاصيل المنتج
             * ==========================================================
             */

            function openProductDetails(index) {

                const item = contractItems[index];

                if (!item) {
                    return;
                }

                currentItemIndex = index;

                $('#current_item_index').val(index);
                $('#current_product_id').val(item.product_id);
                $('#current_product_name').val(item.product_name);

                $('#detail_product_name')
                    .val(item.product_name);

                $('#detail_cash_product_price')
                    .val(formatMoney(item.cash_product_price));

                $('#detail_cash_total')
                    .val(formatMoney(item.cash_total));

                $('#detail_interest_rate')
                    .val(formatMoney(item.interest_rate));

                $('#detail_interest_amount')
                    .val(formatMoney(item.interest_amount));

                $('#detail_administrative_fees')
                    .val(formatMoney(item.administrative_fees));

                $('#detail_installment_months')
                    .val(item.installment_months);

                $('#detail_installment_total')
                    .val(formatMoney(item.installment_total));

                $('#productDetailsSection').show();

                $('html, body').animate({
                    scrollTop: $('#productDetailsSection').offset().top - 100
                }, 300);
            }


            /*
             * ==========================================================
             * تغيير نسبة الفائدة
             * ==========================================================
             */

            $('#detail_interest_rate').on('input', function () {

                if (currentItemIndex === null) {
                    return;
                }

                const item =
                    contractItems[currentItemIndex];

                if (!item) {
                    return;
                }

                item.interest_rate =
                    parseFloat($(this).val()) || 0;

                calculateItem(item);

                $('#detail_interest_amount')
                    .val(formatMoney(item.interest_amount));

                $('#detail_installment_total')
                    .val(formatMoney(item.installment_total));

            });


            /*
             * ==========================================================
             * تغيير المصاريف الإدارية
             * ==========================================================
             */

            $('#detail_administrative_fees').on('input', function () {

                if (currentItemIndex === null) {
                    return;
                }

                const item =
                    contractItems[currentItemIndex];

                if (!item) {
                    return;
                }

                item.administrative_fees =
                    parseFloat($(this).val()) || 0;

                calculateItem(item);

                $('#detail_installment_total')
                    .val(formatMoney(item.installment_total));

            });


            /*
             * ==========================================================
             * تغيير مدة التقسيط
             * ==========================================================
             */

            $('#detail_installment_months').on('input', function () {

                if (currentItemIndex === null) {
                    return;
                }

                const item =
                    contractItems[currentItemIndex];

                if (!item) {
                    return;
                }

                item.installment_months =
                    parseInt($(this).val()) || 0;

            });


            /*
             * ==========================================================
             * حفظ تفاصيل المنتج
             * ==========================================================
             */

            $('#saveProductDetailsBtn').on('click', function () {

                if (currentItemIndex === null) {
                    return;
                }

                const item =
                    contractItems[currentItemIndex];

                if (!item) {
                    return;
                }


                const saleType =
                    $('#sale_type').val();


                item.interest_rate =
                    parseFloat($('#detail_interest_rate').val()) || 0;


                item.administrative_fees =
                    parseFloat($('#detail_administrative_fees').val()) || 0;


                item.installment_months =
                    parseInt($('#detail_installment_months').val()) || 0;


                /*
                 * البيع النقدي لا يحتوي على فائدة أو مدة تقسيط.
                 */

                if (saleType === 'cash') {

                    item.interest_rate = 0;
                    item.interest_amount = 0;
                    item.installment_months = 0;

                }


                calculateItem(item);

                renderItemsTable();
                renderHiddenInputs();
                calculateSummary();


                $('#productDetailsSection').hide();

                currentItemIndex = null;

                $('#current_item_index').val('');

            });


            /*
             * ==========================================================
             * تعديل منتج
             * ==========================================================
             */

            $(document).on('click', '.edit-item', function () {

                const index =
                    parseInt($(this).data('index'));

                openProductDetails(index);

            });


            /*
             * ==========================================================
             * حذف منتج
             * ==========================================================
             */

            $(document).on('click', '.delete-item', function () {

                const index =
                    parseInt($(this).data('index'));

                if (!confirm('هل أنت متأكد من حذف هذا المنتج من العقد؟')) {
                    return;
                }

                contractItems.splice(index, 1);

                renderItemsTable();
                renderHiddenInputs();
                calculateSummary();

                $('#productDetailsSection').hide();

                currentItemIndex = null;

            });


            /*
             * ==========================================================
             * المقدم
             * ==========================================================
             */

            $('#down_payment').on('input', function () {

                calculateRemaining();

            });


            /*
             * ==========================================================
             * نسبة العمولة
             * ==========================================================
             */

            $('#commission_rate').on('input', function () {

                calculateCommission();

            });


            /*
             * ==========================================================
             * غرامة التأخير
             * ==========================================================
             */

            $('#late_fee_type').on('change', function () {

                if (!$(this).val()) {

                    $('#late_fee_value').val('');

                }

            });


            /*
             * ==========================================================
             * منع المقدم من تجاوز الإجمالي على مستوى UI
             * ==========================================================
             */

            $('#down_payment').on('blur', function () {

                const installmentTotal =
                    parseFloat($('#installment_total').val()) || 0;

                let downPayment =
                    parseFloat($(this).val()) || 0;


                if (downPayment > installmentTotal) {

                    downPayment = installmentTotal;

                    $(this).val(
                        formatMoney(downPayment)
                    );

                }

                calculateRemaining();

            });


            /*
             * ==========================================================
             * قبل Submit
             * ==========================================================
             */

            $('form[action="{{ route('contracts.store') }}"]').on('submit', function (event) {

                renderHiddenInputs();

                if (contractItems.length === 0) {

                    event.preventDefault();

                    alert('يجب إضافة منتج واحد على الأقل إلى العقد.');

                    return false;
                }


                /*
                 * لا نعتمد على حسابات JavaScript كمصدر للحقيقة.
                 * Controller سيعيد الحساب والتحقق من القيم.
                 */

            });


            /*
             * ==========================================================
             * Initial State
             * ==========================================================
             */

            calculateSummary();

        });
    </script>

@endsection