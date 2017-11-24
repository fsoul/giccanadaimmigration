'use strict';

var STATES = {
    valid: 'valid-input',
    invalid: 'invalid-input',
    normal: 'normal'
};

var EventTarget = require('../lib/event-target');

function DefaultInput(lang, input) {
    EventTarget.call(this);
    this.lang = lang;
    this.id = input.id;
    this.errorMsg = document.getElementById('error-' + input.id);
    this.subscribers = [];
}

DefaultInput.prototype = Object.create(EventTarget.prototype);
DefaultInput.prototype.constructor = DefaultInput;

DefaultInput.prototype.input = function () {
    return document.getElementById(this.id)
};

DefaultInput.prototype.isRequired = function () {
    return this.input().hasAttribute('required');
};

DefaultInput.prototype.getErrorMessage = function () {
    return {
        'en-US': 'This field is required.',
        'ru-RU': 'Вы пропустили это поле.'
    }[this.lang];
};

DefaultInput.prototype.setState = function (newState) {
    var curState = this.getState();
    if (this.input() && curState !== newState) {
        this.input().classList.remove(curState);
        this.input().classList.add(newState);
    }
};

DefaultInput.prototype.getState = function () {
    var cl = this.input().classList;
    return cl.contains(STATES.invalid) ? STATES.invalid :
        cl.contains(STATES.valid) ? STATES.valid : STATES.normal;
};

DefaultInput.prototype.setErrorText = function (text) {
    if (this.errorMsg)
        this.errorMsg.innerText = text;
};

DefaultInput.prototype.doValidate = function () {
    if (this.isRequired() && !this.input().value) {
        this.doValidateError();
    } else {
        this.doNormalize();
    }
    return this.isValid();
};

DefaultInput.prototype.doValidateError = function () {
    this.setState(STATES.invalid);
    this.setErrorText(this.getErrorMessage());
    this.fire(new CustomEvent('onValidateError'));
};

DefaultInput.prototype.doNormalize = function () {
    this.setState(STATES.valid);
    this.setErrorText('');
    this.fire(new CustomEvent('onNormalize'));
};

DefaultInput.prototype.isValid = function () {
    return !this.input().classList.contains(STATES.invalid);
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