@extends('home.layouts.app')

@section('title', 'صفحه اصلی')

@section('content')
    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider" style="background-image: url('{{ asset('assets/img/hero/hero-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <div class="hero-container">
                                    <p class="subtitle">سالم و سلامت</p>
                                    <h1>استفاده از مواد اولیه مرغوب</h1>
                                    <div class="hero-btns">
                                        <a href="{{ route('home.menu') }}" class="boxed-btn">سفارش آنلاین</a>
                                        <a href="{{ route('home.contact') }}" class="bordered-btn">تماس با ما</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider" style="background-image: url('{{ asset('assets/img/hero/hero-bg-2.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <div class="hero-container">
                                    <p class="subtitle">سالم و سلامت</p>
                                    <h1>استفاده از مواد اولیه مرغوب</h1>
                                    <div class="hero-btns">
                                        <a href="{{ route('home.menu') }}" class="boxed-btn">سفارش آنلاین</a>
                                        <a href="{{ route('home.contact') }}" class="bordered-btn">تماس با ما</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider" style="background-image: url('{{ asset('assets/img/hero/hero-bg-3.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <div class="hero-container">
                                    <p class="subtitle">سالم و سلامت</p>
                                    <h1>استفاده از مواد اولیه مرغوب</h1>
                                    <div class="hero-btns">
                                        <a href="{{ route('home.menu') }}" class="boxed-btn">سفارش آنلاین</a>
                                        <a href="{{ route('home.contact') }}" class="bordered-btn">تماس با ما</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->
@endsection
