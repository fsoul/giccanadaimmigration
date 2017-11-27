'use strict';

module.exports =  (function() {
    var helper = require('./lib/helpers');

    function onWindowLoadResize () {
        var windowWidth = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
        var isMobile = helper.isMobile();

        var programmsItems = document.getElementsByClassName('programms-grid-item');
        var i;
        for (i = 0; i < programmsItems.length; ++i) {
            if (i > 2 && isMobile) {
                programmsItems[i].style.display = 'none';
            } else {
                programmsItems[i].style.display = 'block';
            }
        }

        var newsItems = document.getElementsByClassName('news-item');
        for (i = 0; i < newsItems.length; ++i) {
            if (i > 1 && isMobile) {
                newsItems[i].style.display = 'none';
            } else {
                newsItems[i].style.display = 'block';
            }
        }
        var academyCaption = document.querySelector('.academy-caption');
        if (academyCaption)
            academyCaption.innerText = isMobile ?  'Учебные программы' : 'Учебные программы в Канаде';
    }

    /* init - you can init any event */
    helper.throttle("resize", "optimizedResize");

    // handle event
    window.addEventListener("optimizedResize", onWindowLoadResize);

    //on document load
    onWindowLoadResize();
})();