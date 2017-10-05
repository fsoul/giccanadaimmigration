'use strict';

var OpenCaseForm = require('./open-case-form');

module.exports = (function () {

    function Widget() {

        var self = this;

        this.wrapper = document.querySelector('.footer-wrapper');
        this.footer = document.getElementById('footer');
        this.widget = document.querySelector('.fixed-right-panel');
        this.openCaseForm = new OpenCaseForm(this.toggle);
        this.api = Tawk_API || {};
        this.api.onChatMaximized = function () {
          self.doChatShow();
        };

        this.buttons = [];
        this.subscribers = [];

        this.widget.querySelectorAll('.fixed-panel-button').forEach(function (input) {
            self.buttons[input.id] = input;
        });

        this.buttons['live-chat'].addEventListener('click', function (e) {
            self.doChatToogle(e);
        });

        this.buttons['open-case'].addEventListener('click', function (e) {
            self.doOpenCaseToggle(e);
        });

        document.addEventListener('scroll', function () {
            self.doScroll();
        }, {passive: true});

        document.addEventListener('touchend', function () {
            self.doScroll();
        }, {passive: true});
    }

    Widget.prototype.doScroll = function () {
        var wrapperBottom = this.footer.offsetTop + this.wrapper.offsetTop + this.wrapper.clientHeight,
            windowHeight = document.documentElement.offsetHeight,
            scrollHeight = document.documentElement.scrollHeight,
            scrollTop = document.documentElement.scrollTop,
            clientHeight = document.documentElement.clientHeight;

        if (document.body.clientWidth <= 575) {
            if (scrollHeight - scrollTop - clientHeight <= windowHeight - wrapperBottom) {
                this.widget.style.bottom = windowHeight - wrapperBottom - (scrollHeight - scrollTop - clientHeight) + 'px';
            } else {
                this.widget.style.bottom = '0px';
            }
        } else {
            this.widget.removeAttribute('style');
        }
    };

    Widget.prototype.doChatToogle = function (e) {
        e.preventDefault();
        this.api.toggle();
    };


    /**
     *
     * @param {Element} form
     */
    Widget.prototype.toggle = function (form) {
        var widgetBlock = form,
            style = widgetBlock.style,
            widget = document.querySelector('.fixed-right-panel'),
            computedStyle =  window.getComputedStyle(widget, null),
            widgetBottom = widget.style.bottom || computedStyle.getPropertyValue('bottom');


        if (parseInt(widgetBottom) > 80) {
            style.bottom = widgetBottom;
            style.right = 10 + parseInt(computedStyle.getPropertyValue('width')) + 'px';
        } else {
            style.bottom = '0';
            style.right = '';
        }
    };


    /**
     *
     * @param {Element} input
     */
    Widget.prototype.subscribe = function (input) {
        this.subscribers.push(input);
    };

    /**
     *
     * @param {string} eventName
     */
    Widget.prototype.fire = function (eventName) {
        this.subscribers.forEach(function (input) {
            input.dispatchEvent(new CustomEvent(eventName))
        });
    };

    Widget.prototype.doChatShow = function () {
        var widgetBlock = document.querySelector('iframe[title=\'chat widget\']').parentNode;
        this.toggle(widgetBlock);
    };

    Widget.prototype.doOpenCaseToggle = function () {
        this.openCaseForm.toggle();
    };

    return new Widget();
})();
