@extends('home.layouts.app')

@section('title', 'تماس با ما')

@section('breadcrumb')
    <x-breadcrumb title="تماس با ما" desc="ارتباط با تهیه غذای قریشی" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="contact-section">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-header">آدرس</h2>
                            <p>تهران، خیابان پاسداران، پایین‌تر از چهارراه فرمانیه، پلاک 497</p>
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
        </div>
    </div>
@endsection
