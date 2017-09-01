'use strict';

import header from './js/header';
// const Window = require('./js/window');
//
// var windowObj = new Window();

function getContent() {
    let windowWidth = $(window).width();
    $.ajax({
        url: gic.ajaxurl,
        method: "POST",
        data: {
            action: 'get_content',
            windowWidth: windowWidth
        },
        dataType: "json"
    }).done(function (data) {
        $.each(data, function (i, val) {
            $("#" + i).html(val);
        });
    });
}


$(window).on('click', function (e) {
    header.onWindowClick(e);
});
$(window).on('scroll', function () {
    header.updateHeaderMenuPos();
});

$(window).on('load', function () {
    getContent();
    header.updateHeaderMenuPos();
});

$(window).on('resize', function () {
    header.updateHeaderMenuPos();
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

    $('.news-grid').find('.news-item').each( function (index) {
       if (index > 1 && $(window).width() <= 375) {
           $(this).css('display', 'none');
       }
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
