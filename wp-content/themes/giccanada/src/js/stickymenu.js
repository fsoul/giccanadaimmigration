'use strict';

var helper = require('./lib/helpers');

function StickyMenu() {
    this._stuck = false;
    this._handlers = [];
    this._headerStickingStr = 'headerSticking';
    this._headerNormalizeStr = 'headerNormalize';
    var self = this;
    function init() {
        self._header = document.getElementById("menu-container");
        self._stickPoint = self._header.offsetTop;
        helper.throttle('scroll', self._headerStickingStr, self._header);
        helper.throttle('scroll', self._headerNormalizeStr, self._header);
        self._header.addEventListener(self._headerStickingStr, self.doHeadSticking);
        self._header.addEventListener(self._headerNormalizeStr, self.doHeaderNormalize);
        self.updateHeaderMenuPos();
    }

    document.addEventListener('DOMContentLoaded', init);
}

StickyMenu.prototype.onHeaderSticking = function (isMobile) {
    this._header.dispatchEvent(new CustomEvent(this._headerStickingStr, {
        detail: {
            isMobile: isMobile,
            context: this
        }
    }));
};

StickyMenu.prototype.onHeadNormalize = function (isMobile) {
    this._header.dispatchEvent(new CustomEvent(this._headerNormalizeStr, {
        detail: {
            isMobile: isMobile,
            context: this
        }
    }));
};

StickyMenu.prototype.doHeadSticking = function (event) {
    var stMenu = event.detail.context;
    stMenu._header.style.position = 'fixed';
    stMenu._header.style.top = '0px';
    stMenu._header.style.marginTop = '0px';
    stMenu._header.style.boxShadow = '0px 2px 4px rgba(0, 0, 58, 0.5)';
    stMenu._header.style.background = 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)';
    stMenu._stuck = true;
    stMenu.fire(stMenu._headerStickingStr, event.detail.isMobile);
};

StickyMenu.prototype.doHeaderNormalize = function(event) {
    var stMenu = event.detail.context;
    stMenu._header.removeAttribute('style');
    stMenu._stuck = false;

    stMenu.fire(stMenu._headerNormalizeStr, event.detail.isMobile);
};

StickyMenu.prototype.updateHeaderMenuPos =  function () {
    var windowWidth = window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
    var offset = window.pageYOffset;
    var distance = this._header.offsetTop - offset;
    var isMobile = windowWidth <= 768;

    if ((distance <= 0) && !this._stuck) {
        this.onHeaderSticking(isMobile);
    } else if (this._stuck && (offset <= this._stickPoint)) {
        this.onHeadNormalize(isMobile);
    }
};

StickyMenu.prototype.subscribe = function (elem) {
    this._handlers.push(elem);
    helper.throttle('scroll', this._headerNormalizeStr, elem);
    helper.throttle('scroll', this._headerStickingStr, elem);
};

StickyMenu.prototype.unsubscribe = function (elem) {
    this._handlers.slice(this._handlers.indexOf(elem), 1);
};

StickyMenu.prototype.fire = function (eventName, isMobile) {
    this._handlers.forEach(function (element) {
        element.dispatchEvent(new CustomEvent(eventName, {
            detail: {
                isMobile: isMobile
            }
        }));
    });
};

module.exports = StickyMenu;
