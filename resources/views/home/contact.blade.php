@extends('home.layouts.app')

@section('title', 'تماس با ما')

@section('breadcrumb')
    <x-breadcrumb title="تماس با ما" desc="ارتباط با رستوران قریشی" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="contact-section">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-header">آدرس</h2>
                            <p>تهران، خیابان پاسداران، پایین‌تر از چهارراه فرمانیه، پلاک 752</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-header">شماره تماس</h2>
                            <p class="contact-phone">
                                <a href="tel:0212959"><bdi>021 2959</bdi></a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-header">ایمیل</h2>
                            <p class="contact-email">
                                <a href="mailto:info@ghoreishicatering.com" target="_blank">info@ghoreishicatering.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 d-none d-lg-block contact-image" style="background-image: url('{{ asset('assets/img/contact.jpg') }}')"></div>
        </div>
    </div>

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
        <iframe src="https://balad.ir/embed?p=4V2b3m0zUczHji" title="مشاهده «کترینگ قریشی» روی نقشه بلد" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>    </div>
    <!-- end google map section -->
@endsection
