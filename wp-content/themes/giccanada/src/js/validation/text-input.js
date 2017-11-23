'use strict';

var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var TextInput = (function () {
    function TextInput(lang, input) {
        DefaultInput.apply(this, arguments);
        var self = this;

        this.input().addEventListener('focusout', function (e) {
            self.doValidate(e);
        });

        this.input().addEventListener('input', function (e) {
            self.doValidate(e);
        });
    }

    TextInput.prototype = Object.create(DefaultInput.prototype);
    TextInput.prototype.constructor = TextInput;

    TextInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'You should use only characters.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Вы должны использовать символы [a-Z, а-Я]',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    TextInput.prototype.doValidate = function () {
        var pattern = /^[a-zA-z\u0400-\u04FF\s]+$/;
        var value = this.input().value;
        var res = false;

        if (this.isRequired()) {
            if (!value)
                res = this.doValidateError('empty');
            else if (!value.match(pattern))
                res = this.doValidateError('invalid-input');
            else
                res = this.doNormalize();
        } else {
            res = this.doNormalize();
        }

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

var MixedInput = (function () {
    function MixedInput(lang, input) {
        TextInput.apply(this, arguments);
    }

    MixedInput.prototype = Object.create(TextInput.prototype);
    MixedInput.prototype.constructor = MixedInput;

    MixedInput.prototype.getErrorMessage = function (errType) {
        return { //TODO
            'en-US': {
                'invalid-input': 'You should use only characters or digits.',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            },
            'ru-RU': {
                'invalid-input': 'Вы должны использовать символы [a-Z, а-Я] или цифры',
                'empty': DefaultInput.prototype.getErrorMessage.call(this)
            }
        }[this.lang][errType];
    };

    MixedInput.prototype.doValidate = function () {
        var value = this.input().value;
        var pattern = /[-[\]{}()@*+?.,\\^$|#\s]/g;
        var res = false;

        if (this.isRequired()) {
            if (!value)
                res = this.doValidateError('empty');
            else if (value.match(pattern))
                res = this.doValidateError('invalid-input');
            else
                res = this.doNormalize();
        } else {
            res = this.doNormalize();
        }
        return res;
    };

    return MixedInput;
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

        if (this.isRequired() && (!this.input().value || !this.input().value.match(mailPattern))) {
            return this.doValidateError();
        } else {
            return this.doNormalize();
        }
    };

    return EmailInput;
})();

module.exports = {
    TextInput: TextInput,
    MixedInput: MixedInput,
    EmailInput: EmailInput
};