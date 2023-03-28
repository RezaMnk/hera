@auth
    <form action="{{ route('cart.add', $product->id) }}" class="add-to-cart-form" method="post">
        @csrf
        <button type="submit" class="cart-btn icon-btn">
                افزودن به سبد
            <i class="fas fa-shopping-cart"></i>
        </button>
        <button type="submit" class="d-block d-md-none cart-btn mobile-add-to-cart">
            <i class="fa fa-plus"></i>
        </button>
    </form>
@endauth
