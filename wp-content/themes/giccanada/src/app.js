'use strict';

require('owl.carousel');
require('bootstrap');


var StickyMenu = require('./js/stickymenu');
var stickMenu = new StickyMenu();
var menuLogo = require('./js/listeners').menuLogo;
var menuPhoneBlock = require('./js/listeners').menuPhoneBlock;
var buttonUp = require('./js/listeners').buttonUp;


document.addEventListener('DOMContentLoaded', function () {

    $("#header-carousel").owlCarousel({
        autoPlay: true,
        loop: true,
        dots: true,
        items: 1
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
        var bottom = wrapper.offsetTop + wrapper.clientHeight;
        var widget = document.querySelector('.fixed-right-panel');
        if (document.body.clientWidth <= 575) {
            if(window.pageYOffset + window.innerHeight >= bottom) {
                widget.style.bottom = window.pageYOffset + window.innerHeight - bottom + 'px';
            } else {
                widget.style.bottom = '0px';
            }
        } else {
            widget.removeAttribute('style');
        }
    }, {passive: true});
});

//css/scss-------------------------------------------
require('~owl.carousel/src/scss/owl.carousel.scss');
require('~owl.carousel/src/scss/owl.theme.default.scss');
require('~bootstrap/scss/bootstrap.scss');

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
