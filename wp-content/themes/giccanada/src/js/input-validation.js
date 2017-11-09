'use strict';

var DefaultInput = require('./validation/default-input').DefaultInput;

var text = require('./validation/text-input');
var select = require('./validation/select-input');
var file = require('./validation/file-input');
var number = require('./validation/number-input');

var TextInput = text.TextInput;
var EmailInput = text.EmailInput;

var NumberInput = number.NumberInput;
var TelInput = number.TelInput;
var CardNumberInput = number.CardNumberInput;
var CVCInput = number.CVCInput;

var SelectInput = select.SelectInput;
var CombineDateSelect = select.CombineDateSelect;
var PeriodDateSelect = select.PeriodDateSelect;

var FileInput = file.FileInput;
var MultipleFileInput = file.MultipleFileInput;
var PhotoInput = file.PhotoInput;

var InputsFactory = (function () {

    function InputsFactory() {
        this.inputClass = DefaultInput;
    }

    InputsFactory.prototype.createInput = function (lang, input) {
        var role = input.getAttribute('data-role');
        switch (role) {
            case 'text':
                this.inputClass = TextInput;
                break;
            case 'email':
                this.inputClass = EmailInput;
                break;
            case 'number':
                this.inputClass = NumberInput;
                break;
            case 'tel':
                this.inputClass = TelInput;
                break;
            case 'card-number':
                this.inputClass = CardNumberInput;
                break;
            case 'cvc':
                this.inputClass = CVCInput;
                break;
            case 'mixed':
                this.inputClass = DefaultInput;
                break;
            case 'file':
                this.inputClass = FileInput;
                break;
            case 'file-multiply':
                this.inputClass = MultipleFileInput;
                break;
            case 'file-photo':
                this.inputClass = PhotoInput;
                break;
            case 'select':
                this.inputClass = SelectInput;
                break;
            case 'combine-date':
                this.inputClass = CombineDateSelect;
                break;
            case 'period-date':
                this.inputClass = PeriodDateSelect;
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