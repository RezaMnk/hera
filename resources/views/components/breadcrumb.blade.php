<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
{{--                    <p>{{ $desc }}</p>--}}
                    <h1>{{ $title }}</h1>
                    @if(! is_active_hours())
                        <h4 class="mt-5 text-danger border-bottom border-danger d-inline-block pb-1">ساعت کاری به پایان رسیده است</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
