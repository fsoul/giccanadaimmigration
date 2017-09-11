"use strict";

var helper = require('./lib/helpers');

module.exports =  (function () {

    function MobileModalMenu() {
        this._modal = document.getElementById('mobile-modal');
        this._list = this._modal.querySelector('#modal-menu-list');
        var li = this._list.querySelectorAll('li.modal-item');
        var backArrow = document.getElementById('modal-back-arrow');

        for (var i = 0; i < li.length; ++i) {
            helper.throttle('', 'onHideItem', li[i]);
            helper.throttle('click', 'itemClick', li[i]);
            li[i].addEventListener('onHideItem', this.doHideItem);
            li[i].addEventListener('itemClick', this.doItemClick);
        }

        helper.throttle('', 'onHideItems', this._list);
        this._list.addEventListener('onHideItems', this.doFireHideItems);
        backArrow.addEventListener('click', function (e) {
            e.preventDefault();
            for (var i = 0; i < li.length; ++i) {
                li[i].classList.remove('to-hide');
                li[i].classList.remove('modal-inspected');
            }
            backArrow.style.visibility = 'hidden';
        });
    }


    MobileModalMenu.prototype.doItemClick = function () {
        if (this.children.length > 0) {
            this.classList.add('modal-inspected');
            this.parentElement.dispatchEvent(new CustomEvent('onHideItems'));
        }
    };

    MobileModalMenu.prototype.doFireHideItems = function () {
        var items = this.querySelectorAll('li.modal-item');
        for (var i = 0; i < items.length; ++i) {
            items[i].dispatchEvent(new CustomEvent('onHideItem'));
        }

        var backArrow = document.getElementById('modal-back-arrow');
        backArrow.style.visibility = 'initial';
    };

    MobileModalMenu.prototype.doHideItem = function () {
        if (!this.classList.contains('modal-inspected')) {
            this.classList.add('to-hide');
        }
    };
    return new MobileModalMenu();
})();
