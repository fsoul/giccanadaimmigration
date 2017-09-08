'use strict';

var helper = require('./js/lib/helpers');

var StickyMenu = require('./js/stickymenu');
var stickMenu = new StickyMenu();
var menuLogo = require('./js/listeners').menuLogo;
var menuPhoneBlock = require('./js/listeners').menuPhoneBlock;

$(document).ready(function () {

    require('./js/header');
    require('./js/window');
    require('./js/btn-up');

    stickMenu.subscribe(menuLogo.logo);
    stickMenu.subscribe(menuPhoneBlock.menuPhoneBlock);

    document.addEventListener('scroll', function () {
        stickMenu.updateHeaderMenuPos();
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
