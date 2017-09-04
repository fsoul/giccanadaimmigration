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

    var width = $(window).width(),
        scrollTop = $(window).scrollTop(),
        $btnUp = $("#mobile-btn-up");

    if (width <= 375 && scrollTop > 125)  {
        $btnUp.css('display', 'block');
    } else {
        $btnUp.removeAttr('style');
    }
});

$(window).on('load', function () {
    header.updateHeaderMenuPos();
    var width = $(window).width(),
        scrollTop = $(window).scrollTop(),
        $btnUp = $("#mobile-btn-up");

    if (width <= 375 && scrollTop > 125)  {
        $btnUp.css('display', 'block');
    } else {
        $btnUp.removeAttr('style');
    }

    $('#programms').find('.programms-grid-item').each(function (index) {
        if (index > 2 && width <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });


    $('.news-grid').find('.news-item').each(function (index) {
        if (index > 1 && width <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });

    if ( width <= 375 ){
        $('.academy').find('.academy-caption').text('Учебные программы');

    } else {
        $('.academy').find('.academy-caption').text('Учебные программы в Канаде');
    }
});


$(window).on('resize', function () {
    header.updateHeaderMenuPos();
    var width = $(window).width();

    $('#programms').find('.programms-grid-item').each(function (index) {
        if (index > 2 && width <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });


    $('.news-grid').find('.news-item').each(function (index) {
        if (index > 1 && width <= 375) {
            $(this).css('display', 'none');
        } else {
            $(this).css('display', 'block');
        }
    });

    if ( width <= 375 ){
        $('.academy').find('.academy-caption').text('Учебные программы');

    } else {
        $('.academy').find('.academy-caption').text('Учебные программы в Канаде');
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

    var $btnUp = $("#mobile-btn-up");
    $btnUp.on("click", "a", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();
        //забираем идентификатор бока с атрибута href
        var id  = $(this).attr('href'),
            //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = $(id).offset().top;
        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 1500);
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
