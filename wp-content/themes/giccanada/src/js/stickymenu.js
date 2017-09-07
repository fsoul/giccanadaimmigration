'use strict';


module.exports = (function () {
    var helper = require('./lib/helpers');

    function StickyMenu() {
        this._header = document.getElementById("menu-container");
        this._stuck = false;
        this._stickPoint = this._header.offsetTop;
        this._handlers = [];
        this._headerStickingStr = 'headerSticking';
        this._headerNormalizeStr = 'headerNormalize';

        this.updateHeaderMenuPos();

        helper.throttle('scroll', this._headerStickingStr, this._header);
        helper.throttle('scroll', this._headerNormalizeStr, this._header);
        this._header.addEventListener(this._headerStickingStr, this.doHeadSticking);
        this._header.addEventListener(this._headerNormalizeStr, this.doHeaderNormalize);
    }

    StickyMenu.prototype.onHeaderSticking = function (isMobile) {
        this._header.dispatchEvent(new CustomEvent(this._headerStickingStr, {
            detail: {
                isMobile: isMobile
            }
        }));
    };

    StickyMenu.prototype.onHeadNormalize = function (isMobile) {
        this._header.dispatchEvent(new CustomEvent(this._headerNormalizeStr, {
            detail: {
                isMobile: isMobile
            }
        }));
    };

    StickyMenu.prototype.doHeadSticking = function (event) {
        this._header.style.position = 'fixed';
        this._header.style.top = '0px';
        this._header.style.marginTop = '0px';
        this._header.style.boxShadow = '0px 2px 4px rgba(0, 0, 58, 0.5)';
        this._header.style.background = 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)';
        this._stuck = true;

        this.fire(this._headerStickingStr, event.detail.isMobile);
    };

    StickyMenu.prototype.doHeaderNormalize = function(event) {
        this._header.removeAttribute('style');
        this._stuck = false;

        this.fire(this._headerNormalizeStr, event.detail.isMobile);
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

    return StickyMenu;
})();


// module.exports = (function () {
//
//     var helper = require('./lib/helpers');
//     var header = document.getElementById("menu-container");
//     var menuLogo = header.querySelector('.menu-logo');
//     var menuPhoneBlock = header.querySelector('.menu-phone-block');
//     var stuck = false;
//     var stickPoint = getDistance();
//
//     function getDistance() {
//         return header.offsetTop;
//     }
//
//     function onHeaderSticking(isMobile) {
//         header.dispatchEvent(new CustomEvent('headerSticking', {
//             detail: {
//                 isMobile: isMobile
//             }
//         }));
//     }
//
//     function onHeadNormalize(isMobile) {
//         header.dispatchEvent(new CustomEvent('headerNormalize', {
//             detail: {
//                 isMobile: isMobile
//             }
//         }));
//     }
//
//     function doHeadSticking(event) {
//         header.style.position = 'fixed';
//         header.style.top = '0px';
//         header.style.marginTop = '0px';
//         header.style.boxShadow = '0px 2px 4px rgba(0, 0, 58, 0.5)';
//         header.style.background = 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)';
//         stuck = true;
//
//         menuLogo.dispatchEvent(new CustomEvent('headerSticking', {
//             detail: {
//                 isMobile: event.detail.isMobile
//             }
//         }));
//
//         menuPhoneBlock.dispatchEvent(new CustomEvent('headerSticking', {
//             detail: {
//                 isMobile: event.detail.isMobile
//             }
//         }));
//     }
//
//     function doHeaderNomalize(event) {
//         header.removeAttribute('style');
//         stuck = false;
//
//         menuLogo.dispatchEvent(new CustomEvent('headerNormalize', {
//             detail: {
//                 isMobile: event.detail.isMobile
//             }
//         }));
//
//         menuPhoneBlock.dispatchEvent(new CustomEvent('headerNormalize', {
//             detail: {
//                 isMobile: event.detail.isMobile
//             }
//         }));
//     }
//
//     function doUpdateMenuLogo(event) {
//         if (event.detail.isMobile) {
//             menuLogo.style.background = 'none';
//             menuLogo.style.height = '24px';
//             menuLogo.style.width = 'auto';
//             menuLogo.innerText = 'GIC Canada';
//         }
//     }
//
//     function doNormalizeMenuLogo(event) {
//         if (event.detail.isMobile) {
//             menuLogo.removeAttribute('style');
//             menuLogo.innerText = '';
//         }
//     }
//
//
//     function doUpdateMenuPhoneBlock(event) {
//         if (event.detail.isMobile) {
//             menuPhoneBlock.style.display = 'inline-block';
//         }
//     }
//
//     function doNormalizeMenuPhoneBlock(event) {
//         if (event.detail.isMobile) {
//             menuPhoneBlock.style.display = 'none';
//         }
//     }
//
//     function updateHeaderMenuPos() {
//         var windowWidth = window.innerWidth
//             || document.documentElement.clientWidth
//             || document.body.clientWidth;
//         var offset = window.pageYOffset;
//         var distance = getDistance() - offset;
//         var isMobile = windowWidth <= 768;
//
//         if ((distance <= 0) && !stuck) {
//             onHeaderSticking(isMobile);
//         } else if (stuck && (offset <= stickPoint)) {
//             onHeadNormalize(isMobile);
//         }
//     }
//
//     //on document load
//     updateHeaderMenuPos();
//
//     helper.throttle('scroll', 'updateHeaderMenuPos', document);
//     helper.throttle('scroll', 'headerSticking', header);
//     helper.throttle('scroll', 'headerNormalize', header);
//     helper.throttle('scroll', 'headerSticking', menuLogo);
//     helper.throttle('scroll', 'headerNormalize', menuLogo);
//     helper.throttle('scroll', 'headerSticking', menuPhoneBlock);
//     helper.throttle('scroll', 'headerNormalize', menuPhoneBlock);
//
//     document.addEventListener('updateHeaderMenuPos', updateHeaderMenuPos);
//     header.addEventListener('headerSticking', doHeadSticking);
//     header.addEventListener('headerNormalize', doHeaderNomalize);
//     menuLogo.addEventListener('headerSticking', doUpdateMenuLogo);
//     menuLogo.addEventListener('headerNormalize', doNormalizeMenuLogo);
//     menuPhoneBlock.addEventListener('headerSticking', doUpdateMenuPhoneBlock);
//     menuPhoneBlock.addEventListener('headerNormalize', doNormalizeMenuPhoneBlock);
// })();