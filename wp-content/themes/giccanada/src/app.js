'use strict';

require('./js/lib/polyfills');
require('./js/vendor/owl.carousel/owl.carousel');
require('./js/vendor/select2/select2');
require('./js/vendor/jquery.steps');
require('bootstrap');


var StickyMenu = require('./js/stickymenu');
var stickMenu = new StickyMenu();
var listeners = require('./js/listeners');
var menuLogo = listeners.menuLogo;
var menuPhoneBlock = listeners.menuPhoneBlock;
var buttonUp = listeners.buttonUp;


document.addEventListener('DOMContentLoaded', function () {

    $("#header-carousel").owlCarousel({
        autoPlay: true,
        loop: true,
        dots: true,
        items: 1
    });

    $("#academy-carousel").owlCarousel({
        autoPlay: true,
        dots: true,
        loop: true,
        margin: 15,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });

    $("#reviews-carousel").owlCarousel({
        autoPlay: true,
        dots: true,
        loop: true,
        margin: 15,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            769: {
                items: 3
            }
        }
    });

    $('#mobile-modal').on('hidden.bs.modal', function () {
        var li = this.querySelectorAll('li.modal-item');
        for (var i = 0; i < li.length; ++i) {
            li[i].classList.remove('to-hide');
            li[i].classList.remove('modal-inspected');
        }
        var backArrow = document.getElementById('modal-back-arrow');
        backArrow.style.visibility = 'hidden';
    });

    require('./js/header');
    require('./js/widget');
    require('./js/window');
    require('./js/modal-menu');
    require('./js/assessment-form');

    stickMenu.subscribe(menuLogo);
    stickMenu.subscribe(menuPhoneBlock);
    stickMenu.subscribe(buttonUp);
    stickMenu.init();

    document.addEventListener('scroll', function () {
        stickMenu.updateHeaderMenuPos();
    });
});

//css/scss-------------------------------------------
require('./scss/global.scss');
require('./scss/header.scss');
require('./scss/programms.scss');
require('./scss/academy.scss');
require('./scss/common-info.scss');
require('./scss/process.scss');
require('./scss/reviews.scss');
require('./scss/news.scss');
require('./scss/footer.scss');
require('./scss/assessment-form.scss');


require('./scss/media-query.scss');
