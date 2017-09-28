'use strict';

module.exports = (function () {

    function Widget() {

        var self = this;

        this.wrapper = document.querySelector('.footer-wrapper');
        this.footer = document.getElementById('footer');
        this.widget = document.querySelector('.fixed-right-panel');
        this.computedStyle =  window.getComputedStyle(this.widget, null);
        this.api = Tawk_API || {};
        this.api.onChatMaximized = function () {
          self.doChatShow();
        };

        this.buttons = [];

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

        window.addEventListener('click', function (e) {
            self.onWindowClick(e);
        });
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


    Widget.prototype.toggle = function (form) {
        var widgetBlock = form,
            style = widgetBlock.style,
            widgetBottom = this.widget.style.bottom || this.computedStyle.getPropertyValue('bottom');


        if (parseInt(widgetBottom) > 80) {
            style.bottom = widgetBottom;
            style.right = 10 + parseInt(this.computedStyle.getPropertyValue('width')) + 'px';
            style.marginRight = '';
        } else {
            style.bottom = 10 + parseInt(this.computedStyle.getPropertyValue('height')) + 'px';
            style.right = '50%';
            style.marginRight = -(widgetBlock.offsetWidth / 2) + 'px';

        }
    };

    Widget.prototype.doChatShow = function () {
        var widgetBlock = document.querySelector('iframe[title=\'chat widget\']').parentNode;
        this.toggle(widgetBlock);
    };

    Widget.prototype.doOpenCaseToggle = function () {
        var form = document.getElementById('open-case-form'),
            style = form.style;

        style.display = style.display !== 'block' ? 'block': 'none';
        this.toggle(form);
    };

    Widget.prototype.onWindowClick = function (e) {
        var form = document.getElementById('open-case-form'),
            style = form.style,
            left = form.offsetLeft,
            top =  window.pageYOffset + form.offsetTop,
            right = left + form.offsetWidth,
            bottom = top + form.offsetHeight ;

        if( !e.target.matches('#open-case') &&
            ( ( e.pageX < left || e.pageX > right ) || (e.pageY < top || e.pageY > bottom ) ) ) {
            style.display = 'none';
        }
    };

    return new Widget();
})();
