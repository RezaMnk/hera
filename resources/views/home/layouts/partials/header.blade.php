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
                    <div class="site-logo">
                        <a href="{{ route('home.home') }}">
                            <img src="{{ asset('assets/img/logo-w.png') }}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item" @class(['current-list-item' => request()->routeIs('home.home')])>
                                <a href="#">خانه</a>
                            </li>
                            <li>
                                <a href="{{ route('home.menu') }}">منو</a>
                            </li>
                            <li>
                                <a href="about.html">درباره ما</a>
                            </li>
                            <li>
                                <a href="contact.html">تماس با ما</a>
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
                                    <a class="mobile-hide search-bar-icon" href="#">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    @auth
                        <a class="mobile-show profile-icon" href="#">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a class="mobile-show profile-icon" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    @endauth
                    <a class="mobile-show search-bar-icon" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn">
                    <i class="fas fa-window-close"></i>
                </span>
                <form action="{{ route('home.menu') }}" class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>جست و جو:</h3>
                        <input type="text" name="search" placeholder="نام غذا">
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
