'use strict';

module.exports = (function () {

    function Widget() {

        var self = this;

        this.wrapper = document.querySelector('.footer-wrapper');
        this.footer = document.getElementById('footer');
        this.widget = document.querySelector('.fixed-right-panel');
        this.api = Tawk_API || {};
        this.api.onChatMaximized = function () {
          self.doShow();
        };

        this.buttons = [];

        this.widget.querySelectorAll('.fixed-panel-button').forEach(function (input) {
            self.buttons[input.id] = input;
        });

        this.buttons['live-chat'].addEventListener('click', function (e) {
            self.doToggleChat(e);
        });

        document.addEventListener('scroll', function () {
            self.doScroll();
        });

    }

    Widget.prototype.doScroll = function () {
        var wrapperBottom = this.footer.offsetTop + this.wrapper.offsetTop + this.wrapper.clientHeight,
            windowHeight = document.documentElement.clientHeight;
        if (document.body.clientWidth <= 575) {
            if (window.pageYOffset + windowHeight >= wrapperBottom) {
                this.widget.style.bottom = window.pageYOffset + windowHeight - wrapperBottom - 48 + 'px';
            } else {
                this.widget.style.bottom = '0px';
            }
        } else {
            this.widget.removeAttribute('style');
        }
    };

    Widget.prototype.doToggleChat = function (e) {
        e.preventDefault();
        this.api.toggle();
    };

    Widget.prototype.doShow = function () {
        var widgetBlock = document.querySelector('iframe[title=\'chat widget\']').parentNode;
        var style =  window.getComputedStyle(this.widget, null);
        widgetBlock.style.bottom = (this.widget.style.bottom || style.getPropertyValue('bottom'));
        widgetBlock.style.right = 10 + parseInt(style.getPropertyValue('width')) + 'px';
    };

    return new Widget();
})();
