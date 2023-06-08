@extends('home.layouts.invoice')


@section('title', 'صورت حساب')

@section('content')
    <div class="card" id="section-to-print">

        <div class="card-body p-md-50">
            <div class="invoice">
                <div class="row">
                    <h2 class="col-6 offset-3 col-md-2 offset-md-0">
                        <a href="{{ route('home.home') }}">
                            <img class="m-r-20 w-100" src="{{ asset('assets/img/logo.png') }}" alt="image">
                        </a>
                    </h2>
                    <div class="col-12 col-md-10 justify-content-center justify-content-md-end d-flex align-items-center">
                        <div>
                            <h3 class="text-xs-left mb-0">صورتحساب #{{ $order->id }}</h3>
                            <h5 class="text-xs-left mb-0 text-secondary">شماره تراکنش:  {{ ltrim($order->transaction_id, '0') }}</h5>
                        </div>
                    </div>

                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="text-center text-md-left">
                            <b>کاربر</b>
                        </p>
                        <p class="text-center text-md-left mb-1">
                            <b>نام: </b> {{ $order->user->name }}
                        </p>
                        <p class="text-center text-md-left">
                            <b>شماره تماس: </b> {{ $order->user->phone }}
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="text-center text-md-right">
                            <b>صورتحساب به</b>
                        </p>
                        <p class="text-center text-md-right">
                            استان تهران <br>
                            شهر تهران <br>
                            آدرس: {{ $order->map->address() }}
                        </p>
                    </div>
                </div>
                <hr class="d-md-none">

                <div class="table-responsive">
                    <div class="d-block d-md-none">
                        @php($total = 0)
                        @foreach($order->products as $product)
                            @php($total += $product->price * $product->pivot->quantity)
                        <div class="row">
                            <div class="col-5 align-self-center">
                                <img src="{{ $product->get_image() }}" class="w-100" alt="product">
                            </div>
                            <div class="col-7">
                                <h5>{{ $product->name }}</h5>
                                 <p>{{ number_format($product->price) }} × {{ $product->pivot->quantity }} = {{ number_format($product->price * $product->pivot->quantity) }} تومان</p>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        @if($order->discount)
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h5>کد تخفیف: {{ $order->discount->name }}</h5>
                                        <p>{{ number_format($order->discount_value) }} تومان</p>
                                    </div>
                                </div>
                                <hr>
                        @endif
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>هزینه ارسال</h5>
                                    <p>{{ number_format(setting('shipping_price')) }} تومان</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>۹% مالیات</h5>
                                    <p>{{ number_format($total * 9/100) }} تومان</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="font-weight-bold">جمع فاکتور</h4>
                                    <h5>{{ number_format($order->total_price) }} تومان</h5>
                                </div>
                            </div>
                    </div>

                    <table class="table m-t-b-50 d-md-table d-none">
                        <thead>
                        <tr class="bg-dark text-white print-text-black">
                            <th>#</th>
                            <th>تصویر محصول</th>
                            <th>نام محصول</th>
                            <th>قیمت (تومان)</th>
                            <th>تعداد</th>
                            <th>کل (تومان)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr class="text-right">
                                <td class="text-left">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-left">
                                    <img src="{{ $product->get_image() }}" width="50px">
                                </td>
                                <td class="text-left">
                                    {{ $product->name }}
                                </td>
                                <td class="text-left">
                                    {{ number_format($product->price) }}
                                </td>
                                <td class="text-left">
                                    <p class="m-0">{{ $product->pivot->quantity }} عدد</p>
                                </td>
                                <td class="text-left">
                                    {{ number_format($product->price * $product->pivot->quantity) }}
                                </td>
                            </tr>
                        @endforeach
                        @if($order->discount)
                            <tr class="text-right bg-secondary-bright">
                                <td></td>
                                <td></td>
                                <td class="text-left">
                                    کد تخفیف: {{ $order->discount->name }}
                                </td>
                                <td></td>
                                <td></td>
                                <td class="text-left">
                                    {{ number_format($order->discount_value) }}
                                </td>
                            </tr>
                        @endif
                        <tr class="text-right">
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                هزینه ارسال
                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                {{ number_format(setting('shipping_price')) }}
                            </td>
                        </tr>
                        <tr class="text-right">
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                ۹% مالیات
                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                {{ number_format($total * 9/100) }}
                            </td>
                        </tr>
                        <tr class="text-right">
                            <td></td>
                            <td></td>
                            <td class="text-left font-weight-bold">
                                جمع فاکتور
                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-left font-weight-bold">
                                {{ number_format($order->total_price) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <p class="text-center small text-muted m-t-50">
                    <span class="row">
                        <span class="col-md-6 offset-md-3">
                            تهیه غذای قریشی، بزرگترین تهیه غذای ایرانی
                        </span>
                    </span>
                </p>
            </div>
            <div class="text-right d-print-none">
                <hr class="my-5">
                <a href="javascript:window.print()" class="btn btn-light m-l-5 my-1">
                    <i class="fa fa-print m-r-5"></i>چاپ
                </a>
                <a href="{{ $order->get_location() }}" target="_blank" class="btn btn-success m-l-5 my-1">
                    <i class="fa fa-location-arrow m-r-5"></i>مسیریابی
                </a>
                <a href="{{ route('home.profile', ['#orders']) }}" class="btn btn-danger m-l-5 my-1">
                    <i class="fa fa-home m-r-5"></i>
                    بازگشت به سایت
                </a>
            </div>
        </div>
    </div>
@endsection

@include('admin.layouts.sections.footer-scripts')
