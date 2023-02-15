@extends('admin.layouts.app')

@section('title', 'ایجاد مقاله')

@section('content')
    <!-- row : start  -->
    <form action="{{ route('admin.posts.store') }}" method="post" class="row" enctype="multipart/form-data">
        @csrf
        <!-- right col start -->
        <div class="col-12 col-md-9">

            <div class="card d-block d-md-none">
                <div class="card-body row">
                    <div class="col-4">
                        <a href="{{ route('admin.posts.index') }}">
                            <button type="button" class="btn btn-danger btn-block">لغو</button>
                        </a>
                    </div>
                    <div class="col-8">
                        <button type="submit" name="status" value="1" class="btn btn-success btn-block">انتشار</button>
                    </div>
                </div>
            </div>

            <!-- title card : start  -->
            <div class="card">
                <div class="card-body">
                    <label for="title">عنوان مقاله</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان" value="{{ old('title') }}" required>

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!-- title card : end  -->

            <!-- content card : start  -->
            <div class="card">
                <div class="card-body">
                    <label>متن</label>
                    <textarea id="text" name="text" @error('text') class="is-invalid" @enderror>{{ old('text') }}</textarea>

                    @error('text')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!-- content card : end  -->
        </div>
        <!-- right col end -->

        <!-- left col start -->
        <div class="col-12 col-md-3">
            <!-- detail card : start  -->
            <div class="card d-none d-md-block">
                <div class="card-body row">
                    <div class="col-4">
                        <a href="{{ route('admin.posts.index') }}">
                            <button type="button" class="btn btn-danger btn-block">لغو</button>
                        </a>
                    </div>
                    <div class="col-8">
                        <button type="submit" name="status" value="1" class="btn btn-success btn-block">انتشار</button>
                    </div>
                </div>
            </div>
            <!-- detail card : end  -->
            <!-- image card : start -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">تصویر مقاله</h6>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="post-image-input" accept="image/*">
                        <label class="custom-file-label" for="post-image-input">انتخاب فایل تصویر</label>
                    </div>
                    <div class="mt-4">
                        <img src="{{ asset('storage/default.png') }}" id="post-image" class="w-100 shadow-sm rounded" alt="تصویر مقاله">
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

@section('footer-assets')
    <script>
        let image_input = document.querySelector('#post-image-input');
        let image = document.querySelector('#post-image');

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
    <script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.config.language = 'fa';

        CKEDITOR.config.contentsCss = '{{ asset('admin/css/font/primary-iran-yekan.css') }}';
        CKEDITOR.config.font_names = 'primary-font';
        CKEDITOR.config.font_defaultLabel = 'primary-font';
        CKEDITOR.config.height = '300px';

        CKEDITOR.replace('text');
    </script>

@endsection
