<!-- Plugin scripts -->
<script src="{{ asset('admin/vendors/bundle.js') }}"></script>

<!-- Chartjs -->
<script src="{{ asset('admin/vendors/charts/chartjs/chart.min.js') }}"></script>

<!-- Circle progress -->
<script src="{{ asset('admin/vendors/circle-progress/circle-progress.min.js') }}"></script>

<!-- Peity -->
<script src="{{ asset('admin/vendors/charts/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('admin/js/examples/charts/peity.js') }}"></script>

<!-- Datepicker -->
<script src="{{ asset('admin/vendors/datepicker/daterangepicker.js') }}"></script>

<!-- Slick -->
<script src="{{ asset('admin/vendors/slick/slick.min.js') }}"></script>

<!-- Vamp -->
<script src="{{ asset('admin/vendors/vmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/vendors/vmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('admin/js/examples/vmap.js') }}"></script>

<!-- Dashboard scripts -->
<script src="{{ asset('admin/js/examples/dashboard.js') }}"></script>

<script>
    toastr.options = {
        timeOut: 10000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 200,
        hideDuration: 200
    };

    @if(Session::has('toast.success'))
        toastr.success("{{ session('toast.success') }}");

    @elseif(Session::has('toast.danger'))
        toastr.error("{{ session('toast.danger') }}");

    @elseif(Session::has('toast.info'))
        toastr.info("{{ session('toast.info') }}");

    @elseif(Session::has('toast.warning'))
        toastr.warning("{{ session('toast.warning') }}");

    @endif
</script>
