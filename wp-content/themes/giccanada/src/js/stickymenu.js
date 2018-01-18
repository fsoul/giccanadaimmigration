'use strict';

var helper = require('./lib/helpers');

function StickyMenu(header) {
    this._stuck = false;
    this._handlers = [];
    this._headerStickingStr = 'headerSticking';
    this._headerNormalizeStr = 'headerNormalize';
    if (!header)
        throw new TypeError('Header must not be null!');
    this._header = header;
    this._stickPoint = 0;
}

StickyMenu.prototype.init = function () {
    this._stickPoint = this._header.offsetTop;
    helper.throttle('scroll', this._headerStickingStr, this._header);
    helper.throttle('scroll', this._headerNormalizeStr, this._header);
    this._header.addEventListener(this._headerStickingStr, this.doHeadSticking);
    this._header.addEventListener(this._headerNormalizeStr, this.doHeaderNormalize);
    this.updateHeaderMenuPos();

    var $topMenu = $('#top-menu');
    $topMenu.find('li.dropdown').each(function (index, value) {
        var $dropdown = $(value);

        $dropdown.on('shown.bs.dropdown', function () {
            var width = 0;
            var $dropdownMenu = $(this).find('.dropdown-menu');

            $( ".dropdown-submenu" ).each(function( index, value ) {
                if (index < 4)
                    width += $(value).width();
                else {
                    $(value).width($( ".dropdown-submenu" )[index - 4].clientWidth - 30); //15 padding right
                }
            });

            var $menu = $(this);
            function menuResize() {
                $menu.find('.dropdown-toggle').dropdown('update');

                requestAnimationFrame(menuResize);
            }

            $dropdownMenu.width(Math.round(width + 150)); //padding right

            requestAnimationFrame(menuResize);
        });
    });
};

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
    var offset = window.pageYOffset;
    var distance = this._header.offsetTop - offset;
    var isMobile = helper.isMobile();

    if ((distance <= 0) && !this._stuck) {
        this.onHeaderSticking(isMobile);
    } else if (this._stuck && (offset <= this._stickPoint)) {
        this.onHeadNormalize(isMobile);
    }
};
/**
 * Subscribe ListenerElement on sticking and normalize header
 * @param {ListenerElement} listener
 */
StickyMenu.prototype.subscribe = function (listener) {
    this._handlers.push(listener);
    helper.throttle('scroll', this._headerNormalizeStr, listener.element);
    helper.throttle('scroll', this._headerStickingStr, listener.element);
};


StickyMenu.prototype.unsubscribe = function (elem) {
    this._handlers.slice(this._handlers.indexOf(elem), 1);
};

/**
 * Fire sticking and normalize listeners event
 * @param {string} eventName
 * @param {boolean} isMobile
 */
StickyMenu.prototype.fire = function (eventName, isMobile) {
    this._handlers.forEach(function (listener) {
        listener.element.dispatchEvent(new CustomEvent(eventName, {
            detail: {
                isMobile: isMobile
            }
        }));
    });
};

module.exports = StickyMenu;
