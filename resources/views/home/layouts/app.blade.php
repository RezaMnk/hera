<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="رستوران قریشی - خرید آنلاین، تحویل فوری">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- title -->
        <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

        <!-- fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
        <!-- owl carousel -->
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
        <!-- magnific popup -->
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <!-- animate css -->
        <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
        <!-- mean menu css -->
        <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
        <!-- main style -->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <!-- responsive -->
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

        @vite('resources/js/app.js')

        @yield('styles')
    </head>
    <body>

        @include('home.layouts.partials.header')

        @yield('breadcrumb')

        @yield('content')

        <!-- jquery -->
        <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- count down -->
        <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
        <!-- isotope -->
        <script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
        <!-- waypoints -->
        <script src="{{ asset('assets/js/waypoints.js') }}"></script>
        <!-- owl carousel -->
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <!-- magnific popup -->
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- mean menu -->
        <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
        <!-- sticker js -->
        <script src="{{ asset('assets/js/sticker.js') }}"></script>
        <!-- main js -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script>
            addEventListener('DOMContentLoaded', (event) => {
                @if(Session::has('toast.success'))
                window.Toastify({
                    text: "{{ session('toast.success') }}",
                    position: "left",
                    className: "toastify-success",
                    offset: {
                        x: '2rem',
                        y: '2rem'
                    }
                }).showToast();

                @elseif(Session::has('toast.danger'))
                Toastify({
                    text: "{{ session('toast.danger') }}",
                    position: "left",
                    className: "toastify-danger",
                    offset: {
                        x: '2rem',
                        y: '2rem'
                    }
                }).showToast();

                @elseif(Session::has('toast.info'))
                Toastify({
                    text: "{{ session('toast.info') }}",
                    position: "left",
                    className: "toastify-info",
                    offset: {
                        x: '2rem',
                        y: '2rem'
                    }
                }).showToast();

                @elseif(Session::has('toast.warning'))
                Toastify({
                    text: "{{ session('toast.warning') }}",
                    position: "left",
                    className: "toastify-warning",
                    offset: {
                        x: '2rem',
                        y: '2rem'
                    }
                }).showToast();

                @endif
            });
        </script>

        @stack('scripts')

    </body>
</html>
