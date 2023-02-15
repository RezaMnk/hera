@extends('home.layouts.app')

@section('title', 'تماس با ما')

@section('breadcrumb')
    <x-breadcrumb title="تماس با ما" desc="ارتباط با رستوران قریشی" />
@endsection

@section('content')
    <!-- contact form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row branches">
                <div class="col-12 col-lg-4 branch-card">
                    <div class="shadow-card">
                        <div class="branch-image">
                            <img src="{{ asset('assets/img/hero/hero-bg.jpg') }}" alt="">
                        </div>
                        <div class="branch-info">
                            <h3 class="branch-title">
                                ولنجک
                            </h3>
                            <div class="branch-address">
                                تهران، ولنجک، خیابان سعدی، پلاک 12
                            </div>
                            <div class="branch-call">
                                <a href="tel:02155554444">
                                    <bdi>021 - 55 55 44 44</bdi>
                                    <i class="fa fa-phone"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 branch-card">
                    <div class="shadow-card">
                        <div class="branch-image">
                            <img src="{{ asset('assets/img/hero/hero-bg.jpg') }}" alt="">
                        </div>
                        <div class="branch-info">
                            <h3 class="branch-title">
                                ولنجک
                            </h3>
                            <div class="branch-address">
                                تهران، ولنجک، خیابان سعدی، پلاک 12
                            </div>
                            <div class="branch-call">
                                <a href="tel:02155554444">
                                    <bdi>021 - 55 55 44 44</bdi>
                                    <i class="fa fa-phone"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 branch-card">
                    <div class="shadow-card">
                        <div class="branch-image">
                            <img src="{{ asset('assets/img/hero/hero-bg.jpg') }}" alt="">
                        </div>
                        <div class="branch-info">
                            <h3 class="branch-title">
                                ولنجک
                            </h3>
                            <div class="branch-address">
                                تهران، ولنجک، خیابان سعدی، پلاک 12
                            </div>
                            <div class="branch-call">
                                <a href="tel:02155554444">
                                    <bdi>021 - 55 55 44 44</bdi>
                                    <i class="fa fa-phone"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form -->

    <!-- find our location -->
    <div class="find-location blue-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        دسترسی از نقشه
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end find our location -->

    <!-- google map section -->
    <div class="embed-responsive embed-responsive-21by9">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15392.143905650102!2d51.460660374262574!3d35.80485135284695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e05a8068d6faf%3A0x3659ae08f0ca950b!2sGhoreishi%20Catering!5e0!3m2!1sen!2s!4v1674111195937!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="embed-responsive-item"></iframe>
    </div>
    <!-- end google map section -->
@endsection
