'use strict';
var DefaultInput = (function () {

    function DefaultInput(lang, input) {
        this.lang = lang;
        this.input = input;
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
        var type = this.input.type,
            next = this.input.nextElementSibling,
            id = this.input.id;

        this.input.classList.add('validation');

        if (!next || next.tagName.toUpperCase() !== 'P') {
            var p = document.createElement('p');
            p.classList.add('validationError');
            p.innerText = this.getErrorMessage(type, id);
            this.input.parentNode.insertBefore(p, this.nextSibling);
        }
        this.fire('onValidateError');
    };

    DefaultInput.prototype.doNormalize = function () {
        var next = this.input.nextElementSibling;
        this.input.classList.remove('validation');
        if (next && next.tagName.toUpperCase() === 'P' && next.classList.contains('validationError')) {
            next.parentNode.removeChild(next);
        }
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


var NameTextInput = (function () {

    function NameTextInput(lang, input) {
        DefaultTextInput.apply(this, arguments);
    }

    NameTextInput.prototype = Object.create(DefaultTextInput.prototype);
    NameTextInput.prototype.constructor = NameTextInput;

    NameTextInput.prototype.doValidate = function () {
        var pattern = /^[A-z-А-я]+$/;
        if (!this.input.value || !this.input.value.match(pattern)) {
            this.input.dispatchEvent(new CustomEvent('onValidateError'));
        } else {
            this.input.dispatchEvent(new CustomEvent('onNormalize'));
        }
    };

    NameTextInput.prototype.getErrorMessage = function () {
        return {
            'en-US': 'The First/Last Name can only contain alphabetic characters.',
            'ru-RU': 'Имя/Фамилия должны состоять из букв.'
        }[this.lang];
    };

    return NameTextInput;
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

var FlagSelectInput = (function () {

    function FlagSelectInput(lang, input) {
        SelectInput.apply(this, arguments);
        var self = this;

        this.input.onchange = function () {
            self.input.dispatchEvent(new CustomEvent('onCountryChange'));
            SelectInput.prototype.doValidate.apply(self);
        };

        this.input.addEventListener('onCountryChange', function (e) {
            self.doChangeCountry(e)
        });

        this.doChangeCountry();
    }

    FlagSelectInput.prototype = Object.create(SelectInput.prototype);
    FlagSelectInput.prototype.constructor = FlagSelectInput;

    FlagSelectInput.prototype.doChangeCountry = function (e) {
        var chosen = this.input.parentNode.querySelector('.select2-chosen'),
            style = chosen.style,
            code = getCountryCode(this.input.value);
        code = !code ? '' : code.toLowerCase();

        if (code) {
            style.background = 'url(https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/flags/4x3/' +
                code + '.svg) no-repeat 15px center';
            style.backgroundSize = '30px 20px';
            style.paddingLeft = '60px';
        } else {
            style.background = '';
            style.backgroundSize = '';
            style.paddingLeft = '';
        }
    };

    return FlagSelectInput;
})();

var BirthSelectInput = (function () {

    function BirthSelectInput() {
        FlagSelectInput.apply(this, arguments);
    }

    BirthSelectInput.prototype = Object.create(FlagSelectInput.prototype);
    BirthSelectInput.prototype.constructor = BirthSelectInput;

    BirthSelectInput.prototype.doValidate = function () {
        var stopCountry = 'Bangladesh,El Salvador,Hong Kong,Philippines,Brazil,Colombia,Haiti,Nigeria,' +
            'Jamaica,South Korea,Canada,Dominican Republic,India,Pakistan,Vietnam,China,Mexico,Ecuador,Peru';
        var birth_country = this.input.options[this.input.selectedIndex].value;
        if (stopCountry.indexOf(birth_country) >= 0 || !birth_country) {
            this.input.dispatchEvent(new CustomEvent('onValidateError'));
        } else {
            this.input.dispatchEvent(new CustomEvent('onNormalize'));
        }
    };

    BirthSelectInput.prototype.doValidateError = function () {
        var errMsg = document.getElementById('error-message');
        if (errMsg && errMsg.classList.contains('hidden'))
            errMsg.classList.remove('hidden');
        DefaultInput.prototype.doValidateError.apply(this);
    };

    BirthSelectInput.prototype.doNormalize = function () {
        var errMsg = document.getElementById('error-message');
        if (errMsg && !errMsg.classList.contains('hidden'))
            errMsg.classList.add('hidden');
        DefaultInput.prototype.doNormalize.apply(this);
    };


    return BirthSelectInput;
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
                this.inputClass = (input.id.indexOf('first_name') >= 0  ||
                    input.id.indexOf('last_name') >= 0) ? NameTextInput : DefaultTextInput;
                break;
            case 'email':
                this.inputClass = EmailInput;
                break;
            case 'tel':
                this.inputClass = TelInput;
                break;
            case 'select-one': //select input
                this.inputClass = input.id === 'birth_country' ? BirthSelectInput : FlagSelectInput;
                break;
            default:
                this.inputClass = DefaultInput;
        }

        return new this.inputClass(lang, input);
    };

    return InputsFactory;
})();
