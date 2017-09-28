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

module.exports = {
    throttle: throttle,
    toggle: toggle
};