<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<!--PreLoader Ends-->

<!-- header -->
<div @class(['top-header-area', 'home-header' => request()->routeIs('home.home')]) id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo d-none d-lg-block">
                        <a href="{{ route('home.home') }}">
                            <img src="{{ asset('assets/img/logo-w.png') }}" alt="">
                        </a>
                    </div>
                    <div class="d-block d-lg-none">
                        <a href="{{ route('home.home') }}">
                            <img src="{{ asset('assets/img/logo-w.png') }}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li @class(['current-list-item' => request()->routeIs('home.home')])>
                                <a href="{{ route('home.home') }}">صفحه اصلی</a>
                            </li>
                            <li @class(['current-list-item' => request()->routeIs('home.menu')])>
                                <a href="{{ route('home.menu') }}">سفارش آنلاین</a>
                            </li>
                            <li @class(['current-list-item' => request()->routeIs('home.company')])>
                                <a href="{{ route('home.company') }}">غذای شرکتی</a>
                            </li>
{{--                            <li @class(['current-list-item' => request()->routeIs('home.posts')])>--}}
{{--                                <a href="{{ route('home.posts') }}">وبلاگ</a>--}}
{{--                            </li>--}}
                            <li @class(['current-list-item' => request()->routeIs('home.about')])>
                                <a href="{{ route('home.about') }}">درباره ما</a>
                            </li>
                            <li @class(['current-list-item' => request()->routeIs('home.contact')])>
                                <a href="{{ route('home.contact') }}">تماس با ما</a>
                            </li>
                            <li>
                                <div class="header-icons">
                                    @auth
                                        <a href="{{ route('home.profile') }}">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <a class="shopping-cart" href="{{ route('home.cart') }}">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </a>
                                    @endauth
                                    <a class="mobile-hide search-bar-icon" href="javascript: void(0)">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!-- mobile menu -->
<div class="mobile-static-menu d-block d-lg-none">
    <ul>
        <li>
            <a class="mobile-menu" href="javascript:void(0)">
                <i class="fas fa-list"></i>
                منو
            </a>
        </li>
        @auth
            <li>
                <a class="mobile-cart" href="javascript:void(0)">
                    <i class="fas fa-shopping-cart"></i>
                    سبد خرید
                    @if(($count = cart()->all()->count()) > 0)
                        ({{ $count }})
                    @endif
                </a>
            </li>
            <li>
                <a class="search-bar-icon" href="javascript:void(0)">
                    <i class="fas fa-search"></i>
                    جست و جو
                </a>
            </li>
            <li>
                <a href="{{ route('home.profile') }}">
                    <i class="fas fa-user"></i>
                    پروفایل
                </a>
            </li>
        @else
            <li>
                <a class="search-bar-icon" href="javascript:void(0)">
                    <i class="fas fa-search"></i>
                    جست و جو
                </a>
            </li>
            <li>
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    ورود به حساب
                </a>
            </li>
        @endauth
    </ul>
</div>
<!-- end mobile menu -->


<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn search-close">
                    <i class="fas fa-window-close"></i>
                </span>
                <form action="{{ route('home.menu') }}" class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>جست و جو:</h3>
                        <input type="text" name="search" placeholder="نام غذا" @if(request()->has('search')) value="{{ request('search') }}" @endif>
                        <button type="submit">
                            جست و جو
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->


<!-- mobile menu area -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn mobile-menu-close">
                    <i class="fas fa-window-close"></i>
                </span>
                <div class="menu-list">
                    <div class="menu-list-tablecell">
                        <h4 @class(['active' => request()->routeIs('home.home')])>
                            <a href="{{ route('home.home') }}">صفحه اصلی</a>
                        </h4>
                        <h4 @class(['active' => request()->routeIs('home.menu')])>
                            <a href="{{ route('home.menu') }}">سفارش آنلاین</a>
                        </h4>
                        <h4 @class(['active' => request()->routeIs('home.company')])>
                            <a href="{{ route('home.company') }}">غذای شرکتی</a>
                        </h4>
                        {{--<h4 @class(['active' => request()->routeIs('home.posts')])>
                            <a href="{{ route('home.posts') }}">وبلاگ</a>
                        </h4>--}}
                        <h4 @class(['active' => request()->routeIs('home.about')])>
                            <a href="{{ route('home.about') }}">درباره ما</a>
                        </h4>
                        <h4 @class(['active' => request()->routeIs('home.contact')])>
                            <a href="{{ route('home.contact') }}">تماس با ما</a>
                        </h4>
                        @auth
                            <h4 @class(['active' => request()->routeIs('home.cart')])>
                                <a href="{{ route('home.cart') }}">سبد خرید</a>
                            </h4>
                            <h4 @class(['active' => request()->routeIs('home.profile')])>
                                <a href="{{ route('home.profile') }}">پروفایل</a>
                            </h4>
                            <hr>
                            <h4>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <a href="javascript:void(0)">
                                        <button type="submit" class="btn btn-default">
                                            خروج از حساب
                                        </button>
                                    </a>
                                </form>
                            </h4>
                        @else
                            <hr>
                            <h4 @class(['active' => request()->routeIs('login')])>
                                <a href="{{ route('login') }}">ورود به حساب</a>
                            </h4>
                            <h4 @class(['active' => request()->routeIs('register')])>
                                <a href="{{ route('register') }}">ثبت نام</a>
                            </h4>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end mobile menu area -->

@auth
    <!-- mobile cart area -->
    <div class="mobile-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn mobile-cart-close">
                        <i class="fas fa-window-close"></i>
                    </span>
                    <div class="cart-list">
                        <div class="cart-list-tablecell">
                            @forelse(cart()->all()->take(4) as $cart_item)
                                <div class="row my-3 cart-item">
                                    <div class="col-2 pr-0 d-flex align-items-center justify-content-center">
                                        <form action="{{ route('cart.remove', $cart_item['product']->id) }}" method="post" id="remove-{{ $cart_item['product']->slug }}" class="">
                                            @csrf

                                            <a class="text-danger" onclick="document.getElementById('remove-{{ $cart_item['product']->slug }}').submit()">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <div class="col-6 text-left">
                                        <a href="{{ route('home.product', $cart_item['product']->slug) }}">
                                            {{ $cart_item['product']->name }}
                                        </a>
                                        <p class="cart-product-price">
                                            قیمت واحد: {{ number_format($cart_item['product']->price) }} تومان
                                        </p>
                                    </div>
                                    <div class="col-4 cart-count-box" data-slug="{{ $cart_item['product']->slug }}">
                                        <div class="cart-count-loading"></div>
                                        <i class="fa fa-plus cart-add-count" data-id="add"></i>
                                        <span class="cart-count">{{ $cart_item['quantity'] }}</span>
                                        <i class="fa fa-minus cart-remove-count" data-id="remove"></i>
                                    </div>
                                </div>
                                @unless($loop->last)
                                    <hr>
                                @endunless
                                @if ($loop->last)
                                    @if (cart()->all()->count() > 4)
                                        <div class="row my-4">
                                            <div class="col-12 text-left">
                                                <p class="more-products">
                                                    + {{ cart()->all()->count() - 4 }} محصول بیشتر
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row cart-actions">
                                        <div class="col-3">
                                            <form class="d-inline" action="{{ route('cart.clear') }}" method="post">
                                                @csrf
                                                <button class="bordered-primary-btn btn-small clear-cart-button w-100 text-center" type="submit">
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-9">
                                            <a class="boxed-btn btn-small show-cart-page w-100 text-center" href="{{ route('home.cart') }}">
                                                مشاهده سبد خرید
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p class="empty-cart">
                                    سبد خرید خالی می باشد!
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end mobile menu area -->
@endauth
