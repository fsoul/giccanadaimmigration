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
        if (!value)
            this.doValidateError('empty');
        else if (!value.match(pattern))
            this.doValidateError('invalid-input');
        else
            this.doNormalize();
        return this.isValid();
    };

    TextInput.prototype.doValidateError = function (errType) {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage(errType));
        this.fire(new CustomEvent('onValidateError'));
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
        if (!value)
            this.doValidateError('empty');
        else if (value.match(pattern))
            this.doValidateError('invalid-input');
        else
            this.doNormalize();
        return this.isValid();
    };

    return MixedInput;
})();

var EmailInput = (function () {

    function EmailInput(lang, input) {
        TextInput.apply(this, arguments);
    }

    EmailInput.prototype = Object.create(TextInput.prototype);
    EmailInput.prototype.constructor = EmailInput;


    EmailInput.prototype.getErrorMessage = function (errType) {
        return {
            'en-US': {
                'invalid-input': 'Enter valid email.',
                'exists': 'The email is already registered.'
            },
            'ru-RU': {
                'invalid-input': 'Введите валидный адрес электронной почты.',
                'exists': 'Указнанный емейл уже зарегестрирован.'
            }
        }[this.lang][errType];
    };

    EmailInput.prototype.doValidate = function () {
        var mailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        this.isExist();
        if (!this.input().value || !this.input().value.match(mailPattern)) {
            this.doValidateError('invalid-input');
        } else {
            this.doNormalize();
        }

        return this.isValid();
    };

    EmailInput.prototype.isExist = function () {
        var fd = new FormData();
        var xhr = new XMLHttpRequest();
        var self = this;

        fd.append('action', 'check_email_exist');
        fd.append('email', this.input().value);
        xhr.open('POST', gic.ajaxurl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText) {
                    self.doValidateError('exists');
                }
            }
        };
        xhr.send(fd);
    };

    return EmailInput;
})();

module.exports = {
    TextInput: TextInput,
    MixedInput: MixedInput,
    EmailInput: EmailInput
};