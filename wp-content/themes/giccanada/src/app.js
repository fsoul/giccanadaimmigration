'use strict';

$(document).ready(function () {
    var helper = require('./js/lib/helpers');
    require('./js/header');
    var StickyMenu = require('./js/stickymenu');
    var stickMenu = new StickyMenu();
    require('./js/window');
    require('./js/btn-up');

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
