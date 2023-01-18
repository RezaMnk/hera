@extends('home.layouts.app')

@section('title', 'سبد خرید')

@section('breadcrumb')
    <x-breadcrumb title="سبد خرید" desc="محصولاتی که به سبد خریدتان افزودید" />
@endsection

@section('content')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove"></th>
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
                                        <td class="product-remove">
                                            <form action="{{ route('cart.remove', $cart_item['product']->id) }}" method="post">
                                                @csrf

                                                <button type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
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
                                            <div class="cart-count-box" data-slug="{{ $cart_item['product']->slug }}">
                                                <div class="cart-count-loading"></div>
                                                <i class="fa fa-plus cart-add-count" data-id="add"></i>
                                                <span class="cart-count">{{ $cart_item['quantity'] }}</span>
                                                <i class="fa fa-minus cart-remove-count" data-id="remove"></i>
                                            </div>
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
                <div class="col-lg-4">
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
                                    <td data-shipping-price="{{ 28000 }}">
                                        {{ number_format(28000) }} تومان
                                    </td>
                                </tr>
                                <tr class="total-data">
                                    <td>
                                        <strong>هزینه نهایی: </strong>
                                    </td>
                                    <td id="total-cart-price">
                                        {{ number_format($total + 28000) }} تومان
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="coupon-section">
                            <label for="discount">ثبت کد تخفیف</label>
                            <input id="discount" name="discount" form="checkout" placeholder="کد تخفیف" @error('discount') class="is-invalid" @enderror>

                            @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="cart-buttons row">
                            <div class="col-4">
                                <a href="{{ route('home.cart') }}" class="bordered-btn">بروزرسانی</a>
                            </div>
                            <form action="{{ route('order.checkout') }}" id="checkout" method="post" class="col-8">
                                @csrf
                                <button type="submit" class="boxed-btn w-100 text-center">ثبت سفارش</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->

    @include('home.layouts.partials.footer')
@endsection

@push('scripts')
<script src="{{ asset('assets/js/cart-counter.js') }}"></script>
@endpush
