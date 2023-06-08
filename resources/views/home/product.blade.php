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
                            @if($product->price > 0)
                                {{ number_format($product->price) }} تومان
                            @else
                                    ناموجود
                            @endif
                        </p>
                        <p>
                            <strong>دسته بندی:</strong>
                            {{ $product->category->name }}
                        </p>
                        @if($product->description)
                            <p>
                                <strong>مشخصات:</strong>
                                {{ $product->description }}
                            </p>
                        @endif
                        @auth
                            @if($product->price > 0)
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
                            @endif
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
            <div class="carousel-products">
                @foreach($related_products as $related_product)
                    <div class="item text-center">
                        <div class="single-product-item">
                            <a href="{{ route('home.product', $related_product->slug) }}">
                                <div class="product-image">
                                    <img src="{{ $related_product->get_image() }}" alt="{{ $related_product->name }}">
                                </div>
                                <h3>{{ $related_product->name }}</h3>
                            </a>
                            @unless(is_null($related_product->description))
                                <span>
                                            @if(strlen($related_product->description) > 50)
                                        {{ Str::limit($related_product->description, 50) }}
                                    @else
                                        {{ $related_product->description }}
                                    @endif
                                        </span>
                            @endunless
                            <p class="product-price">
                                @if($related_product->price > 0)
                                    {{ number_format($related_product->price) }} تومان
                                @else
                                    ناموجود
                                @endif
                            </p>
                            <x-add-to-cart :product="$related_product" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->
@endsection
