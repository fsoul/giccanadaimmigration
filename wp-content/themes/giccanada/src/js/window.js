'use strict';

module.exports =  (function() {
    var throttle = function(type, name, obj) {
        obj = obj || window;
        var running = false;
        var func = function() {
            if (running) { return; }
            running = true;
            requestAnimationFrame(function() {
                obj.dispatchEvent(new CustomEvent(name));
                running = false;
            });
        };
        obj.addEventListener(type, func);
    };

    function onWindowLoadResize () {
        var windowWidth = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;

        var programmsItems = document.getElementsByClassName('programms-grid-item');
        for (var i = 0; i < programmsItems.length; ++i) {
            if (i > 2 && windowWidth <= 768) {
                programmsItems[i].style.display = 'none';
            } else {
                programmsItems[i].style.display = 'block';
            }
        }

        var newsItems = document.getElementsByClassName('news-item');
        for (var i = 0; i < newsItems.length; ++i) {
            if (i > 1 && windowWidth <= 768) {
                newsItems[i].style.display = 'none';
            } else {
                newsItems[i].style.display = 'block';
            }
        }
        var academyCaption = document.querySelector('.academy-caption');
        academyCaption.innerText = windowWidth <= 375 ?  'Учебные программы' : 'Учебные программы в Канаде';
    }

    /* init - you can init any event */
    throttle("resize", "optimizedResize");

    // handle event
    window.addEventListener("optimizedResize", onWindowLoadResize);

    //on document load
    onWindowLoadResize();
})();