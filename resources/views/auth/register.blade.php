@extends('home.layouts.app')

@section('title', 'ثبت نام')

@section('breadcrumb')
    <x-breadcrumb title="ثبت نام" desc="فرم ثبت نام در رستوران قریشی" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="auth-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name">نام و نام خانوادگی</label>
                                <input type="text" placeholder="نام" name="name" id="name" required @error('name') class="is-invalid" @enderror autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="phone">شماره تلفن همراه</label>
                                <input type="text" placeholder="شماره تلفن" name="phone" id="phone" required @error('phone') class="is-invalid" @enderror autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6">
                                <label for="phone">کلمه عبور</label>
                                <input type="password" placeholder="کلمه عبور" name="password" id="password" required @error('password') class="is-invalid" @enderror autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="confirm-password">تکرار کلمه عبور</label>
                                <input type="password" placeholder="تکرار کلمه عبور جدید" name="password_confirmation" id="confirm-password" required @error('password_confirmation') class="is-invalid" @enderror autocomplete="new-password">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="submit" value="ثبت نام">
                                <a href="#" class="login">ورود</a>
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
