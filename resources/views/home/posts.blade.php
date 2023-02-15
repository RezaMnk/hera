@extends('home.layouts.app')

@section('title', 'مقالات')

@section('breadcrumb')
    <x-breadcrumb title="مقالات" desc="مقالات تخصصی" />
@endsection

@section('content')
    <!-- latest posts -->
    <div class="latest-posts mt-150 mb-150">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-posts">
                            <a href="{{ route('home.post', $post->slug) }}">
                                <div class="latest-posts-bg" style="background-image: url('{{ $post->get_image() }}')"></div>
                            </a>
                            <div class="posts-text-box">
                                <h3>
                                    <a href="{{ route('home.post', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="blog-meta">
                                    <span class="date">
                                    <i class="fas fa-calendar"></i>
                                    {{ $post->created_at() }}
                                </span>
                                </p>
                                <p class="excerpt">
                                    {{ Str::limit(strip_tags($post->text), 150) }}
                                </p>
                                <a href="{{ route('home.post', $post->slug) }}" class="read-more-btn icon-btn">
                                    ادامه مطلب
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- end latest posts -->
@endsection
