'use strict';

var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var NumberInput = (function () {
    function NumberInput(lang, input) {
        DefaultInput.apply(this, arguments);
        var self = this;

        this.input.addEventListener('focusout', function (e) {
            self.doValidate(e);
        });

        this.input.addEventListener('input', function (e) {
            self.doValidate(e);
        });
    }

    NumberInput.prototype = Object.create(DefaultInput.prototype);
    NumberInput.prototype.constructor = NumberInput;

    NumberInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'You should enter only digits.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Поле должно состоять из цифр.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    NumberInput.prototype.doValidate = function () {
        var pattern = /^[0-9\s]+$/;
        var value = this.input.value;
        var res = false;
        if (!value)
            res = this.doValidateError('empty');
        else if (!value.match(pattern))
            res = this.doValidateError('invalid-input');
        else
            res = this.doNormalize();
        return res;
    };

    NumberInput.prototype.doValidateError = function (errType) {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage(errType));
        this.fire(new CustomEvent('onValidateError'));
        return false;
    };

    return NumberInput;
})();

var TelInput = (function () {

    function TelInput(lang, input) {
        NumberInput.apply(this, arguments);
    }

    TelInput.prototype = Object.create(NumberInput.prototype);
    TelInput.prototype.constructor = TelInput;

    return TelInput;
})();

var CardNumberInput = (function () {

    function CardNumberInput(lang, input) {
        NumberInput.apply(this, arguments);
        var self = this;

        this.input.addEventListener('keypress', function (e) {
            self.doKeyPress(e);
        });

        this.input.addEventListener('keydown', function (e) {
            self.doKeyDown(e);
        });
    }

    CardNumberInput.prototype = Object.create(NumberInput.prototype);
    CardNumberInput.prototype.constructor = CardNumberInput;

    CardNumberInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'Please, enter correct card number.',
                'empty': NumberInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Введите правильный номер карты.',
                'empty': NumberInput.prototype.getErrorMessage.call(this)
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
        NumberInput.apply(this, arguments);
        var self = this;

        this.input.addEventListener('keypress', function (e) {
            self.doKeyPress(e);
        });

        this.input.addEventListener('keydown', function (e) {
            self.doKeyDown(e);
        });
    }

    CVCInput.prototype = Object.create(NumberInput.prototype);
    CVCInput.prototype.constructor = CVCInput;

    CVCInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'Please, enter correct CVV2/CVC2.',
                'empty': NumberInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Введите правильный CVV2/CVC2.',
                'empty': NumberInput.prototype.getErrorMessage.call(this)
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
    NumberInput: NumberInput,
    TelInput: TelInput,
    CardNumberInput: CardNumberInput,
    CVCInput: CVCInput
};