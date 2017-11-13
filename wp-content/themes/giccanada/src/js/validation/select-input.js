'use strict';

var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var SelectInput = (function () {

    function SelectInput(lang, input) {
        DefaultInput.apply(this, arguments);
        var self = this;

        this.input().addEventListener('change', function () {
            self.doValidate();
        });

        this.input().addEventListener('click', function () {
            self.doValidate();
        });

        this.input().addEventListener('onSetState', function (e) {
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

    SelectInput.prototype.getValue = function () {
        return this.input().value;
    };

    return SelectInput;
})();

var CombineDateSelect = (function () {

    function CombineDateSelect(lang, input) {
        this.lang = lang;
        this.id = input.id;
        this.errorMsg = document.getElementById(this.div().getAttribute('data-msg'));
        this.dateParts = [];
        this._initCombine();
    }

    CombineDateSelect.prototype._initCombine = function () {
        var selects = this.div().querySelectorAll('select');
        var self = this;

        for (var i = 0; i < selects.length; ++i) {
            if (selects[i].classList.contains('day'))
                this.dateParts['day'] = new SelectInput(this.lang, selects[i]);
            else if (selects[i].classList.contains('month'))
                this.dateParts['month'] = new SelectInput(this.lang, selects[i]);
            else
                this.dateParts['year'] = new SelectInput(this.lang, selects[i]);

            selects[i].addEventListener('change', function () {
                self.doValidate();
            })
        }
    };

    CombineDateSelect.prototype.div = function () {
        return document.getElementById(this.id);
    };

    CombineDateSelect.prototype.getErrorMessage = function () {
        return { //TODO
            'en-US': 'Choose one of the list items.',
            'ru-RU': 'Укажите правильную дату.'
        }[this.lang];
    };

    CombineDateSelect.prototype.setState = function (newState) {
        for (var i = 0; i < this.dateParts; ++i) {
            this.dateParts[i].setState(newState)
        }
    };

    CombineDateSelect.prototype.setErrorText = function (text) {
        if (this.errorMsg)
            this.errorMsg.innerText = text;
    };

    CombineDateSelect.prototype.doValidate = function () {
        if (this.checkDate()) {
            return this.doValidateError();
        } else {
            return this.doNormalize();
        }
    };

    CombineDateSelect.prototype.doValidateError = function () {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage());
        return false;
    };

    CombineDateSelect.prototype.doNormalize = function () {
        this.setState(STATES.valid);
        this.setErrorText('');
        return true;
    };

    CombineDateSelect.prototype.checkDate = function () {
        var date = this.dateParts['day'].getValue(),
            month = this.dateParts['month'].getValue(),
            year = this.dateParts['year'].getValue();
        var d = new Date(year, month, date);
        return isNaN(d) || d.getFullYear() != year || d.getMonth() != month || d.getDate() != date;
    };

    return CombineDateSelect;
})();

var PeriodDateSelect = (function () {

    function PeriodDateSelect(lang, input) {
        this.lang = lang;
        this.id = input.id;
        this.errorMsg = document.getElementById(this.div().getAttribute('data-msg'));

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
        this._initPeriod();
    }

    PeriodDateSelect.prototype.div = function () {
        return document.getElementById(this.id);
    };

    PeriodDateSelect.prototype._initPeriod = function () {
        var self = this;
        var selects = this.div().querySelectorAll('select');

        for (var i = 0; i < selects.length; ++i) {
            if (selects[i].parentNode.classList.contains('from-date')) {
                if (selects[i].classList.contains('month')) {
                    this.dateParts.from.month = new SelectInput(this.lang, selects[i]);
                } else {
                    this.dateParts.from.year = new SelectInput(this.lang, selects[i]);
                }
            } else {
                if (selects[i].classList.contains('month')) {
                    this.dateParts.to.month = new SelectInput(this.lang, selects[i]);
                } else {
                    this.dateParts.to.year = new SelectInput(this.lang, selects[i]);
                }
            }

            selects[i].addEventListener('change', function () {
                self.doValidate();
            })
        }
    };

    PeriodDateSelect.prototype.getErrorMessage = function () {
        return { //TODO
            'en-US': 'Choose one of the list items.',
            'ru-RU': 'Укажите правильную дату.'
        }[this.lang];
    };

    PeriodDateSelect.prototype.setState = function (newState) {
        this.dateParts.from.month.setState(newState);
        this.dateParts.from.year.setState(newState);
        this.dateParts.to.month.setState(newState);
        this.dateParts.to.year.setState(newState);
    };

    PeriodDateSelect.prototype.setErrorText = function (text) {
        if (this.errorMsg)
            this.errorMsg.innerText = text;
    };

    PeriodDateSelect.prototype.doValidate = function () {
        if (this.checkDate()) {
            return this.doValidateError();
        } else {
            return this.doNormalize();
        }
    };

    PeriodDateSelect.prototype.doValidateError = function () {
        this.setState(STATES.invalid);
        this.setErrorText(this.getErrorMessage());
        return false;
    };

    PeriodDateSelect.prototype.doNormalize = function () {
        this.setState(STATES.valid);
        this.setErrorText('');
        return true;
    };

    PeriodDateSelect.prototype.checkDate = function () {
        var f = this.dateParts.from,
            t = this.dateParts.to;

        var dateF = new Date(f.year.input().value, f.month.input().value, 1),
            dateT = new Date(t.year.input().value, t.month.input().value, 1);

        var dateFIsCorrect = dateF.getFullYear() == f.year.input().value && dateF.getMonth() == f.month.input().value,
            dateTIsCorrect = dateT.getFullYear() == t.year.input().value && dateT.getMonth() == t.month.input().value;

        return isNaN(dateF) || isNaN(dateT) || !dateFIsCorrect || !dateTIsCorrect || dateT < dateF;
    };

    return PeriodDateSelect;
})();

module.exports = {
    SelectInput: SelectInput,
    CombineDateSelect: CombineDateSelect,
    PeriodDateSelect: PeriodDateSelect
};