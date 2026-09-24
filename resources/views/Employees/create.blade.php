@extends('layouts.master')

@section('css')

@endsection

@section('title', 'إضافة موظف')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الموظفون</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة موظف</span>
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
                    <h4 class="card-title mb-0">إضافة موظف</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">

                        @csrf

                        {{-- 1 --}}
                        <div class="row">

                            <div class="col">
                                <label for="name" class="control-label">
                                    اسم الموظف
                                </label>

                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="أدخل اسم الموظف" maxlength="255" required>
                            </div>

                            <div class="col">
                                <label for="email" class="control-label">
                                    البريد الإلكتروني
                                </label>

                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="أدخل البريد الإلكتروني" maxlength="255" required>
                            </div>
                            <div class="col">
                                <label for="phone" class="control-label">
                                    رقم الهاتف
                                </label>

                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="أدخل رقم الهاتف" maxlength="255">
                            </div>
                        </div>

                        <br>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="job_title" class="control-label">
                                    المسمى الوظيفي
                                </label>

                                <input type="text" class="form-control" id="job_title" name="job_title"
                                    value="{{ old('job_title') }}" placeholder="أدخل المسمى الوظيفي" maxlength="255">
                            </div>

                            <div class="col">
                                <label for="attachment" class="control-label">بطاقة الموظف</label>
                                <input type="file" class="form-control" id="attachment" name="attachment"
                                    accept="image/*,.pdf">
                                <small class="text-muted">
                                    صورة البطاقة أو ملف PDF
                                </small>

                            </div>
                        </div>

                        <br>

                        {{-- 3 --}}
                        <div class="row">

                            <div class="col">
                                <label for="password" class="control-label">
                                    كلمة المرور
                                </label>

                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="أدخل كلمة المرور" required>
                            </div>

                            <div class="col">
                                <label for="password_confirmation" class="control-label">
                                    تأكيد كلمة المرور
                                </label>

                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="أعد إدخال كلمة المرور" required>
                            </div>

                        </div>

                        <br>

                        {{-- 4 --}}
                        <div class="row">

                            <div class="col">
                                <label for="is_active" class="control-label">
                                    حالة الموظف
                                </label>

                                <select name="is_active" id="is_active" class="form-control" required>

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
                                حفظ الموظف
                            </button>

                            <a href="{{ route('employees.index') }}" class="btn btn-secondary mr-2">
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