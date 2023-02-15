@extends('home.layouts.app')

@section('title', 'درباره ما')

@section('breadcrumb')
    <x-breadcrumb title="درباره ما" desc="درباره رستوران قریشی" />
@endsection

@section('content')
    <!-- featured section -->
    <div class="feature-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="featured-text">
                        <h2 class="pb-3">چرا <span class="red-text">قریشی</span></h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="content">
                                        <h3>حمل و نقل سریع</h3>
                                        <p>سفارشات را در سریعترین زمان ممکن به دست شما می‌رسد</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>قیمت مناسب</h3>
                                        <p>قیمت های رستوران قریشی از نازل ترین قیمت ها با ارائه کیفیت بالاست</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="content">
                                        <h3>حمل و نقل سریع</h3>
                                        <p>سفارشات را در سریعترین زمان ممکن به دست شما می‌رسد</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>قیمت مناسب</h3>
                                        <p>قیمت های رستوران قریشی از نازل ترین قیمت ها با ارائه کیفیت بالاست</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end featured section -->

    <!-- team section -->
    <div class="mt-150 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>تیم <span class="red-text">ما</span></h3>
                        <p>اعضای تیم ما را بهتر بشناسید</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-team-item">
                        <div class="team-bg team-bg-1"></div>
                        <h4>محمد محمدی <span>نویسنده</span></h4>
                        <ul class="social-link-team">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-team-item">
                        <div class="team-bg team-bg-2"></div>
                        <h4>علی علیخانی <span>طراح</span></h4>
{{--                        <ul class="social-link-team">--}}
{{--                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>--}}
{{--                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                    <div class="single-team-item">
                        <div class="team-bg team-bg-3"></div>
                        <h4>محمدرضا بابایی <span>عکاس</span></h4>
{{--                        <ul class="social-link-team">--}}
{{--                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>--}}
{{--                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end team section -->
@endsection
