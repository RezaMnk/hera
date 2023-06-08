@extends('home.layouts.app')

@section('title', $post->title)

@section('breadcrumb')
    @php($title = $post->title)
    <x-breadcrumb :title="$title" desc="مقالات تخصصی تهیه غذای قریشی" />
@endsection

@section('content')
    <!-- single article section -->
    <div class="mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            <div class="single-article-bg">
                                <img src="{{ $post->get_image() }}" alt="{{ $post->title }}">
                            </div>
                            <p class="blog-meta">
                                <span class="date">
                                    <i class="fas fa-calendar"></i>
                                    {{ $post->created_at() }}
                                </span>
                            </p>
                            <h1>
                                {{ $post->title }}
                            </h1>
                            <div>
                                {!! $post->text !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-section sticky-top">
                        <div class="recent-posts">
                            <h4>آخرین مقالات</h4>
                            <ul>
                                @foreach($recent_posts as $recent_post)
                                    <li>
                                        <a class="d-block" href="{{ route('home.post', $recent_post->slug) }}">
                                            <img src="{{ $recent_post->get_image() }}" alt="{{ $recent_post->title }}">
                                            <span>
                                                {{ $recent_post->title }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single article section -->
@endsection
