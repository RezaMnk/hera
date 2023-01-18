<!-- begin::navigation -->
<div class="navigation">
    <div class="navigation-icon-menu">
        <ul>
            <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}" data-toggle="tooltip" title="داشبورد">
                <a href="#navigationDashboards" title="داشبوردها">
                    <i class="icon ti-pie-chart"></i>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}" data-toggle="tooltip" title="کاربران">
                <a href="#UserSubMenu" title="کاربران">
                    <i class="icon ti-user"></i>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}" data-toggle="tooltip" title="سفارش ها">
                <a href="#OrdersSubMenu" title="سفارشات">
                    <i class="icon ti-layout-list-thumb"></i>
                    @if(($count = \App\Models\Order::where('read', false)->count()) > 0)
                        <span class="badge badge-warning">{{ $count }}</span>
                    @endif
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}" data-toggle="tooltip" title="محصولات">
                <a href="#ProductsSubMenu" title="محصولات">
                    <i class="icon ti-bag"></i>
                </a>
            </li>
        </ul>
        <!-- setting ul  -->
        <ul>
            <li data-toggle="tooltip" title="بستن منو" onclick="fullscreen()">
                <a href="#" class="go-to-page">
                    <i id="fullscreen" class="icon ti-arrow-right"></i>
                </a>
            </li>
            <li data-toggle="tooltip" title="" data-original-title="خروج">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <a href="javascript:void(0)" class="go-to-page">
                        <button type="submit" class="btn btn-default">
                            <i class="icon ti-power-off"></i>
                        </button>
                    </a>
                </form>
            </li>
        </ul>
    </div>
    <div class="navigation-menu-body">
        <ul id="navigationDashboards" class="{{ request()->routeIs('admin.index') ? 'navigation-active' : '' }}">
            <li class="navigation-divider">صفحه اصلی</li>
            <li>
                <a class="{{ request()->routeIs('admin.index') ? 'active' : '' }} mb-2" href="{{ route('admin.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-primary text-white mr-3">
                                <i class="fa fa-dashboard"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font mb-0">داشبورد</h6>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.orders.unapproved') ? 'active' : '' }} mb-2" href="{{ route('admin.orders.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-success text-white mr-3">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">سفارشات</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Order::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }} mb-2" href="{{ route('admin.products.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-danger text-white mr-3">
                                <i class="fa fa-dropbox"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">محصولات</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Product::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <!-- user sub menu -->
        <ul id="UserSubMenu" class="{{ request()->routeIs('admin.users*') ? 'navigation-active' : '' }}">
            <li class="navigation-divider">کاربران</li>
            <li>
                <a class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }} mb-2" href="{{ route('admin.users.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-success text-white mr-3">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">همه کاربران</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\User::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <!-- user sub menu  -->
        <!-- Orders -->
        <ul id="OrdersSubMenu" class="{{ request()->routeIs('admin.orders*') ? 'navigation-active' : '' }}">
            <li class="navigation-divider">سفارشات</li>
            <li>
                <a class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }} mb-2" href="{{ route('admin.orders.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-primary text-white mr-3">
                                <i class="fa fa-list"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">همه سفارشات</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Order::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <!-- Orders  -->
        <!-- Products -->
        <ul id="ProductsSubMenu" class="{{ request()->routeIs('admin.products*', 'admin.categories*', 'admin.discounts*') ? 'navigation-active' : '' }}">
            <li class="navigation-divider">محصولات</li>
            <li>
                <a class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }} mb-2" href="{{ route('admin.products.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-primary text-white mr-3">
                                <i class="fa fa-dropbox"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">محصولات</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Product::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }} mb-2" href="{{ route('admin.categories.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-success text-white mr-3">
                                <i class="fa fa-th-list"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">دسته بندی ها</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Category::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.discounts.index') ? 'active' : '' }} mb-2" href="{{ route('admin.discounts.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-warning text-white mr-3">
                                <i class="fa fa-tag"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">کد تخفیف ها</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Discount::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <!-- Products -->
    </div>
</div>
<!-- end::navigation -->
