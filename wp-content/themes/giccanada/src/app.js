'use strict';

require('./js/vendor/owl.carousel/owl.carousel');
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
    require('./js/window');
    require('./js/modal-menu');

    stickMenu.subscribe(menuLogo);
    stickMenu.subscribe(menuPhoneBlock);
    stickMenu.subscribe(buttonUp);
    stickMenu.init();

    document.addEventListener('scroll', function () {
        stickMenu.updateHeaderMenuPos();
    });

    document.addEventListener('scroll', function () {
        var wrapper = document.querySelector('.footer-wrapper');
        var windowHeight = document.documentElement.clientHeight;
        var bottom = document.getElementById('footer').offsetTop + wrapper.offsetTop + wrapper.clientHeight;
        var widget = document.querySelector('.fixed-right-panel');
        if (document.body.clientWidth <= 575) {
            if(window.pageYOffset + windowHeight >= bottom) {
                widget.style.bottom = window.pageYOffset + windowHeight - bottom - 48 +  'px';
            } else {
                widget.style.bottom = '0px';
            }
        } else {
            widget.removeAttribute('style');
        }
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


require('./scss/media-query.scss');
