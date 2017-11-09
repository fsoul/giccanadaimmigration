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

    TextInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'You should enter only characters.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Поле должно состоять из символов a-Z, а-Я',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    TextInput.prototype.doValidate = function () {
        var pattern = /^[a-zA-z\u0400-\u04FF\s]+$/;
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

    TextInput.prototype.doValidateError = function (errType) {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage(errType));
        this.fire(new CustomEvent('onValidateError'));
        return false;
    };

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

module.exports = {
    TextInput: TextInput,
    EmailInput: EmailInput
};