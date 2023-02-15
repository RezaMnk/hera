@extends('home.layouts.app')

@section('title', 'منو')

@section('breadcrumb')
    <x-breadcrumb title="تکمیل سفارش" desc="تکمیل سفارش و ثبت آدرس دریافت" />
@endsection

@section('content')
    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row mb-4">
                <div class="col-8 d-flex align-items-center">
                    <h3>
                        انتخاب آدرس ارسال:
                    </h3>
                </div>
                @if(auth()->user()->maps->count() < 5)
                    <div class="col-4 text-right">
                        <a class="boxed-btn btn-small" data-toggle="modal" onclick="add_map_modal()" data-target="#add">
                            افزودن آدرس
                        </a>
                    </div>
                @endif
            </div>
            <div @class(['card', 'text-danger border-danger' => $errors->has('address')])>
                <div class="card-body">
                    <form action="{{ route('order.store') }}" method="POST" id="choose-address" class="shipping-address-form">
                        @csrf

                        @isset($discount)
                            <input type="hidden" name="discount" value="{{ $discount->name }}">
                        @endisset

                        @forelse(auth()->user()->maps as $map)
                            @unless($loop->first)
                                <hr>
                            @endunless
                            <div class="row py-3">
                                <div class="col-8">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="address-{{ $loop->iteration }}" name="address" value="{{ $map->id }}" class="custom-control-input" @checked($loop->first)>
                                        <label class="custom-control-label" for="address-{{ $loop->iteration }}">
                                            {{ $map->address() }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 text-right">
                                    <a class="address-edit" data-toggle="modal" onclick="update_map_modal({{ $map->id }})" data-target="#edit">
                                        ویرایش
                                    </a>
                                </div>
                            </div>
                        @empty
                            آدرسی یافت نشد! با استفاده از دکمه بالا،‌آدرس جدید ثبت نمایید.
                        @endforelse
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3>
                        خلاصه سفارش:
                    </h3>
                </div>
                <div class="col-12 d-block d-md-none">
                    @forelse(cart()->all() as $cart_item)
                        <div class="cart-item-mobile row mt-4">
                            <div class="col-2 mobile-product-image">
                                <a href="{{ route('home.product', $cart_item['product']->slug) }}">
                                    <img src="{{ $cart_item['product']->get_image() }}" alt="{{ $cart_item['product']->name }}">
                                </a>
                            </div>
                            <div class="col-4 mobile-product-name">
                                <a href="{{ route('home.product', $cart_item['product']->slug) }}">
                                    {{ $cart_item['product']->name }}
                                </a>
                                <span>{{ number_format($cart_item['product']->price) }} تومان</span>
                            </div>
                            <div class="col-2">
                                <div class="checkout-quantity">
                                    تعداد: {{ $cart_item['quantity'] }}
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <div class="checkout-total">
                                    جمع: {{ number_format($cart_item['product']->price * $cart_item['quantity']) }} تومان
                                </div>
                            </div>
                        </div>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <p class="ml-5">
                            سبد خرید خالی می باشد!
                        </p>
                    @endforelse
                </div>
                <div class="col-12 col-lg-8 d-none d-md-block">
                    <div class="cart-table-wrap mt-3">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-image">تصویر</th>
                                <th class="product-name">نام</th>
                                <th class="product-price">قیمت (تومان)</th>
                                <th class="product-quantity">تعداد</th>
                                <th class="product-total">جمع (تومان)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($total = 0)
                            @forelse(cart()->all() as $cart_item)
                                @php($total += $cart_item['product']->price * $cart_item['quantity'])
                                <tr class="table-body-row" data-slug="{{ $cart_item['product']->slug }}">
                                    <td class="product-image">
                                        <a href="{{ route('home.product', $cart_item['product']->slug) }}">
                                            <img src="{{ $cart_item['product']->get_image() }}" alt="">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{ route('home.product', $cart_item['product']->slug) }}">
                                            {{ $cart_item['product']->name }}
                                        </a>
                                    </td>
                                    <td class="product-price">
                                        {{ number_format($cart_item['product']->price) }}
                                    </td>
                                    <td class="product-quantity">
                                        {{ $cart_item['quantity'] }}
                                    </td>
                                    <td class="product-total">
                                        {{ number_format($cart_item['product']->price * $cart_item['quantity']) }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="table-body-row">
                                    <td colspan="6" class="text-left">
                                        <p class="ml-5">
                                            سبد خرید خالی می باشد!
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <tbody>
                            <tr class="total-data">
                                <td>
                                    <strong>جمع کل: </strong>
                                </td>
                                <td id="total-products-price">
                                    {{ number_format($total) }} تومان
                                </td>
                            </tr>
                            <tr class="total-data">
                                <td>
                                    <strong>هزینه ارسال: </strong>
                                </td>
                                <td data-shipping-price="{{ setting('shipping_price') }}">
                                    {{ number_format(setting('shipping_price')) }} تومان
                                </td>
                            </tr>
                            @isset($discount)
                                <tr class="total-data">
                                    <td>
                                        <strong>تخفیف: </strong>
                                        <span class="discount-name">کد: {{ $discount->name }}</span>
                                    </td>
                                    <td>
                                        @if($discount->type == 'percent')
                                            {{ number_format($total * ($discount->value/100)) }} تومان
                                            @php($total = $total - ($total * ($discount->value/100)))

                                        @elseif($discount->type == 'static')
                                            {{ number_format($discount->value) }} تومان
                                            @php($total = $total - $discount->value))

                                        @endif
                                    </td>
                                </tr>
                            @endisset
                            <tr class="total-data">
                                <td>
                                    <strong>هزینه نهایی: </strong>
                                </td>
                                <td id="total-cart-price">
                                    {{ number_format($total + setting('shipping_price')) }} تومان
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <button class="bordered-primary-btn" type="submit" form="choose-address">
                        ثبت سفارش
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->

    <div class="modal fade address-modal" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش آدرس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('map.update', auth()->user()->id) }}" method="post" class="row" id="update-maps">
                        @csrf
                        <input type="hidden" name="lat" id="update-lat">
                        <input type="hidden" name="long" id="update-long">
                        <input type="hidden" name="id" id="update-id">

                        <div class="col-12 col-md-6 mb-3">
                            <label for="update-main_street">
                                خیابان اصلی
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" placeholder="خیابان اصلی" name="main_street" id="update-main_street" required class="address-data @error('main_street') is-invalid @enderror">

                            @error('main_street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="update-side_street">خیابان فرعی</label>
                            <input type="text" placeholder="خیابان فرعی" name="side_street" id="update-side_street" class="address-data @error('side_street') is-invalid @enderror">

                            @error('side_street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="update-alley">کوچه</label>
                            <input type="text" placeholder="کوچه" name="alley" id="update-alley" class="address-data @error('alley') is-invalid @enderror">

                            @error('alley')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="update-house_no">
                                پلاک
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" placeholder="پلاک" min="1" name="house_no" id="update-house_no" required @error('house_no') class="is-invalid" @enderror>

                            @error('house_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                    <div class="row mb-3 mt-3">
                        <div class="col-6">
                            انتخاب روی نقشه
                        </div>
                        <div class="col-6 mb-2 text-right">
                            <a href="javascript: update_get_by_address()" class="bordered-btn btn-small">
                                دریافت موقعیت از آدرس
                            </a>
                        </div>
                        <div class="col-12">
                            <div class="position-relative">
                                <div id="update-map" class="w-100"></div>
                                <div class="update-map-loading d-none">
                                    <div class="loading">
                                        <div class="spinner-grow text-danger" role="status">
                                            <span class="sr-only">در حال یافتن آدرس...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-dismiss="modal">لغو</button>
                    <button type="submit" class="boxed-btn" form="update-maps">
                        بروزرسانی
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->maps->count() < 5)
        <div class="modal fade address-modal" id="add" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن آدرس جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti ti-close font-size-10"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('map.store', auth()->user()->id) }}" method="post" class="row" id="add-maps">
                            @csrf
                            <input type="hidden" name="lat" id="add-lat">
                            <input type="hidden" name="long" id="add-long">

                            <div class="col-12 col-md-6 mb-3">
                                <label for="add-main_street">
                                    خیابان اصلی
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" placeholder="خیابان اصلی" name="main_street" id="add-main_street" required class="address-data @error('main_street') is-invalid @enderror">

                                @error('main_street')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="add-side_street">خیابان فرعی</label>
                                <input type="text" placeholder="خیابان فرعی" name="side_street" id="add-side_street" class="address-data @error('side_street') is-invalid @enderror">

                                @error('side_street')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="add-alley">کوچه</label>
                                <input type="text" placeholder="کوچه" name="alley" id="add-alley" class="address-data @error('alley') is-invalid @enderror">

                                @error('alley')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="add-house_no">
                                    پلاک
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" placeholder="پلاک" min="1" name="house_no" id="add-house_no" required @error('house_no') class="is-invalid" @enderror>

                                @error('house_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                        <div class="row mb-3 mt-3">
                            <div class="col-6">
                                انتخاب روی نقشه
                            </div>
                            <div class="col-6 mb-2 text-right">
                                <a href="javascript: add_get_by_address()" class="bordered-btn btn-small">
                                    دریافت موقعیت از آدرس
                                </a>
                            </div>
                            <div class="col-12">
                                <div class="position-relative">
                                    <div id="add-map" class="w-100"></div>
                                    <div class="add-map-loading d-none">
                                        <div class="loading">
                                            <div class="spinner-grow text-danger" role="status">
                                                <span class="sr-only">در حال یافتن آدرس...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel-btn" data-dismiss="modal">لغو</button>
                        <button type="submit" class="boxed-btn" form="add-maps">
                            افزودن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('styles')
    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
@endsection

@push('scripts')
    <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
    <script src="{{ asset('assets/js/checkout-maps.js') }}"></script>
    <script>
        icon = L.icon({
            iconUrl: '{{ asset('assets/icons/leaflet/location.svg') }}',
            iconSize: [38, 100],
            iconAnchor: [18, 67],
        });

        async function update_map_modal(id)
        {
            let map = await get_map(id);
            document.querySelector('#update-id').value = id;

            document.querySelector('#update-lat').value = map.lat;
            document.querySelector('#update-long').value = map.long;
            document.querySelector('#update-main_street').value = map.main_street;
            document.querySelector('#update-side_street').value = map.side_street;
            document.querySelector('#update-alley').value = map.alley;
            document.querySelector('#update-house_no').value = map.house_no;

            update_load_map(map.lat, map.long);
            update_get_by_address()
        }

        @if(auth()->user()->maps->count() < 5)
            async function add_map_modal()
            {
                add_load_map(35.699758, 51.3359019);
            }
        @endif
    </script>
@endpush
