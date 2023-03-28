(function ($) {
    "use strict";

    $(document).ready(function($){

        // testimonial sliders
        $(".testimonial-sliders").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:1,
                    nav:false
                },
                1000:{
                    items:1,
                    nav:false,
                    loop:true
                }
            }
        });

        // homepage slider
        $(".homepage-slider").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: true,
            rtl: true,
            dots: false,
            navText: ['<i class="fas fa-angle-right"></i>', '<i class="fas fa-angle-left"></i>'],
            responsive:{
                0:{
                    items:1,
                    nav:false,
                    loop:true
                },
                600:{
                    items:1,
                    nav:true,
                    loop:true
                },
                1000:{
                    items:1,
                    nav:true,
                    loop:true
                }
            }
        });

        // logo carousel
        $(".logo-carousel-inner").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            margin: 30,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:false,
                    loop:true
                }
            }
        });

        // filters carousel
        $(".filters-carousel").owlCarousel({
            items: 5,
            nav: true,
            rtl: true,
            dots: false,
            navText: ['<i class="fas fa-angle-right"></i>', '<i class="fas fa-angle-left"></i>'],
            responsive:{
                0:{
                    items: 2,
                },
                600:{
                    items: 4,
                },
                1000:{
                    items: 5,
                }
            }
        });

        // projects filters isotop
        $(".product-filters li").on('click', function () {

            $(".product-filters li").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr('data-filter');

            $(".product-lists").isotope({
                filter: selector,
                isOriginLeft: false
            });

        });


        // homepage slides animations
        $(".homepage-slider").on("translate.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").removeClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });

        $(".homepage-slider").on("translated.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").addClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });



        // stikcy js
        $("#sticker").sticky({
            topSpacing: 0
        });

        document.addEventListener('scroll', function (event) {
            if($(window).scrollTop() > 0)
                $('.mobile-static-menu').addClass('fixed-menu')
            else
                $('.mobile-static-menu').removeClass('fixed-menu')

        }, true /*Capture event*/);

        // //mean menu
        // $('.main-menu').meanmenu({
        //     meanMenuContainer: '.mobile-menu',
        //     meanScreenWidth: "992"
        // });

         // search form
        $(".search-bar-icon").on("click", function(){
            $(".search-area").addClass("search-active");
        });

        $(".search-close").on("click", function() {
            $(".search-area").removeClass("search-active");
        });

         // mobile menu
        $(".mobile-menu").on("click", function(){
            $(".mobile-menu-area").addClass("menu-active");
        });

        $(".mobile-menu-close").on("click", function() {
            $(".mobile-menu-area").removeClass("menu-active");
        });

         // mobile cart
        $(".mobile-cart").on("click", function(){
            $(".mobile-cart-area").addClass("menu-active");
        });

        $(".mobile-cart-close").on("click", function() {
            $(".mobile-cart-area").removeClass("menu-active");
        });

    });


    jQuery(window).on("load",function(){

        // isotop inner
        setTimeout(function() {
            $(".product-lists").isotope({
                isOriginLeft: false,
                layoutMode: 'fitRows',

            });
        }, 100);

        jQuery(".loader").fadeOut(1000);
    });

    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 50,
        rtl: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })

}(jQuery));

async function get_map(id)
{
    return fetch('/api/get-map', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: id,
        })
    }).then((data) => {
        return data.json()
    }).then((map) => {
        return map
    })
}

async function search_address(address)
{
    return fetch('/api/search-address', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            address: address,
        })
    }).then((data) => {
        return data.json()
    }).then((data) => {
        return data
    })
}
