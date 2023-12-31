<!DOCTYPE html>
<html lang="fa" dir="rtl">

@include('admin.layouts.sections.head')

<body>

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
</div>
<!-- end::page loader -->

@include('admin.layouts.sections.navigation')

@include('admin.layouts.sections.header')

<!-- begin::main content -->
<main class="main-content">
    @yield('content')
</main>
<!-- end::main content -->

@yield('modal')

@include('admin.layouts.sections.footer-scripts')

<div class="colors">
    <!-- To use theme colors with Javascript -->
    <div class="bg-primary"></div>
    <div class="bg-primary-bright"></div>
    <div class="bg-secondary"></div>
    <div class="bg-secondary-bright"></div>
    <div class="bg-info"></div>
    <div class="bg-info-bright"></div>
    <div class="bg-success"></div>
    <div class="bg-success-bright"></div>
    <div class="bg-danger"></div>
    <div class="bg-danger-bright"></div>
    <div class="bg-warning"></div>
    <div class="bg-warning-bright"></div>
</div>

<!-- App scripts -->
<script src="{{ asset('admin/js/app.js') }}"></script>
<script src="{{ asset('admin/js/custom.js') }}"></script>

@vite('resources/js/app.js')

@yield('footer-assets')

</body>
{{--@include('sweetalert::alert')--}}
</html>
