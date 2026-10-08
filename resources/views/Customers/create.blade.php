@extends('layouts.master')

@section('title', 'إضافة عميل')

@section('css')
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex align-items-center">
                <h4 class="content-title mb-0 my-auto">
                    العملاء </h4>


                <span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    / إضافة عميل
                </span>
            </div>
        </div>
    </div>


@endsection

@section('content')


    <div class="row row-sm">
        <div class="col-xl-12">

            <div class="card mg-b-20">

                <div class="card-body">

                    {{-- Alerts --}}
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

                    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">

                        @csrf

                        {{-- Basic Information --}}
                        <div class="border-bottom pb-2 mb-4">
                            <h6 class="font-weight-bold mb-1">
                                البيانات الأساسية
                            </h6>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">
                                        اسم العميل
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="أدخل اسم العميل" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">
                                        رقم الهاتف
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" placeholder="أدخل رقم الهاتف" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="secondary_phone">
                                        رقم هاتف إضافي
                                    </label>

                                    <input type="text" class="form-control" id="secondary_phone" name="secondary_phone"
                                        value="{{ old('secondary_phone') }}" placeholder="رقم هاتف إضافي">
                                </div>
                            </div>

                        </div>

                        {{-- Identity --}}
                        <div class="border-bottom pb-2 mb-4 mt-3">
                            <h6 class="font-weight-bold mb-1">
                                بيانات الهوية
                            </h6>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="national_id">
                                        الرقم القومي
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" id="national_id" name="national_id"
                                        value="{{ old('national_id') }}" placeholder="أدخل الرقم القومي" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">
                                        تاريخ الميلاد
                                    </label>

                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="national_id_front">
                                        صورة وجه البطاقة
                                    </label>

                                    <input type="file" class="form-control" id="national_id_front" name="national_id_front"
                                        accept="image/jpeg,image/png,image/webp">

                                    <small class="text-muted">
                                        الصورة الأمامية للبطاقة
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="national_id_back">
                                        صورة ظهر البطاقة
                                    </label>

                                    <input type="file" class="form-control" id="national_id_back" name="national_id_back"
                                        accept="image/jpeg,image/png,image/webp">

                                    <small class="text-muted">
                                        الصورة الخلفية للبطاقة
                                    </small>
                                </div>
                            </div>

                        </div>

                        {{-- Address & Work --}}
                        <div class="border-bottom pb-2 mb-4 mt-3">
                            <h6 class="font-weight-bold mb-1">
                                بيانات العنوان والعمل
                            </h6>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">
                                        العنوان
                                        <span class="text-danger">*</span>
                                    </label>

                                    <textarea class="form-control" id="address" name="address" rows="3"
                                        placeholder="أدخل عنوان العميل" required>{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job">
                                        المهنة
                                    </label>

                                    <input type="text" class="form-control" id="job" name="job" value="{{ old('job') }}"
                                        placeholder="أدخل المهنة">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="workplace">
                                        جهة العمل
                                    </label>

                                    <input type="text" class="form-control" id="workplace" name="workplace"
                                        value="{{ old('workplace') }}" placeholder="أدخل جهة العمل">
                                </div>
                            </div>

                        </div>

                        {{-- Emergency Contact --}}
                        <div class="border-bottom pb-2 mb-4 mt-3">
                            <h6 class="font-weight-bold mb-1">
                                بيانات شخص للطوارئ
                            </h6>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_contact_name">
                                        اسم شخص للطوارئ
                                    </label>

                                    <input type="text" class="form-control" id="emergency_contact_name"
                                        name="emergency_contact_name" value="{{ old('emergency_contact_name') }}"
                                        placeholder="اسم الشخص">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_contact_phone">
                                        هاتف شخص للطوارئ
                                    </label>

                                    <input type="text" class="form-control" id="emergency_contact_phone"
                                        name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}"
                                        placeholder="رقم الهاتف">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_contact_relation">
                                        صلة القرابة
                                    </label>

                                    <input type="text" class="form-control" id="emergency_contact_relation"
                                        name="emergency_contact_relation" value="{{ old('emergency_contact_relation') }}"
                                        placeholder="صلة القرابة">
                                </div>
                            </div>

                        </div>

                        {{-- Additional Information --}}
                        <div class="border-bottom pb-2 mb-4 mt-3">
                            <h6 class="font-weight-bold mb-1">
                                معلومات إضافية
                            </h6>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="additional_data">
                                        بيانات إضافية
                                    </label>

                                    <textarea class="form-control" id="additional_data" name="additional_data" rows="4"
                                        placeholder="أدخل أي بيانات إضافية">{{ old('additional_data') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notes">
                                        ملاحظات
                                    </label>

                                    <textarea class="form-control" id="notes" name="notes" rows="4"
                                        placeholder="أدخل الملاحظات">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                        </div>

                        {{-- Status --}}
                        <div class="row align-items-end mt-3">

                            <div class="col-md-4">
                                <div class="form-group mb-0">

                                    <label for="is_active">
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

                        </div>

                        {{-- Actions --}}
                        <div class="border-top pt-4 mt-4">

                            <div class="d-flex justify-content-end">

                                <a href="{{ route('customers.index') }}" class="btn btn-secondary mr-2">
                                    إلغاء
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save ml-1"></i>
                                    حفظ العميل
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection

@section('js')
@endsection