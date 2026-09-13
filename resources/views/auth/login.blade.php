@extends('layouts.master2')

@section('title')
تسجيل الدخول - فواتير نقاط البيع
@stop

@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">

            <!-- Login Form -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">

                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">

                                <div class="card-sigin">

                                    <div class="mb-5 d-flex">
                                        <a href="{{ route('login') }}">
                                            <img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo">
                                        </a>

                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">
                                            فواتير نقاط البيع
                                        </h1>
                                    </div>

                                    <div class="card-sigin">
                                        <div class="main-signup-header">

                                            <h2>مرحبا بك</h2>
                                            <h5 class="font-weight-semibold mb-4">
                                                تسجيل الدخول
                                            </h5>

                                            {{-- Success Messages --}}
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            {{-- Validation Errors --}}
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="mb-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="form-group">
                                                    <label>البريد الالكتروني</label>

                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>كلمة المرور</label>

                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="d-flex align-items-center justify-content-start mb-3">
                                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="mb-0 mr-2" for="remember">
                                                        تذكرني
                                                    </label>

                                                </div>

                                                @if (Route::has('password.request'))
                                                    <div class="mb-3 text-end">
                                                        <a href="{{ route('password.request') }}">
                                                            نسيت كلمة المرور؟
                                                        </a>
                                                    </div>
                                                @endif

                                                <button type="submit" class="btn btn-main-primary btn-block">
                                                    تسجيل الدخول
                                                </button>

                                            </form>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Image Side -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ asset('assets/img/media/login.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
@endsection