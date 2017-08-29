'use strict';

import test from './js/test';


$( document ).ready(function() {
    window.onclick = test.onWindowClick;
    $('button.dropbtn').click(test.toggleMenu);
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

