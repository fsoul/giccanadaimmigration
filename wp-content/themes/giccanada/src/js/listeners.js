"use strict";

var helper = require('./lib/helpers'),
    headerStickingStr = 'headerSticking',
    headerNormalizeStr = 'headerNormalize';


function ListenerElement() {
    this.element = {};
}


function MenuLogo() {
    var self = this;

    function init() {
        self.element = document.querySelector('.menu-logo');
        if (self.element) {
            self.element.addEventListener(headerStickingStr, self.doUpdateMenuLogo);
            self.element.addEventListener(headerNormalizeStr, self.doNormalizeMenuLogo);
        }
    }

    document.addEventListener('DOMContentLoaded', init);
}

MenuLogo.prototype = Object.create(ListenerElement.prototype);
MenuLogo.prototype.constructor = MenuLogo;

MenuLogo.prototype.doUpdateMenuLogo = function (event) {
    if (event.detail.isMobile) {
        this.style.background = 'none';
        this.style.height = '24px';
        this.style.width = 'auto';
        this.innerText = 'GIC Canada';
    }
};

MenuLogo.prototype.doNormalizeMenuLogo = function (event) {
    if (event.detail.isMobile) {
        this.removeAttribute('style');
        this.innerText = '';
    }
};


function MenuPhoneBlock() {
    var self = this;

    function init () {
        self.element = document.querySelector('.menu-phone-block');
        if (self.element) {
            self.element.addEventListener(headerStickingStr, self.doUpdateMenuPhoneBlock);
            self.element.addEventListener(headerNormalizeStr, self.doUpdateMenuPhoneBlock);
        }
    }

    document.addEventListener('DOMContentLoaded', init);
}

MenuPhoneBlock.prototype = Object.create(ListenerElement.prototype);
MenuPhoneBlock.prototype.constructor = MenuPhoneBlock;

MenuPhoneBlock.prototype.doUpdateMenuPhoneBlock = function (event) {
    if (event.detail.isMobile) {
        helper.toggle(this);
    }
};


function ButtonUp() {
    var self = this;

    function init () {
        self.element = document.getElementById('mobile-btn-up');
        if (self.element) {
            self.element.addEventListener(headerStickingStr, self.doUpdateButtonUp);
            self.element.addEventListener(headerNormalizeStr, self.doUpdateButtonUp);
            self.element.addEventListener('click', self.doClick);
        }
    }
    document.addEventListener('DOMContentLoaded', init);
}

ButtonUp.prototype = Object.create(ListenerElement.prototype);
ButtonUp.prototype.constructor = ButtonUp;

ButtonUp.prototype.doUpdateButtonUp = function (event) {
    if (event.detail.isMobile) {
        helper.toggle(this);
    }
};

ButtonUp.prototype.doClick = function (event) {
    event.preventDefault();
    var top = 0;
    var duration = 2000;
    helper.scrollToPos(duration, top);
};

module.exports = {
    menuLogo: new MenuLogo(),
    menuPhoneBlock: new MenuPhoneBlock(),
    buttonUp: new ButtonUp()
};