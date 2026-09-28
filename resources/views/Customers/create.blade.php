@extends('layouts.master')

@section('css')

@endsection

@section('title', 'إضافة عميل')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة عميل</span>
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

                <div class="card-header">
                    <h4 class="card-title mb-0">إضافة عميل</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('customers.store') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf

                    {{-- 1 --}}
                    <div class="row">
                        <div class="col">
                            <label for="name" class="control-label">
                                اسم العميل <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                placeholder="أدخل اسم العميل" required>
                        </div>

                        <div class="col">
                            <label for="phone" class="control-label">
                                رقم الهاتف <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                                placeholder="أدخل رقم الهاتف" required>
                        </div>

                        <div class="col">
                            <label for="secondary_phone" class="control-label">
                                رقم هاتف إضافي
                            </label>

                            <input type="text" class="form-control" id="secondary_phone" name="secondary_phone"
                                value="{{ old('secondary_phone') }}" placeholder="رقم هاتف إضافي">
                        </div>

                    </div>

                    <br>

                    {{-- 2 --}}
                    <div class="row">

                        <div class="col">
                            <label for="national_id" class="control-label">
                                الرقم القومي <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="national_id" name="national_id" value="{{ old('national_id') }}"
                                placeholder="أدخل الرقم القومي" required>
                        </div>

                        <div class="col">
                            <label for="date_of_birth" class="control-label">
                                تاريخ الميلاد
                            </label>

                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth') }}">
                        </div>

                    </div>

                    <br>

                    {{-- 3 --}}
                    <div class="row">

                        <div class="col">
                            <label for="national_id_front" class="control-label">
                                صورة وجه البطاقة
                            </label>

                            <input type="file" class="form-control" id="national_id_front" name="national_id_front"
                                accept="image/jpeg,image/png,image/webp">

                            <small class="text-muted">
                                صورة واضحة للوجه الأمامي للبطاقة
                            </small>
                        </div>

                        <div class="col">
                            <label for="national_id_back" class="control-label">
                                صورة ظهر البطاقة
                            </label>

                            <input type="file" class="form-control" id="national_id_back" name="national_id_back"
                                accept="image/jpeg,image/png,image/webp">

                            <small class="text-muted">
                                صورة واضحة للوجه الخلفي للبطاقة
                            </small>
                        </div>

                    </div>

                    <br>

                    {{-- 4 --}}
                    <div class="row">

                        <div class="col">
                            <label for="address" class="control-label">
                                العنوان <span class="text-danger">*</span>
                            </label>

                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                        </div>

                    </div>
                        <br>

                        {{-- 5 --}}
                        <div class="row">

                            <div class="col">
                                <label for="job" class="control-label">المهنة</label>

                                <input type="text" class="form-control" id="job" name="job" value="{{ old('job') }}">
                            </div>

                            <div class="col">
                                <label for="workplace" class="control-label">جهة العمل</label>

                                <input type="text" class="form-control" id="workplace" name="workplace"
                                    value="{{ old('workplace') }}">
                            </div>

                        </div>
                        <br>

                        {{-- 6 --}}
                        <div class="row">

                            <div class="col">
                                <label for="emergency_contact_name" class="control-label">
                                    اسم شخص للطوارئ
                                </label>

                                <input type="text" class="form-control" id="emergency_contact_name"
                                    name="emergency_contact_name" value="{{ old('emergency_contact_name') }}">
                            </div>

                            <div class="col">
                                <label for="emergency_contact_phone" class="control-label">
                                    هاتف شخص للطوارئ
                                </label>

                                <input type="text" class="form-control" id="emergency_contact_phone"
                                    name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}">
                            </div>

                            <div class="col">
                                <label for="emergency_contact_relation" class="control-label">
                                    صلة القرابة
                                </label>

                                <input type="text" class="form-control" id="emergency_contact_relation"
                                    name="emergency_contact_relation" value="{{ old('emergency_contact_relation') }}">
                            </div>

                        </div>
                        <br>

                        {{-- 7 --}}
                        <div class="row">
                            <div class="col">
                                <label for="additional_data" class="control-label">
                                    بيانات إضافية
                                </label>

                                <textarea class="form-control" id="additional_data" name="additional_data"
                                    rows="3">{{ old('additional_data') }}</textarea>
                            </div>

                            <div class="col">
                                <label for="notes" class="control-label">
                                    ملاحظات
                                </label>

                                <textarea class="form-control" id="notes" name="notes"
                                    rows="3">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <br>

                        {{-- 8 --}}
                        <div class="row">

                            <div class="col">
                                <label for="is_active" class="control-label">
                                    حالة العميل
                                </label>

                                <select name="is_active" id="is_active" class="form-control">

                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                                        نشط
                                    </option>

                                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                                        غير نشط
                                    </option>

                                </select>
                            </div>

                        </div>
                        <br>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary">
                                حفظ العميل
                            </button>

                            <a href="{{ route('customers.index') }}" class="btn btn-secondary mr-2">
                                إلغاء
                            </a>

                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection



@section('js')


@endsection