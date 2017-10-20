'use strict';

var STATES = {
    valid: 'valid-input',
    invalid: 'invalid-input',
    normal: 'normal'
};

var DefaultInput = (function () {

    function DefaultInput(lang, input) {
        this.lang = lang;
        this.input = input;
        this.errorMsg = document.getElementById('error-' + input.id);
        this.subscribers = [];
    }

    DefaultInput.prototype.getErrorMessage = function () {
        return {
            'en-US': 'This field is required.',
            'ru-RU': 'Вы пропустили это поле.'
        }[this.lang];
    };

    DefaultInput.prototype.setState = function (newState) {
        var curState = this.getState();
        if (this.input && curState !== newState) {
            this.input.classList.remove(curState);
            this.input.classList.add(newState);
        }
    };

    DefaultInput.prototype.getState = function () {
        var cl = this.input.classList;
        return cl.contains(STATES.invalid) ? STATES.invalid :
            cl.contains(STATES.valid) ? STATES.valid : STATES.normal;
    };

    DefaultInput.prototype.setErrorText = function (text) {
        if (this.errorMsg)
            this.errorMsg.innerText = text;
    };

    DefaultInput.prototype.doValidate = function () {
        if (!this.input.value) {
            return this.doValidateError();
        } else {
            return this.doNormalize();
        }
    };

    DefaultInput.prototype.doValidateError = function () {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage());
        this.fire('onValidateError');
        return false;
    };

    DefaultInput.prototype.doNormalize = function () {
        this.setState(STATES.valid);
        this.setErrorText('');
        this.fire('onNormalize');
        return true;
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
            this.doValidateError();
        } else {
            this.doNormalize();
        }
    };

    return EmailInput;
})();

var TelInput = (function () {

    function TelInput(lang, input) {
        TextInput.apply(this, arguments);
        var self = this;
        this.input.addEventListener('keydown', function () {
            self.doValidate();
        })
    }

    TelInput.prototype = Object.create(TextInput.prototype);
    TelInput.prototype.constructor = TelInput;

    return TelInput;
})();

var SelectInput = (function () {

    function SelectInput(lang, input) {
        DefaultInput.apply(this, arguments);
        this.id = input.id;

        var self = this;

        this.input.addEventListener('change', function () {
            self.doValidate();
        });

        this.input.addEventListener('click', function () {
            self.doValidate();
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


var CombineDateSelect = (function () {

    function CombineDateSelect(lang, input) {
        SelectInput.apply(this, arguments);
        this.id = input.id;
        this.errorMsg = document.getElementById('error-' + input.getAttribute('data-class'));
        this.dateParts = [];
        this.dataClass = this.input.getAttribute('data-class');
        this._initCombine();
    }

    CombineDateSelect.prototype = Object.create(SelectInput.prototype);
    CombineDateSelect.prototype.constructor = CombineDateSelect;


    CombineDateSelect.prototype._initCombine = function () {
        var selects = this.input.parentNode
            .querySelectorAll('select[data-class=' + this.dataClass + ']');

        for (var i = 0; i < selects.length; ++i) {
            this.dateParts[selects[i].className] = new SelectInput(this.lang, selects[i]);
        }
    };

    CombineDateSelect.prototype.getErrorMessage = function (errorType) {
        switch (errorType) {
            case 'empty':
                return SelectInput.prototype.getErrorMessage.call(this);
                break;
            case 'invalid':
                return { //TODO
                    'en-US': 'Choose one of the list items.',
                    'ru-RU': 'Укажите правильную дату.'
                }[this.lang];
        }
    };

    CombineDateSelect.prototype.doValidate = function () {
        var date = this.dateParts['date'].input.value,
            month = this.dateParts['month'].input.value,
            year = this.dateParts['year'].input.value;
        var d = new Date([year, month, date].join('-'));
        if (isNaN(d) || d.getFullYear() != year || d.getMonth() + 1 != month || d.getDate() != date) {
            return this.doValidateError();
        } else {
            return SelectInput.prototype.doValidate.apply(this);
        }
    };

    CombineDateSelect.prototype.doValidateError = function () {
        for (var key in this.dateParts) {
            this.dateParts[key].setState(STATES.invalid);
        }
        this.setErrorText(this.getErrorMessage('invalid'));
        return false;
    };

    return CombineDateSelect;
})();

var SelectFactory = (function () {

    function SelectFactory() {
        this.select = SelectInput;
    }

    SelectFactory.prototype.createSelect = function (lang, select) {
        var type = select.getAttribute('data-type');
        switch (type) {
            case 'combine-date-select':
                this.select = CombineDateSelect;
                break;
            default:
                this.select = SelectInput;
        }
        return this.select;
    };
    return SelectFactory;
})();

var InputsFactory = (function () {

    function InputsFactory() {
        this.inputClass = DefaultInput;
    }

    InputsFactory.prototype.createInput = function (lang, input) {
        var selectFactory = new SelectFactory();
        switch (input.type) {
            case 'text':
                this.inputClass = TextInput;
                break;
            case 'email':
                this.inputClass = EmailInput;
                break;
            case 'tel':
                this.inputClass = TelInput;
                break;
            case 'select-one': //select input
            case 'select-multiple':
                this.inputClass = selectFactory.createSelect(lang, input);
                break;
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
    return factory.createInput(lang, el);
}

module.exports = {
    initByInput: initByInput
};