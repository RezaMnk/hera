@extends('home.layouts.app')

@section('title', 'فراموشی کلمه عبور')

@section('breadcrumb')
    <x-breadcrumb title="فراموشی کلمه عبور" desc="فراموشی کلمه عبور با استفاده از شماره همراه" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="auth-form">
                    <form method="POST" action="{{ route('password.phone') }}">
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
                        <div class="row">
                            <div class="col-8">
                                <input type="submit" value="تایید شماره">
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('login') }}" class="login">بازگشت</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6 d-none d-lg-block welcome-image" style="background-image: url('{{ asset('assets/img/welcome.jpg') }}')"></div>
        </div>
    </div>

@endsection
