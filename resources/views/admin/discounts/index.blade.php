@extends('admin.layouts.app')

@section('title', 'کد تخفیف ها')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <div class="row align-items-end">
                    <div class="col-12">
                        <form class="d-flex justify-content-end">
                            <label for="search">جستجو:
                                <input type="search" id="search" class="form-control form-control-sm" name="search" value="{{ request('search') ?? '' }}">
                            </label>
                        </form>
                    </div>
                </div>
                <div class="row">
                @if(isset($discount))
                    <form action="{{ route('admin.discounts.update', $discount->id) }}" method="post" class="col-12 col-lg-5" enctype="multipart/form-data">
                        @method('PATCH')
                @else
                    <form action="{{ route('admin.discounts.store') }}" method="post" class="col-12 col-lg-5" enctype="multipart/form-data">
                @endif
                    @csrf

                        <div class="row">
                            <div class="col-12">
                                <h6 class="card-title">ایجاد / تغییر کد تخفیف</h6>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام کد</label>
                                    <input name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="نام کد تخفیف" type="text" @if(isset($discount)) value="{{ old('name') ?? $discount->name }}" @endif>

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-4">
                                    <label for="expire_at">تاریخ انقضا</label>
                                    <input type="text" name="expire_at" class="form-control text-left @error('expire_at') is-invalid @enderror" placeholder="تاریخ انقضا" dir="ltr" id="expire_at" @if(isset($discount)) value="{{ old('expire_at') ?? jdate($discount->expire_at)->format('Y/m/d') }}" @endif>

                                    @error('expire_at')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type">نوع</label>
                                    <select class="custom-select @error('type') is-invalid @enderror" id="type" name="type">
                                        <option value="percent" @selected(old('type') ? old('type') == 'percent' : (isset($discount) ? $discount->type == 'percent' : ''))>درصد</option>
                                        <option value="static" @selected(old('type') ? old('type') == 'static' : (isset($discount) ? $discount->type == 'static' : ''))>مقدار ثابت</option>
                                    </select>

                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="value">مقدار</label>
                                    <input name="value" id="value" class="form-control @error('value') is-invalid @enderror" placeholder="مقدار" type="text" @if(isset($discount)) value="{{ old('value') ?? $discount->value }}" @endif>

                                    @error('value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">افزودن کد تخفیف</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12 col-lg-7 mt-5 table-responsive">
                        <table class="table table-striped table-bordered dtr-inline" role="grid" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th>نام</th>
                                <th>مقدار</th>
                                <th>زمان ایجاد</th>
                                <th>تاریخ انقضا</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($discounts as $k => $discount)
                                <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>
                                        {{ $discount->name }}
                                    </td>
                                    <td>
                                        {{ $discount->value }}
                                        @if($discount->type == 'static')
                                            تومان
                                        @elseif($discount->type == 'percent')
                                            درصد
                                        @endif
                                    </td>
                                    <td>
                                        {{ $discount->created_at() }}
                                    </td>
                                    <td>
                                        {{ $discount->expire_at() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.discounts.edit', $discount->id) }}">
                                            <button type="button" class="btn btn-warning btn-floating">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-floating" onclick="document.getElementById('delete-submit').value = {{ $discount->id }}" data-toggle="modal" data-target="#delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr role="row">
                                    <td colspan="5">
                                        کد تخفیفی یافت نشد!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $discounts->withQueryString()->links('vendor.pagination.admin', ['search' => request('search')]) }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف کد تخفیف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف کد تخفیف مطمئنید ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">لغو</button>
                    <form action="{{ route('admin.discounts.destroy') }}" method="post">
                        @csrf
                        <button type="submit" name="id" value="0" id="delete-submit" class="btn btn-danger">
                            <i class="fa fa-check m-r-5"></i>
                            حذف کد تخفیف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header-assets')
    <link rel="stylesheet" href="{{ asset('admin/vendors/datepicker-jalali/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/datepicker/daterangepicker.css') }}">
@endsection

@section('footer-assets')
    <script src="{{ asset('admin/vendors/datepicker-jalali/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datepicker/daterangepicker.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#expire_at').datepicker({
                dateFormat: "yy/mm/dd",
                showOtherMonths: true,
                selectOtherMonths: true,
                minDate: 0,
            });
        });
    </script>
@endsection
