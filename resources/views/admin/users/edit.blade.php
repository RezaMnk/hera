@extends('admin.layouts.app')


@section('title', 'ویرایش کاربر به شناسه '. $user->id)

@section('content')
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">اطلاعات کاربر</h6>
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method("PATCH")

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">نام</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">شماره تلفن</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}">

                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">کلمه عبور</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="کلمه عبور جدید">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">تکرار کلمه عبور</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="تکرار کلمه عبور جدید">

                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admin" id="admin" {{ $user->admin ? 'checked' : '' }}>
                                    <label class="form-check-label" for="admin">
                                        مدیر سایت
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">بروزرسانی</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light-dark">لغو</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
