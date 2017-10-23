'use strict';

var DefaultInput = require('./validation/default-input').DefaultInput;

var text = require('./validation/text-input');
var select = require('./validation/select-input');

var TextInput = text.TextInput;
var EmailInput = text.EmailInput;
var TelInput = text.TelInput;
var CardNumberInput = text.CardNumberInput;
var CVCInput = text.CVCInput;

var SelectInput = select.SelectInput;
var CombineDateSelect = select.CombineDateSelect;
var PeriodDateSelect = select.PeriodDateSelect;

var TextFactory = (function () {

    function TextFactory() {
        this.class = TextInput;
    }

    TextFactory.prototype.create = function (lang, el) {
        var type = el.getAttribute('data-type');
        switch (type) {
            case 'card-number-text':
                this.class = CardNumberInput;
                break;
            case 'cvc-code-text':
                this.class = CVCInput;
                break;
        }
        return this.class;
    };
    return TextFactory;
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
        var selectFactory = new SelectFactory(),
            textFactory = new TextFactory();
        switch (input.type) {
            case 'text':
            case 'password':
                this.inputClass = textFactory.create(lang, input);
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