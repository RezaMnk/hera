'use strict';

function fullscreen() {
    localStorage.setItem("fullscreen", localStorage.getItem('fullscreen') === 'true' ? 'false' : 'true')
    document.body.classList.toggle("small-navigation");
    document.getElementById("fullscreen").classList.toggle("ti-arrow-left");
    document.getElementById("fullscreen").classList.toggle("ti-arrow-right");
}

document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('fullscreen') === 'true')
    {
        document.body.classList.toggle("small-navigation");
        document.getElementById("fullscreen").classList.toggle("ti-arrow-left");
        document.getElementById("fullscreen").classList.toggle("ti-arrow-right");
    }

    let new_order_beep = new Audio('../../assets/audio/ping.mp3');
    Echo.channel('new-order')
        .listen('NewOrder', (e) => {
            new_order_beep.play();
            toastr.options = {
                timeOut: 10000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 200,
                onclick: function() {
                    window.open(e.route, '_blank').focus();
                }
            };
            toastr.info(`سفارش جدید دریافت شد: #${e.order.id}`);

            document.getElementById("new-order-badge").classList.remove("d-none");
        });
});
