@extends('home.layouts.app')

@section('title', 'تعیین کلمه عبور')

@section('breadcrumb')
    <x-breadcrumb title="تعیین کلمه عبور" desc="کلمه عبور خود را تعیین کنید" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="auth-form">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="password">کلمه عبور جدید</label>
                                <input type="password" placeholder="کلمه عبور جدید" name="password" id="password" required @error('password') class="is-invalid" @enderror autocomplete="password" autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 ">
                                <label for="confirm-password">تکرار کلمه عبور جدید</label>
                                <input type="password" placeholder="تکرار کلمه عبور جدید" name="password_confirmation" id="confirm-password" required @error('password_confirmation') class="is-invalid" @enderror autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input type="submit" value="تغییر کلمه عبور">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6 d-none d-lg-block welcome-image" style="background-image: url('{{ asset('assets/img/password.jpg') }}')"></div>
        </div>
    </div>
@endsection
