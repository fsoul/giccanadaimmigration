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

    var btnUp = document.getElementById('mobile-btn-up');
    var btnUplink = btnUp.querySelector('a');

    function onBtnUpScrollLoad () {
        var windowWidth = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth,
            scrollTop = window.pageYOffset;

        if (windowWidth <= 768 && scrollTop > 125)  {
            btnUp.style.display = 'block';
        } else {
            btnUp.style.display = 'none';
        }
    }

    function onBtnUpClick(event) {
        event.preventDefault();
        var id = this.getAttribute('href'),
            top = document.querySelector(id).offsetTop;

        var windowTop = window.pageYOffset;
        var timerID = setInterval(function () {
            if (windowTop <= top) {
                clearInterval(timerID);
            } else {
                window.scrollTo(0, windowTop -=50);
            }
        }, 10);
    }


    /* init - you can init any event */
    throttle("scroll", "scrollLoad", document);
    throttle("click", "click", btnUplink);

    // handle event
    document.addEventListener("scrollLoad", onBtnUpScrollLoad);
    btnUplink.addEventListener("click", onBtnUpClick);

    //on document load
    onBtnUpScrollLoad();
})();