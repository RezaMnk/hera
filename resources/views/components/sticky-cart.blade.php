<div class="card sticky-cart">
    <div class="card-body">
        <div class="card-title border-bottom border-dark pb-2">
            <h5 class="d-inline">سبد خرید</h5>
            <form class="d-inline" action="{{ route('cart.clear') }}" method="post">
                @csrf
                <button class="bordered-primary-btn clear-cart-button" type="submit">
                    حذف
                </button>
            </form>
        </div>
        <div class="cart-products">
            @forelse(cart()->all() as $cart_item)
                <div class="row my-3">
                    <div class="col-8">
                        <a href="{{ route('home.product', $cart_item['product']->slug) }}">
                            {{ $cart_item['product']->name }}
                        </a>
                        <p class="cart-product-price">
                            قیمت واحد: {{ number_format($cart_item['product']->price) }} تومان
                        </p>
                    </div>
                    <div class="col-4 cart-count-box" data-slug="{{ $cart_item['product']->slug }}">
                        <div class="cart-count-loading"></div>
                        <i class="fa fa-plus cart-add-count" data-id="add"></i>
                        <span class="cart-count">{{ $cart_item['quantity'] }}</span>
                        <i class="fa fa-minus cart-remove-count" data-id="remove"></i>
                    </div>
                </div>
                @unless($loop->last)
                    <hr>
                @endunless
            @empty
                <p class="my-3">
                    سبد خرید خالی می باشد!
                </p>
            @endforelse
        </div>
        <div class="cart-buttons">
            <a href="{{ route('home.cart') }}" class="boxed-btn w-100 text-center">ثبت سفارش</a>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/cart-counter.js') }}"></script>
@endpush