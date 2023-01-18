@auth
    <form action="{{ route('cart.add', $product->id) }}" method="post">
        @csrf
        <button type="submit" class="cart-btn icon-btn">
            افزودن به سبد خرید
            <i class="fas fa-shopping-cart"></i>
        </button>
    </form>
@endauth
