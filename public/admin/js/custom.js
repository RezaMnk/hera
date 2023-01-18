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
});
