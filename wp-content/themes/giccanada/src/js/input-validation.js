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
        this.fire(new CustomEvent('onValidateError'));
        return false;
    };

    DefaultInput.prototype.doNormalize = function () {
        this.setState(STATES.valid);
        this.setErrorText('');
        this.fire(new CustomEvent('onNormalize'));
        return true;
    };

    DefaultInput.prototype.subscribe = function (input) {
        this.subscribers.push(input);
    };

    /**
     * @param {CustomEvent} event
     */
    DefaultInput.prototype.fire = function (event) {
        this.subscribers.forEach(function (el) {
            el.dispatchEvent(event);
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

        this.input.addEventListener('onSetState', function (e) {
            self.setState(e.detail.state);
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
            this.dateParts[selects[i].className] = selects[i];
            this.subscribe(selects[i]);
        }
    };

    CombineDateSelect.prototype.getErrorMessage = function () {
        return { //TODO
            'en-US': 'Choose one of the list items.',
            'ru-RU': 'Укажите правильную дату.'
        }[this.lang];
    };

    CombineDateSelect.prototype.doValidate = function () {
        if (this.checkDate()) {
            return this.doValidateError();
        } else {
            return SelectInput.prototype.doValidate.apply(this);
        }
    };

    CombineDateSelect.prototype.doValidateError = function () {
        this.fire(new CustomEvent('onSetState', {
            detail: {
                state: STATES.invalid
            }
        }));
        this.setErrorText(this.getErrorMessage());
        return false;
    };

    CombineDateSelect.prototype.checkDate = function ( ) {
        var date = this.dateParts['date'].value,
            month = this.dateParts['month'].value,
            year = this.dateParts['year'].value;
        var d = new Date(year, month - 1, date);
        return isNaN(d) || d.getFullYear() != year || d.getMonth() + 1 != month || d.getDate() != date;
    };

    return CombineDateSelect;
})();

var PeriodDateSelect = (function () {

    function PeriodDateSelect(lang, input) {
        SelectInput.apply(this, arguments);
        this.id = input.id;
        this.dateParts = {
            from: {
                month: null,
                year: null
            },
            to: {
                month: null,
                year: null
            }
        };
        this.dataClass = this.input.getAttribute('data-class');
        this._initPeriod();
    }

    PeriodDateSelect.prototype = Object.create(SelectInput.prototype);
    PeriodDateSelect.prototype.constructor = PeriodDateSelect;


    PeriodDateSelect.prototype._initPeriod = function () {

        function findContainer(node) {
            return node.classList.contains('period-date') ? node : findContainer(node.parentNode);
        }
        this.container = findContainer(this.input);
        this.errorMsg = document.getElementById('error-' + this.container.id);

        var selects =  this.container.querySelectorAll('select[data-class=' + this.dataClass + ']');

        for (var i = 0; i < selects.length; ++i) {
            this.subscribe(selects[i]);
            if (selects[i].parentNode.classList.contains('from-date')){
                if (selects[i].classList.contains('month')) {
                    this.dateParts.from.month = selects[i];
                } else {
                    this.dateParts.from.year = selects[i];
                }
            } else {
                if (selects[i].classList.contains('month')) {
                    this.dateParts.to.month = selects[i];
                } else {
                    this.dateParts.to.year = selects[i];
                }
            }
        }
    };

    PeriodDateSelect.prototype.getErrorMessage = function () {
        return { //TODO
            'en-US': 'Choose one of the list items.',
            'ru-RU': 'Укажите правильную дату.'
        }[this.lang];
    };

    PeriodDateSelect.prototype.doValidate = function () {
        if (this.checkDate() ){
            return this.doValidateError();
        } else {
            return SelectInput.prototype.doValidate.apply(this);
        }
    };

    PeriodDateSelect.prototype.checkDate = function ( ) {
        var f = this.dateParts.from,
            t = this.dateParts.to;

        var dateF = new Date(f.year.value, f.month.value, 1),
            dateT = new Date(t.year.value, t.month.value, 1);

        var dateFIsCorrect = dateF.getFullYear() == f.year.value && dateF.getMonth() == f.month.value,
            dateTIsCorrect = dateT.getFullYear() == t.year.value && dateT.getMonth() == t.month.value;

        return isNaN(dateF) || isNaN(dateT) || !dateFIsCorrect || !dateTIsCorrect || dateT < dateF;
    };

    PeriodDateSelect.prototype.doValidateError = function () {
        this.fire(new CustomEvent('onSetState', {
            detail: {
                state: STATES.invalid
            }
        }));
        this.setErrorText(this.getErrorMessage());
        return false;
    };

    PeriodDateSelect.prototype.doNormalize = function () {
        this.fire(new CustomEvent('onSetState', {
            detail: {
                state: STATES.valid
            }
        }));
        this.setErrorText('');
        return true;
    };

    return PeriodDateSelect;
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
            case 'period-date-select':
                this.select = PeriodDateSelect;
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