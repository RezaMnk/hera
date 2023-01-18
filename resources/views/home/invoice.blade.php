@extends('home.layouts.invoice')


@section('title', 'صورت حساب')

@section('header-assets')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection

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
                        <h3 class="text-xs-left mb-0">صورتحساب #{{ $order->id }}</h3>
                    </div>

                </div>
                <hr class="my-4">
                <div class="row">
                    <hr class="col-12 d-md-none">
                    <div class="col-12 col-md-6">
                        <p class="text-center text-md-left">
                            <b>صورتحساب به</b>
                        </p>
                        <p class="text-center text-md-left">
                            استان تهران <br>
                            شهر تهران <br>
                            آدرس: {{ $order->map->address() }}
                        </p>
                    </div>
                </div>
                <hr class="d-md-none">

                <div class="table-responsive">
                    <div class="d-block d-md-none">
                        @foreach($order->products as $product)
                        <div class="row">
                            <div class="col-5 align-self-center">
                                <img src="{{ $product->get_image() }}" class="w-100" alt="product">
                            </div>
                            <div class="col-7">
                                <h5>{{ $product->name }}</h5>
                                <div class="row ml-0">
                                    @if($product->pivot->variable)
                                        @foreach(explode(',', $product->pivot->variable) as $attribute_id)
                                            @php($attribute = \App\Models\Attribute::find($attribute_id))
                                            <p class="m-0 font-size-14 col-12">
                                                <span class="font-weight-bold">{{ $attribute->parent->name }}:</span> {{ $attribute->name }}
                                            </p>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
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
                        @php($total = 0)
                        @foreach($order->products as $product)
                            @php($total += $product->price * $product->pivot->quantity)
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
                        </tbody>
                    </table>
                </div>

                <p class="text-center small text-muted m-t-50">
                    <span class="row">
                        <span class="col-md-6 offset-md-3">
                            رستوران قریشی، اولین تهیه غذای آنلاین ایرانی
                        </span>
                    </span>
                </p>
            </div>
            <div class="text-right d-print-none">
                <hr class="my-5">
                <a href="javascript:window.print()" class="btn btn-light m-l-5 my-1">
                    <i class="fa fa-print m-r-5"></i> چاپ
                </a>
                <a href="{{ route('home.home') }}" class="btn btn-danger m-l-5 my-1">
                    <i class="fa fa-home m-r-5"></i>
                    بازگشت به سایت
                </a>
            </div>
        </div>
    </div>
@endsection

@include('admin.layouts.sections.footer-scripts')
