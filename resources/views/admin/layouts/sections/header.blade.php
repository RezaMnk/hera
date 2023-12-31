<!-- begin::header -->
<div class="header">

    <!-- begin::header logo -->
    <div class="header-logo">
        <a href="{{ route('admin.index') }}">
            <img class="large-logo" src="{{ asset('assets/img/logo.png') }}" alt="image">
            <img class="small-logo" src="{{ asset('assets/img/logo.png') }}" alt="image">
            <img class="dark-logo" src="{{ asset('assets/img/logo.png') }}" alt="image">
        </a>
    </div>
    <!-- end::header logo -->

    <!-- begin::header body -->
    <div class="header-body">

        <div class="header-body-left">

            <h3 class="page-title">@yield('title')</h3>

        </div>

        <div class="header-body-right">
            <!-- begin::navbar main body -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.home') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="ti-plus"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        <div class="p-3">
                            <h6 class="font-size-13 m-b-15">دسترسی سریع</h6>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('admin.products.create') }}">
                                        <div class="d-flex flex-column font-size-13 bg-success-bright bg-hover pt-3 pb-3 border-radius-1 text-success text-center mb-3">
                                            <i class="fa fa-shopping-bag mb-2 font-size-20"></i>
                                            محصول جدید
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.discounts.index') }}">
                                        <div class="d-flex flex-column font-size-13 bg-primary-bright bg-hover pt-3 pb-3 border-radius-1 text-primary text-center">
                                            <i class="fa fa-tag mb-2 font-size-20"></i>
                                            کد تخفیف جدید
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.posts.index') }}">
                                        <div class="d-flex flex-column font-size-13 bg-danger-bright bg-hover pt-3 pb-3 border-radius-1 text-danger text-center">
                                            <i class="fa fa-pencil mb-2 font-size-20"></i>
                                            مقاله جدید
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.categories.index') }}">
                                        <div class="d-flex flex-column font-size-13 bg-info-bright bg-hover pt-3 pb-3 border-radius-1 text-info text-center">
                                            <i class="fa fa-th-list mb-2 font-size-20"></i>
                                            دسته بندی جدید
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- end::navbar main body -->

            <div class="d-flex align-items-center">
                <!-- begin::navbar navigation toggler -->
                <div class="d-xl-none d-lg-none d-sm-block navigation-toggler">
                    <a href="#">
                        <i class="ti-menu"></i>
                    </a>
                </div>
                <!-- end::navbar navigation toggler -->

                <!-- begin::navbar toggler -->
                <div class="d-xl-none d-lg-none d-sm-block navbar-toggler">
                    <a href="#">
                        <i class="ti-arrow-down"></i>
                    </a>
                </div>
                <!-- end::navbar toggler -->
            </div>
        </div>

    </div>
    <!-- end::header body -->

</div>
<!-- end::header -->
