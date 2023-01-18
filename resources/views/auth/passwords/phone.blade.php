@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3 p-3 border-bottom-gray">
                    <h3 class="card-header">بازیابی کلمه عبور</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}">

                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="phone">{{ __('Phone') }}</label>
                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror form-control bg-dark border border-light" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-5">
                            <div class="col-md-12">
                                <x-recaptcha :has-error="$errors->has('g-recaptcha-response')"></x-recaptcha>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary border border-primary">
                                    تایید شماره
                                </button>
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                                    بازگشت
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
