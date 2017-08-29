'use strict';

import header from './js/header';

$( document ).ready(function() {
    window.onclick = header.onWindowClick;
    $('button.dropbtn').click(header.toggleMenu);
    $('.fixed-panel-button').hover(
        function () {
            $(this).parent().find('.fixed-pnl-btn-hover').css('display', 'inline-block');
        },
        function () {
            $(this).parent().find('.fixed-pnl-btn-hover').css('display', 'none')
        });
});

//scss-------------------------------------------
import './scss/global.scss';
import './scss/header.scss';
import './scss/programms.scss';
import './scss/academy.scss';
import './scss/common-info.scss';
import './scss/process.scss';
import './scss/reviews.scss';
import './scss/news.scss';
import './scss/footer.scss';


import './scss/media-query.scss';
