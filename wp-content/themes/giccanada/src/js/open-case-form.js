'use strict';

var helper = require('./lib/helpers');

function OpenCaseForm(renderFunc) {

    if (typeof renderFunc !== 'function') {
        throw new TypeError('Input parameter must be function!');
    }
    var self = this;

    this.render = renderFunc;
    this.form = document.getElementById('open-case-form');
    this.style = this.form.style;
    this.startTime = Date.now();
    this.isMobile = helper.isMobile();
    this.cancelButton = this.form.querySelector('.close');
    this.submitButton = this.form.querySelector('input[type=submit]');

    this.form.addEventListener('submit', function (e) {
        e.preventDefault();
        self.sendForm();
    });

    this.cancelButton.addEventListener('click', function (e) {
       e.preventDefault();
       self.formClose();
    });

    window.addEventListener('click', function (e) {
        self.onWindowClick(e);
    });

    var iso = helper.getCookie('iso');
    $('#open-case-country').val(iso).trigger('change');

    if (!this.isMobile) {
        $("#open-case-country").select2({
            width: 'resolve'
        });

        $("#open-case-lang").select2({
            width: 'resolve'
        });
    }

    this.timerInit();
}

OpenCaseForm.prototype.formShow = function () {
    this.style.display = 'block';
    this.render(this.form);
};

OpenCaseForm.prototype.formClose = function () {
    this.style.display = 'none';
};

OpenCaseForm.prototype.toggle = function () {
    this.style.display = this.style.display !== 'block' ?  this.formShow() : this.formClose();
};


OpenCaseForm.prototype.timerInit = function () {
    var self = this;

    function go(timeToShow) {
        var timerID = setInterval(function () {
            var currentTime = Math.round( (Date.now() - self.startTime) / 1000 );
            if (currentTime === timeToShow) {
                clearInterval(timerID);
                self.formShow();
            }
        }, 1000);
    }

    $.ajax({
        url: gic.ajaxurl,
        type: "POST",
        data: {'action': 'get_feedback_timer'},
        success: function (second) {
            go( parseInt(second) );
        },
        error:  function () {
            go(10);
        }
    });
};

OpenCaseForm.prototype.sendForm = function () {

    var self = this;

    var data = {
        'action': 'send_open_case_form',
        'form': {
            first_name: this.form.querySelector('input[name=first_name]').value,
            phone: this.form.querySelector('input[name=phone]').value,
            email: this.form.querySelector('input[name=email]').value,
            country: this.form.querySelector('select[name=country]').value,
            lang: this.form.querySelector('select[name=lang]').value
        }
    };

    $.ajax({
        url: gic.ajaxurl,
        type: "POST",
        dataType: 'json',
        data: data,
        success: function (data) {
            var span = document.createElement('span'),
                style = span.style;
            span.innerText = data.message;
            style.fontSize = '1em';
            style.display = 'block';
            style.textAlign = 'center';
            if (!data.isSuccess) {
                style.color = '#ce2029';
            } else {
                style.color = '#228b22';
            }

            self.submitButton.parentElement.insertBefore(span, self.submitButton);
            self.submitButton.disabled = true;
        }
    });
};

OpenCaseForm.prototype.onWindowClick = function (e) {

    function findParent(parentNode) {
        if (!parentNode) return false;

        if (parentNode.matches('#open-case-form')) {
            return true;
        } else {
            return !parentNode.matches('body') ? findParent(parentNode.parentElement) : false;
        }
    }

    if( !e.target.matches('#open-case') && !findParent(e.target)) {
        this.style.display = 'none';
    }
};

module.exports = OpenCaseForm;