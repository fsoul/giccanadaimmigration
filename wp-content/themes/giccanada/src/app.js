'use strict';

var StickyMenu = require('./js/stickymenu');
var stickMenu = new StickyMenu();
var menuLogo = require('./js/listeners').menuLogo;
var menuPhoneBlock = require('./js/listeners').menuPhoneBlock;
var buttonUp = require('./js/listeners').buttonUp;

$(document).ready(function () {

    require('./js/header');
    require('./js/window');

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
        if(window.pageYOffset + window.innerHeight >= bottom) {
            widget.style.bottom = window.pageYOffset + window.innerHeight - bottom + 'px';
        } else {
            widget.style.bottom = '0px';
        }
    });
});

//scss-------------------------------------------
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
