@extends('home.layouts.app')

@section('title', 'منو')

@section('breadcrumb')
    <x-breadcrumb title="منو" desc="منو تهیه غذای قریشی" />
@endsection

@section('content')
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="product-filters">
                        <ul class="filters-carousel">
                            <li data-filter="*" class="active">
                                <img src="{{ asset('storage/categories/all.png') }}" alt="همه دسته بندی ها">
                                <p>همه دسته ها</p>
                            </li>
                            @foreach($categories as $category)
                                <li data-filter=".category-{{ $category->id }}">
                                    <img src="{{ $category->get_image() }}" alt="{{ $category->name }}">
                                    <p>{{ $category->name }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div @class(['col-12 col-lg-8' => auth()->check(), 'col-12' => ! auth()->check()])>
                    <div class="row product-lists">
                        @forelse($products as $product)
                            <div class="col-6 col-lg-4 text-center category-{{ $product->category->id }}">
                                <div class="single-product-item position-relative">
                                    <a href="{{ route('home.product', $product->slug) }}">
                                        <div class="product-image">
                                            <img src="{{ $product->get_image() }}" alt="{{ $product->name }}">
                                        </div>
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    @unless(is_null($product->description))
                                        <span>
                                            @if(strlen($product->description) > 50)
                                                {{ Str::limit($product->description, 50) }}
                                            @else
                                                {{ $product->description }}
                                            @endif
                                        </span>
                                    @endunless
                                    <p class="product-price">
                                        @if($product->price > 0)
                                            {{ number_format($product->price) }} تومان
                                        @else
                                            ناموجود
                                        @endif
                                    </p>
                                    <x-add-to-cart :product="$product" />
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card sticky-cart">
                                    <div class="card-body">
                                        <h5>محصولی مطابق با جست و جوی شما یافت نشد!</h5>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                @auth
                    <div class="col-4 d-none d-lg-block">
                        <x-sticky-cart></x-sticky-cart>
                    </div>
                @endauth
            </div>

{{--            <div class="row">--}}
{{--                <div class="col-lg-12 text-center">--}}
{{--                    {{ $products->links() }}--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <!-- end products -->
@endsection
