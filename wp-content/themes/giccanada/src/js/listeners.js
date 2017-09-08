var helper = require('./lib/helpers'),
    headerStickingStr = 'headerSticking',
    headerNormalizeStr = 'headerNormalize';


function ListenerElement() {
    this.element = {};
}


function MenuLogo() {
    document.addEventListener('DOMContentLoaded', this.init);
}

MenuLogo.prototype = Object.create(ListenerElement.prototype);
MenuLogo.prototype.constructor = MenuLogo;

MenuLogo.prototype.init = function () {
    this.element = document.querySelector('.menu-logo');
    this.element.addEventListener(headerStickingStr, self.doUpdateMenuLogo);
    this.element.addEventListener(headerNormalizeStr, self.doNormalizeMenuLogo);
};

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
    document.addEventListener('DOMContentLoaded', this.init);
}

MenuPhoneBlock.prototype = Object.create(ListenerElement.prototype);
MenuPhoneBlock.prototype.constructor = MenuPhoneBlock;

MenuPhoneBlock.prototype.init = function () {
    this.element = document.querySelector('.menu-phone-block');
    this.element.addEventListener(headerStickingStr, this.doUpdateMenuPhoneBlock);
    this.element.addEventListener(headerNormalizeStr, this.doUpdateMenuPhoneBlock);
};

MenuPhoneBlock.prototype.doUpdateMenuPhoneBlock = function (event) {
    if (event.detail.isMobile) {
        helper.toggle(this);
    }
};

module.exports = {
    menuLogo: new MenuLogo(),
    menuPhoneBlock: new MenuPhoneBlock()
};