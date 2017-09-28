"use strict";

(function() {
    window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
})();

function throttle(type, name, obj) {
    obj = obj || window;
    var running = false;
    var func = function () {
        if (running) {
            return;
        }
        running = true;
        requestAnimationFrame(function () {
            obj.dispatchEvent(new CustomEvent(name));
            running = false;
        });
    };
    obj.addEventListener(type, func);
}

function toggle(elem) {
    if (getComputedStyle(elem).display === "none" ||
        elem.style.display === "none") {
        elem.style.display = 'block';
    } else {
        elem.style.display = 'none';
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

module.exports = {
    throttle: throttle,
    toggle: toggle,
    getCookie: getCookie,
    setCookie: setCookie
};