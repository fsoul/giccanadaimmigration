'use strict';

var STATES = {
    valid: 'valid-input',
    invalid: 'invalid-input',
    normal: 'normal'
};

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

module.exports = {
    DefaultInput: DefaultInput,
    STATES: STATES
};