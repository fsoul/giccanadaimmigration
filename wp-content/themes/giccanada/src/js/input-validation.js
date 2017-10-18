'use strict';

var DefaultInput = (function () {

    function DefaultInput(lang, input) {
        this.lang = lang;
        this.input = input;
        this.errorMsg = document.getElementById('error-' + input.id);
        this.subscribers = [];
        var self = this;

        this.input.addEventListener('focusout', function () {
            self.input.dispatchEvent(new CustomEvent('onValidate'));
        });

        this.input.addEventListener('input', function () {
            self.input.dispatchEvent(new CustomEvent('onValidate'));
        });

        this.input.addEventListener('onValidate', function (e) {
            self.doValidate(e);
        });

        this.input.addEventListener('onValidateError', function (e) {
            self.doValidateError(e);
        });

        this.input.addEventListener('onNormalize', function (e) {
            self.doNormalize(e);
        });
    }

    DefaultInput.prototype.getErrorMessage = function () {
        return {
            'en-US': 'This field is required.',
            'ru-RU': 'Вы пропустили это поле.'
        }[this.lang];
    };

    DefaultInput.prototype.doValidate = function () {
        if (!this.input.value) {
            this.input.dispatchEvent(new CustomEvent('onValidateError'));
        } else {
            this.input.dispatchEvent(new CustomEvent('onNormalize'));
        }
    };

    DefaultInput.prototype.doValidateError = function () {
        this.input.classList.toggle('validation');
        this.errorMsg.classList.toggle('validationError');
        this.errorMsg.innerText = this.getErrorMessage();
        this.fire('onValidateError');
    };

    DefaultInput.prototype.doNormalize = function () {
        this.input.classList.toggle('validation');
        this.errorMsg.classList.toggle('validationError');
        this.errorMsg.innerText = '';
        this.fire('onNormalize');
    };

    DefaultInput.prototype.subscribe = function (input) {
        this.subscribers.push(input);
    };

    DefaultInput.prototype.fire = function (eventName) {
        this.subscribers.forEach(function (el) {
            el.dispatchEvent(new CustomEvent(eventName));
        });
    };

    return DefaultInput;
})();


var DefaultTextInput = (function () {

    var STATES = {
        valid: 'valid-text-input',
        invalid: 'invalid-text-input'
    };

    function DefaultTextInput(lang, input) {
        DefaultInput.apply(this, arguments);
        this.state = STATES.normal;
    }

    DefaultTextInput.prototype = Object.create(DefaultInput.prototype);
    DefaultTextInput.prototype.constructor = DefaultTextInput;

    DefaultTextInput.prototype.doValidateError = function () {
        if (this.state !== STATES.invalid) {
            this.input.classList.remove(this.state);
            this.state = STATES.invalid;
            this.input.classList.add(this.state);
        }
        DefaultInput.prototype.doValidateError.apply(this);
    };

    DefaultTextInput.prototype.doNormalize = function () {
        if (this.state !== STATES.valid) {
            this.input.classList.remove(this.state);
            this.state = STATES.valid;
            this.input.classList.add(this.state);
        }
        DefaultInput.prototype.doNormalize.apply(this);
    };

    return DefaultTextInput;
})();

var EmailInput = (function () {

    function EmailInput(lang, input) {
        DefaultTextInput.apply(this, arguments);
    }

    EmailInput.prototype = Object.create(DefaultTextInput.prototype);
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
            this.input.dispatchEvent(new CustomEvent('onValidateError'));
        } else {
            this.input.dispatchEvent(new CustomEvent('onNormalize'));
        }
    };

    return EmailInput;
})();

var SelectInput = (function () {

    function SelectInput(lang, input) {
        DefaultInput.apply(this, arguments);
        this.id = input.id;
        var self = this;

        this.input.onchange = function (e) {
            self.doValidate(e);
        };

        this.input.addEventListener('click', function (e) {
            self.doValidate(e);
        });

        this.input.addEventListener('onValidate', function (e) {
            self.doValidate(e);
        });
    }

    SelectInput.prototype = Object.create(DefaultInput.prototype);
    SelectInput.prototype.constructor = SelectInput;

    SelectInput.prototype.getErrorMessage = function () {
        return {
            'en-US': 'Choose one of the list items.',
            'ru-RU': 'Выберите один из пунктов списка.'
        }[this.lang];
    };

    return SelectInput;
})();

var TelInput = (function () {

    function TelInput(lang, input) {
        DefaultTextInput.apply(this, arguments);
        var self = this;
        this.input.addEventListener('keydown', function () {
            self.doValidate();
        })
    }

    TelInput.prototype = Object.create(DefaultTextInput.prototype);
    TelInput.prototype.constructor = TelInput;

    return TelInput;
})();

var InputsFactory = (function () {

    function InputsFactory() {
        this.inputClass = DefaultInput;
    }

    InputsFactory.prototype.createInput = function (lang, input) {
        switch (input.type) {
            case 'text':
                this.inputClass = DefaultTextInput;
                break;
            case 'email':
                this.inputClass = EmailInput;
                break;
            case 'tel':
                this.inputClass = TelInput;
                break;
            // case 'select-one': //select input
            //     this.inputClass = input.id === 'birth_country' ? BirthSelectInput : FlagSelectInput;
            //     break;
            default:
                this.inputClass = DefaultInput;
        }

        return new this.inputClass(lang, input);
    };

    return InputsFactory;
})();


function initByInput(el) {
    var lang = 'ru-RU'; //TODO
    var factory = new InputsFactory();
    factory.createInput(lang, el);
}

module.exports = {
    initByInput: initByInput
};