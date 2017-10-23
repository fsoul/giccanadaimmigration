'use strict';

var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var TextInput = (function () {
    function TextInput(lang, input) {
        DefaultInput.apply(this, arguments);
        var self = this;

        this.input.addEventListener('focusout', function (e) {
            self.doValidate(e);
        });

        this.input.addEventListener('input', function (e) {
            self.doValidate(e);
        });
    }

    TextInput.prototype = Object.create(DefaultInput.prototype);
    TextInput.prototype.constructor = TextInput;

    return TextInput;
})();

var EmailInput = (function () {

    function EmailInput(lang, input) {
        TextInput.apply(this, arguments);
    }

    EmailInput.prototype = Object.create(TextInput.prototype);
    EmailInput.prototype.constructor = EmailInput;

    EmailInput.prototype.getErrorMessage = function () {
        return {
            'en-US': 'Enter valid email.',
            'ru-RU': 'Введите валидный адрес электронной почты.'
        }[this.lang];
    };

    EmailInput.prototype.doValidate = function () {
        var mailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!this.input.value || !this.input.value.match(mailPattern)) {
            return this.doValidateError();
        } else {
            return this.doNormalize();
        }
    };

    return EmailInput;
})();

var TelInput = (function () {

    function TelInput(lang, input) {
        TextInput.apply(this, arguments);
    }

    TelInput.prototype = Object.create(TextInput.prototype);
    TelInput.prototype.constructor = TelInput;

    return TelInput;
})();

var CardNumberInput = (function () {

    function CardNumberInput(lang, input) {
        TextInput.apply(this, arguments);
        var self = this;

        this.input.addEventListener('keypress', function (e) {
            self.doKeyPress(e);
        });

        this.input.addEventListener('keydown', function (e) {
            self.doKeyDown(e);
        });
    }

    CardNumberInput.prototype = Object.create(TextInput.prototype);
    CardNumberInput.prototype.constructor = CardNumberInput;

    CardNumberInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'Please, enter correct card number.',
                'empty': TextInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Введите правильный номер карты.',
                'empty': TextInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    CardNumberInput.prototype.doValidate = function () {
        var val = this.input.value.replace(/\s/g, '');

        if (isNaN(+val)) {
            return this.doValidateError(STATES.invalid);
        } else if (val === '') {
            return this.doValidateError('empty');
        } else {
            return this.doNormalize();
        }
    };

    CardNumberInput.prototype.doValidateError = function (errType) {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage(errType));
        this.fire(new CustomEvent('onValidateError'));
        return false;
    };


    CardNumberInput.prototype.doKeyPress = function (e) {
        var val = this.input.value.replace(/\s/g, '');
        var key = e.key || String.fromCharCode(e.which) || String.fromCharCode(e.keyCode);
        if (val.length && !(val.length % 4) && val.length < 16 && ['Backspace', 'Delete'].lastIndexOf(key) === -1)
            this.input.value += ' ';
    };

    CardNumberInput.prototype.doKeyDown = function (e) {
        var val = this.input.value.replace(/\s/g, '');
        var key = e.key || String.fromCharCode(e.which) || String.fromCharCode(e.keyCode);
        if (( isNaN(+key) || val.length >= 16 ) && ['Backspace', 'Delete', 'ArrowUp', 'ArrowDown',
                'ArrowLeft', 'ArrowRight'].lastIndexOf(key) === -1)
            e.preventDefault();
    };

    return CardNumberInput;
})();

var CVCInput = (function () {

    function CVCInput(lang, input) {
        TextInput.apply(this, arguments);
        var self = this;

        this.input.addEventListener('keypress', function (e) {
            self.doKeyPress(e);
        });

        this.input.addEventListener('keydown', function (e) {
            self.doKeyDown(e);
        });
    }

    CVCInput.prototype = Object.create(TextInput.prototype);
    CVCInput.prototype.constructor = CVCInput;

    CVCInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'Please, enter correct CVV2/CVC2.',
                'empty': TextInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Введите правильный CVV2/CVC2.',
                'empty': TextInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    CVCInput.prototype.doValidate = function () {
        var val = this.input.value;
        if (isNaN(+val)) {
            return this.doValidateError(STATES.invalid);
        } else if (val === '') {
            return this.doValidateError('empty');
        } else {
            return this.doNormalize();
        }
    };

    CVCInput.prototype.doValidateError = function (errType) {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage(errType));
        this.fire(new CustomEvent('onValidateError'));
        return false;
    };

    CVCInput.prototype.doKeyDown = function (e) {
        var val = this.input.value;
        var key = e.key || String.fromCharCode(e.which) || String.fromCharCode(e.keyCode);
        if (( isNaN(+key) || val.length >= 3 ) && ['Backspace', 'Delete', 'ArrowUp', 'ArrowDown',
                'ArrowLeft', 'ArrowRight'].lastIndexOf(key) === -1)
            e.preventDefault();
    };

    return CVCInput;
})();

module.exports = {
    TextInput: TextInput,
    EmailInput: EmailInput,
    TelInput: TelInput,
    CardNumberInput: CardNumberInput,
    CVCInput: CVCInput
};