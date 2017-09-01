'use strict';

import header from './js/header';
// const Window = require('./js/window');
//
// var windowObj = new Window();

$(window).on('click', function (e) {
    header.onWindowClick(e);
});
$(window).on('scroll', function () {
    header.updateHeaderMenuPos();
});

$(window).on('load', function () {
    header.updateHeaderMenuPos();

    $('#programms').find('').each(function (index) {
        if (index > 2 && $(window).width() <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });


    $('.news-grid').find('.news-item').each(function (index) {
        if (index > 1 && $(window).width() <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });

    if ( $(window).width() <= 375 ){
        $('#academy-container').find('.academy-caption').text('Учебные программы');

    } else {
        $('#academy-container').find('.academy-caption').text('Учебные программы в Канаде');
    }

});

$(window).on('resize', function () {
    header.updateHeaderMenuPos();

    $('#programms').find('').each(function (index) {
        if (index > 2 && $(window).width() <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });

    $('.news-grid').find('.news-item').each(function (index) {
        if (index > 1 && $(window).width() <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });

    if ( $(window).width() <= 375 ){
        $('#academy-container').find('.academy-caption').text('Учебные программы');

    } else {
        $('#academy-container').find('.academy-caption').text('Учебные программы в Канаде');
    }

});

$(document).ready(function () {
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
