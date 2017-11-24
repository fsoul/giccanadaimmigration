'use strict';

var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var NumberInput = (function () {
    function NumberInput(lang, input) {
        DefaultInput.apply(this, arguments);
        var self = this;

        this.input().addEventListener('focusout', function (e) {
            self.doValidate(e);
        });

        this.input().addEventListener('input', function (e) {
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
        var value = this.input().value;

        if (this.isRequired()) {
            if (!value)
                this.doValidateError('empty');
            else if (!value.match(pattern))
                this.doValidateError('invalid-input');
            else
                this.doNormalize();
        } else {
            this.doNormalize();
        }

        return this.isValid();
    };

    NumberInput.prototype.doValidateError = function (errType) {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage(errType));
        this.fire(new CustomEvent('onValidateError'));
    };

    return NumberInput;
})();

var TelInput = (function () {

    function TelInput(lang, input) {
        NumberInput.apply(this, arguments);
    }

    TelInput.prototype = Object.create(NumberInput.prototype);
    TelInput.prototype.constructor = TelInput;

    TelInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'Use correct phone number.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Укажите корректный номер телефона.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    TelInput.prototype.doValidate = function () {
        var value = this.input().value;
        var pattern = /^\+?\d{0,13}$/;

        if (this.isRequired()) {
            if (!value)
                this.doValidateError('empty');
            else if (!value.match(pattern))
                this.doValidateError('invalid-input');
            else
                this.doNormalize();
        } else {
            this.doNormalize();
        }
        return this.isValid();
    };

    return TelInput;
})();

module.exports = {
    NumberInput: NumberInput,
    TelInput: TelInput
};