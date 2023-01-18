@extends('home.layouts.app')

@section('title', 'ورود')

@section('breadcrumb')
    <x-breadcrumb title="ورود" desc="فرم ورود به حساب کاربری" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="auth-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="phone">شماره تلفن همراه</label>
                                <input type="text" placeholder="شماره تلفن" name="phone" id="phone" pattern="09[0-9]{9}" required @error('phone') class="is-invalid" @enderror autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 ">
                                <label for="password">کلمه عبور</label>
                                <input type="password" placeholder="کلمه عبور" name="password" id="password" required @error('password') class="is-invalid" @enderror autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                        مرا به خاطر بسپار
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input type="submit" value="ورود">
                                <a href="#" class="forgot-password">فراموشی کلمه عبور</a>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('register') }}" class="register">ثبت نام</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6 login-image" style="background-image: url('{{ asset('assets/img/a.jpg') }}')"></div>
        </div>
    </div>

    @include('home.layouts.partials.footer')
@endsection
