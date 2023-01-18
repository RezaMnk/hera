@extends('home.layouts.app')

@section('title', 'منو')

@section('breadcrumb')
    <x-breadcrumb title="منو" desc="منو رستوران قریشی" />
@endsection

@section('content')
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li data-filter="*" class="active">
                                <img src="{{ asset('storage/categories/default.png') }}" alt="همه دسته بندی ها">
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
                <div @class(['col-8' => auth()->check(), 'col-12' => ! auth()->check()])>
                    <div class="row product-lists">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-md-6 text-center category-{{ $product->category->id }}">
                                <div class="single-product-item">
                                    <a href="{{ route('home.product', $product->slug) }}">
                                        <div class="product-image">
                                            <img src="{{ $product->get_image() }}" alt="{{ $product->name }}">
                                        </div>
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <span>
                                {{ $product->description }}
                            </span>
                                    <p class="product-price">
                                        {{ number_format($product->price) }} تومان
                                    </p>
                                    @php($product_id = $product->id)
                                    <x-add-to-cart :product="$product" />
                                </div>
                            </div>
                        @empty
                            <div class="card sticky-cart w-75">
                                <div class="card-body">
                                    <h5>محصولی مطابق با جست و جوی شما یافت نشد!</h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                @auth
                    <div class="col-4">
                        <x-sticky-cart></x-sticky-cart>
                    </div>
                @endauth
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->

    @include('home.layouts.partials.footer')
@endsection
