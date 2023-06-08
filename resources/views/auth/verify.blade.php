@extends('home.layouts.app')

@section('title', 'تایید حساب')

@section('breadcrumb')
    <x-breadcrumb title="تایید حساب" desc="کد تایید دو مرحله ای" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="auth-form">
                    <form method="POST" action="{{ route('2fa.index') }}">
                        @csrf

                        <div class="row mb-5">
                            <div class="col-12">
                                <label for="code">کد تایید دو مرحله ای</label>
                                <input type="text" placeholder="کد تایید" name="code" id="code" required @error('code') class="is-invalid" @enderror autocomplete="code" autofocus>

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-between justify-content-md-start">
                                <input type="submit" value="تایید کد">
                                <a href="{{ route('2fa.previous') }}" class="previous-page ml-3">بازگشت</a>
                            </div>
                            <div class="col-12 col-md-6 text-center text-md-right mt-4 mt-md-0">
                                <div class="row" id="countdown-container">
                                    <p class="col-8">
                                        ارسال مجدد تا
                                    </p>
                                    <span class="col-4" id="countdown">02:00</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6 d-none d-lg-block welcome-image" style="background-image: url('{{ asset('assets/img/password.jpg') }}')"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function () {

            let container = document.querySelector('#countdown-container');
            let display = document.querySelector('#countdown');
            let duration = '120';

            let timer = duration, minutes, seconds;
            let countdownInterval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    container.style.transition = "opacity .2s ease";

                    container.style.opacity = '0';
                    setTimeout(function() {
                        container.innerHTML = `
                        <a class="resend col-12" href="{{ route('2fa.resend') }}">
                            ارسال مجدد
                        </a>
                        `
                        container.style.removeProperty('opacity');
                        container.style.removeProperty('transition');
                    }, 200);
                }
            }, 1000);
        };
    </script>
@endpush
