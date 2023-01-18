@extends('admin.layouts.app')

@section('header-assets')
    <link rel="stylesheet" href="{{ asset('admin/vendors/dropzone/dropzone.css') }}">
    <!-- TODO : all cdns should be local  -->
    <link rel="stylesheet" href="{{ asset('admin/css/izmir.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/select2/css/select2.min.css') }}">

@endsection


@section('title', 'ویرایش سفارش')

@section('content')
    <!-- row : start  -->

        @if($order->status == 'unapproved')
            <form action="{{ route('admin.orders.update', $order->id) }}" method="post" class="card">
                @csrf
                @method('patch')
        @elseif($order->status == 'paid')
            <form action="{{ route('admin.orders.approve') }}" method="post" class="card">
                @csrf
                @method('patch')
        @elseif($order->status == 'approved')
            <form action="{{ route('admin.orders.deliver') }}" method="post" class="card">
                @csrf
                @method('patch')
        @else
            <form action="#" class="card">
        @endif

        <div class="card-body p-50" id="section-to-print">
            <div class="invoice">
                <div class="d-md-flex justify-content-between align-items-center">
                    <h2 class="d-flex align-items-center">
                        <img class="m-r-20" src="{{ asset('storage/logo/18.png') }}" alt="image">
                    </h2>
                    <div>
                        <h3 class="text-xs-left mb-0">صورتحساب #{{ $order->id }}</h3>
                        <p class="text-xs-left mb-0">وضعیت:
                            @switch($order->status)
                                @case('unapproved')
                                    در انتظار بررسی
                                    @break
                                @case('priced')
                                    در انتظار پرداخت
                                    @break
                                @case('paid')
                                    پرداخت شده
                                    @break
                                @case('approved')
                                    تایید شده
                                    @break
                                @case('delivered')
                                    تحویل داده شد
                                    @break
                                @case('completed')
                                    تکمیل شده
                                    @break
                                @case('canceled')
                                    لغو شده
                                    @break
                            @endswitch
                        </p>
                        <p class="text-xs-left m-t-2">نحوه تسویه:
                            @switch($order->order_type)
                                @case('gold')
                                    مبادله طلا
                                    @break
                                @case('cash')
                                    نقدی
                                    @break
                                @case('credit')
                                    نسیه
                                    @break
                            @endswitch
                        </p>
                    </div>
                </div>
                <hr class="m-t-b-50">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>فروشنده :</b>
                        </p>
                        <p>استان تهران<br>
                            شهر تهران<br>
                            خیابان پانزده خرداد، بازار بزرگ تهران، ‌پاساژ خرداد، طبقه اول، پلاک ۱۰۱
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-right">
                            <b>صورتحساب به</b>
                        </p>
                        <p class="text-right">
                            استان {{ $order->user->province }} <br>
                            شهر {{ $order->user->city }} <br>
                            آدرس: {{ $order->user->city }}
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table m-t-b-50">
                        <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>تصویر محصول</th>
                            <th>نام محصول</th>
                            <th>تعداد</th>
                            <th style="width: 30%"></th>

{{--                            TODO: Version Change -> No Api    --}}
{{--                            <th>قیمت</th> --}}
{{--                            <th style="width: 25%" class="text-right">جمع</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                                <tr class="text-right">
                                    <td class="text-left">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-left">
                                        <img src="{{ $product->featuring_image()->image_url }}" width="50px">
                                    </td>
                                    <td class="text-left">
                                        {{ $product->name }}
                                    </td>
                                    <td class="text-left">
                                        @if($order->status == 'unapproved')
                                            <input type="number" class="form-control amount" data-id="{{ $loop->iteration }}" name="quantity[{{ $product->id }}]" required="required" autocomplete="off" value="{{ $product->pivot->quantity }}">
                                        @else
                                            <p class="form-control m-0">{{ $product->pivot->quantity }}</p>
                                        @endif
                                    </td>
{{--                                    TODO: Version Change -> No Api--}}
{{--                                    <td class="text-left">--}}
{{--                                        <div class="input-group">--}}
{{--                                            @if($order->status == 'unapproved')--}}
{{--                                                <input type="number" class="form-control text-left product-price" data-id="{{ $loop->iteration }}" name="price[{{ $product->id }}]" required="required" autocomplete="off">--}}
{{--                                            @else--}}
{{--                                                <p class="form-control text-left">{{ $product->pivot->price ? number_format($product->pivot->price) : 'قیمت تعیین نشده' }}</p>--}}
{{--                                            @endif--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text">ریال</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td data-id="{{ $loop->iteration }}">--}}
{{--                                        {{ number_format($product->pivot->quantity * $product->pivot->price) ?? '0'}}--}}
{{--                                        ریال--}}
{{--                                    </td>--}}
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
{{--                TODO: Version Change -> No Api--}}
{{--                <div class="text-right">--}}
{{--                    <p>جمع مبالغ: <span id="total_price">{{ number_format($order->total_price) ?? '0'}} ریال</span></p>--}}
{{--                    <p>مالیات (0%): 0 ریال</p>--}}
{{--                    <h4 class="primary-font">جمع: <span id="total_price_with_tax">{{ number_format($order->total_price) ?? '0'}} ریال</span></h4>--}}
{{--                </div>--}}
                <p class="text-center small text-muted  m-t-50">
                    <span class="row">
                        <span class="col-md-6 offset-md-3">
                            بنکداری طلای محمد، اولین و بزرگترین فروشنده عمده طلا در ایران
                        </span>
                    </span>
                </p>
            </div>
            <div class="text-right d-print-none">
                <hr class="m-t-b-50">
                @if($order->status == 'unapproved')
                    <button type="submit" class="btn btn-primary my-1">
                        <i class="fa fa-check m-r-5"></i>
                        تایید سفارش
                    </button>
                @elseif($order->status == 'priced')
                    <button type="submit" class="btn btn-danger my-1">
                        <i class="fa fa-close m-r-5"></i>
                        لغو سفارش
                    </button>
                @elseif($order->status == 'paid')
                    <a href="{{ $order->receipt_image }}" class="btn btn-primary my-1" data-fslightbox >
                        <i class="fa fa-clipboard m-r-5"></i>
                        مشاهده رسید پرداخت
                    </a>
                    <button type="submit" name="order" value="{{ $order->id }}" class="btn btn-success m-l-5 my-1">
                        <i class="fa fa-check m-r-5"></i>
                        تایید سفارش
                    </button>
                @elseif($order->status == 'approved')
                    <button type="submit" name="order" value="{{ $order->id }}" class="btn btn-success m-l-5 my-1">
                        <i class="fa fa-check m-r-5"></i>
                        ثبت تحویل داده شده
                    </button>
                @endif
                <a href="javascript:window.print()" class="btn btn-light m-l-5 my-1">
                    <i class="fa fa-print m-r-5"></i> چاپ
                </a>
            </div>
        </div>
    </form>
    <div class="text-danger ltr-text">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
    <!-- row : end -->
@endsection

@section('footer-assets')

    @if($order->status == 'unapproved')
        <script>
            $(document).ready(function () {
                $('.product-price, .amount').on('keyup change', function () {
                    let id = $(this).data('id')
                    let amount = parseInt($('.amount[data-id='+ id +']').val());
                    let price = parseInt($('.product-price[data-id='+ id +']').val());
                    if (price > 0 && price > 0 ) {
                        let total_val = splitnumber(price * amount)

                        $('td[data-id=' + id + ']').html(total_val);

                        let total_price = 0;
                        $('.product-price').each(function () {
                            let this_price = parseInt($(this).val());
                            let this_amount = parseInt($('.amount[data-id='+ $(this).data('id') +']').val());
                            if (typeof this_price === 'number' && typeof this_amount === 'number')
                                total_price += this_price * this_amount;
                        });

                        $('#total_price').html(splitnumber(total_price));
                        $('#total_price_with_tax').html(splitnumber(total_price));
                    }
                })

                function splitnumber(number) {
                    return parseInt(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' ریال';
                }
            })
        </script>
    @elseif($order->receipt)
        <script src="{{ asset('js/fslightbox.js') }}"></script>
    @endif
@endsection

