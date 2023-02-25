@extends('home.layouts.app')

@section('title', $product->name)

@section('breadcrumb')
    @php($product_name = $product->name)
    <x-breadcrumb :title="$product_name" desc="سفارش غذا" />
@endsection

@section('content')
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-8 offset-2 col-md-5 offset-md-0">
                    <div class="single-product-img">
                        <img src="{{ $product->get_image() }}" alt="{{ $product->name }}">
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="single-product-content text-center text-md-left">
                        <p class="single-product-pricing">
                            {{ number_format($product->price) }} تومان
                        </p>
                        <p>
                            <strong>دسته بندی:</strong>
                            {{ $product->category->name }}
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
                                    <button type="submit" class="product cart-btn icon-btn">
                                        افزودن به سبد
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        @endauth
                        <h4>اشتراک گذاری:</h4>
                        <ul class="product-share">
                            <li><a href="https://t.me/share/url?url={{ request()->url() }}" target="_blank"><i class="fab fa-telegram"></i></a></li>
                            <li><a href="https://api.whatsapp.com/send?text={{ request()->url() }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a href="mailto:?subject={{ env('app_name') }}&amp;body={{ request()->url() }}" target="_blank"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                        @guest
                            <div class="mt-5">
                                <a href="{{ route('login') }}" class="boxed-btn icon-btn">
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
                        <h3><span class="red-text">محصولات</span> مرتبط</h3>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-theme carousel-products">
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
                            <x-add-to-cart :product="$product" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->
@endsection
