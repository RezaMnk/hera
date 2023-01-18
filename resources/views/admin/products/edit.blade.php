@extends('admin.layouts.app')

@section('title', 'ایجاد محصول')

@section('content')
    <!-- row : start  -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="row" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- right col start -->
        <div class="col-12 col-md-9">

            <div class="card d-block d-md-none">
                <div class="card-body row">
                    <div class="col-8">
                        <button type="submit" name="status" value="1" class="btn btn-success btn-block">بروزرسانی</button>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('admin.products.index') }}">
                            <button type="button" class="btn btn-danger btn-block">لغو</button>
                        </a>
                    </div>
                    <div class="col-12 mt-4">
                        <a href="{{ route('home.product', $product->slug) }}" target="_blank">
                            <button type="button" class="btn btn-outline-secondary btn-block">مشاهده محصول</button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- title card : start  -->
            <div class="card">
                <div class="card-body row">
                    <div class="col-12 col-md-8">
                        <label for="name">نام محصول</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="نام محصول" value="{{ old('name') ?: $product->name }}" required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="price">قیمت</label>
                        <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="قیمت محصول" value="{{ old('price') ?: $product->price }}" required>

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- title card : end  -->

            <!-- description card : start  -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">توضیحات محصول</h6>
                    <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') ?: $product->description }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!-- description card : end  -->

            <!-- category card : start  -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">دسته بندی</h6>
                    @forelse($categories as $category)
                        <label class="image-radio">
                            <input type="radio" name="category" value="{{ $category->id }}" @if(old('category')) @checked(old('category') == $category->id) @else @checked($product->category->id == $category->id) @endif />
                            <img src="{{ $category->get_image() }}" alt="{{ $category->name }}">
                            <span>
                                {{ $category->name }}
                            </span>
                        </label>
                    @empty
                        ابتدا از بخش <a href="{{ route('admin.categories.index') }}" class="text-primary">دسته بندی ها</a>، یک دسته بندی ایجاد کنید.
                    @endforelse

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!-- category card : end  -->
        </div>
        <!-- right col end -->

        <!-- left col start -->
        <div class="col-12 col-md-3">
            <!-- detail card : start  -->
            <div class="card d-none d-md-block">
                <div class="card-body row">
                    <div class="col-8">
                        <button type="submit" name="status" value="1" class="btn btn-success btn-block">بروزرسانی</button>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('admin.products.index') }}">
                            <button type="button" class="btn btn-danger btn-block">لغو</button>
                        </a>
                    </div>
                    <div class="col-12 mt-4">
                        <a href="{{ route('home.product', $product->slug) }}" target="_blank">
                            <button type="button" class="btn btn-outline-secondary btn-block">مشاهده محصول</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- detail card : end  -->
            <!-- image card : start -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">تصویر محصول</h6>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="product-image-input" accept="image/*">
                        <label class="custom-file-label" for="product-image-input">انتخاب فایل تصویر</label>
                    </div>
                    <div class="mt-4">
                        <img src="{{ $product->get_image() }}" id="product-image" class="w-100 shadow-sm rounded" alt="تصویر محصول">
                    </div>

                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!-- image card : end -->
        </div>
        <!-- left col : end -->
    </form>
    <!-- row : end -->
@endsection

@section('header-assets')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('footer-assets')
    <script>
        let image_input = document.querySelector('#product-image-input');
        let image = document.querySelector('#product-image');

        image_input.addEventListener('change', function (elem) {
            const [file] = image_input.files
            if (file) {
                image.style.transition = "opacity .1s ease";

                image.style.opacity = '0';
                setTimeout(function() {
                    image.src = URL.createObjectURL(file)

                    image.style.removeProperty('opacity');
                    image.style.removeProperty('transition');
                }, 200);
            }
        });

    </script>
@endsection

