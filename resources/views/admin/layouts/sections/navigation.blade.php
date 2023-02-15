<!-- begin::navigation -->
<div class="navigation">
    <div class="navigation-icon-menu">
        <ul>
            <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}" data-toggle="tooltip" title="داشبورد">
                <a href="#navigationDashboards">
                    <i class="icon ti-pie-chart"></i>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}" data-toggle="tooltip" title="کاربران">
                <a href="#UserSubMenu">
                    <i class="icon ti-user"></i>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}" data-toggle="tooltip" title="سفارش ها">
                <a href="#OrdersSubMenu">
                    <i class="icon ti-layout-list-thumb"></i>
                    <span id="new-order-badge" @class(['badge badge-warning', 'd-none' => \App\Models\Order::where('read', false)->count() == 0])>1</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}" data-toggle="tooltip" title="محصولات">
                <a href="#ProductsSubMenu">
                    <i class="icon ti-bag"></i>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.posts*') ? 'active' : '' }}" data-toggle="tooltip" title="مقالات">
                <a href="#PostsSubMenu">
                    <i class="icon ti-pencil-alt"></i>
                </a>
            </li>
            @owner
                <li class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}" data-toggle="tooltip" title="تنظیمات">
                    <a href="#SettingsSubMenu">
                        <i class="icon ti-settings"></i>
                    </a>
                </li>
            @endowner
        </ul>
        <!-- setting ul  -->
        <ul>
            <li data-toggle="tooltip" title="بستن منو" onclick="fullscreen()" class="d-none d-lg-block">
                <a href="javascript: void(0)" class="go-to-page">
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
        <!-- Products -->
        <ul id="PostsSubMenu" class="{{ request()->routeIs('admin.posts*') ? 'navigation-active' : '' }}">
            <li class="navigation-divider">مقالات</li>
            <li>
                <a class="{{ request()->routeIs('admin.posts.index') ? 'active' : '' }} mb-2" href="{{ route('admin.posts.index') }}">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="icon-block bg-primary text-white mr-3">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="font-size-13 line-height-22 primary-font m-b-5">مقالات</h6>
                            <h4 class="m-b-0 primary-font font-weight-bold line-height-30">{{ \App\Models\Post::calc() }}</h4>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <!-- Products -->
        @owner
            <!-- Products -->
            <ul id="SettingsSubMenu" class="{{ request()->routeIs('admin.settings*') ? 'navigation-active' : '' }}">
                <li class="navigation-divider">تنظیمات</li>
                <li>
                    <a class="{{ request()->routeIs('admin.settings.index') ? 'active' : '' }} mb-2" href="{{ route('admin.settings.index') }}">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="icon-block bg-info text-white mr-3">
                                    <i class="fa fa-cog"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="font-size-13 line-height-22 info-font mb-0">تنظیمات</h6>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- Products -->
        @endowner
    </div>
</div>
<!-- end::navigation -->
