'use strict';

import header from './js/header';

$(document).ready(function () {
    $(window).on('click', function (e) {
        header.onWindowClick(e);
    });

    $(window).on('scroll',
        function () {
            if ($(window).scrollTop() >= 150) {
                $('.menu-container').css({
                        'position': 'fixed',
                        'top': '0',
                        'margin-top': '0',
                        'box-shadow': '0px 2px 4px rgba(0, 0, 58, 0.5)',
                        'background': 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)'
                });
            } else {
                $('.menu-container').removeAttr('style');
            }
        });

    $('button.dropbtn').on('click', function () {
        header.toggleMenu();
    });
    $('.fixed-panel-button').hover(
        function () {
            header.onFixedButtonHover($(this));
        },
        function () {
            header.onFixedButtonHover($(this));
        }
    );
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
