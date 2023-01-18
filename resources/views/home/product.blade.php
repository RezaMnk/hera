@extends('home.layouts.app')

@section('title', 'منو')

@section('breadcrumb')
    <x-breadcrumb title="منو" desc="منو رستوران قریشی" />
@endsection

@section('content')
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ $product->get_image() }}" alt="{{ $product->name }}">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>
                            {{ $product->name }}
                        </h3>
                        <p>
                            <strong>دسته بندی:</strong>
                            {{ $product->category->name }}
                        </p>
                        <p class="single-product-pricing">
                            {{ number_format($product->price) }} تومان
                        </p>
                        <p>
                            <strong>مشخصات:</strong>
                            {{ $product->description }}
                        </p>
                        @auth
                            <div class="single-product-form">
                                <form action="{{ route('cart.add', $product->id) }}" method="post">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1">
                                    <button type="submit" class="cart-btn icon-btn">
                                        افزودن به سبد خرید
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        @endauth
                        <h4>اشتراک گذاری:</h4>
                        <ul class="product-share">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                        @guest
                            <div class="mt-5">
                                <a href="http://127.0.0.1:8000/menu" class="boxed-btn icon-btn">
                                    برای سفارش وارد شوید
                                    <i class="fas fa-sign-in-alt"></i>
                                </a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">محصولات</span> مرتبط</h3>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach($related_products as $related_product)
                    <div class="item text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('home.product', $related_product->slug) }}">
                                    <img src="{{ $related_product->get_image() }}" alt="{{ $related_product->name }}">
                                </a>
                            </div>
                            <h3>{{ $related_product->name }}</h3>
                            <p class="product-price">
                                {{ number_format($related_product->price) }} تومان
                            </p>
                            <a href="#" class="cart-btn">
                                افزودن به سبد خرید
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->

    @include('home.layouts.partials.footer')
@endsection
