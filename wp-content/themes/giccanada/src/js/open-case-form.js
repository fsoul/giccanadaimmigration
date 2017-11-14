'use strict';

var helper = require('./lib/helpers');
var validation = require('./input-validation');

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
    this.inputs = [];

    this.form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (self.validate()) {
            self.sendForm();
        }
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

    this.initInputs();
}

OpenCaseForm.prototype.formShow = function () {
    this.style.display = 'block';
    this.render(this.form);
};

OpenCaseForm.prototype.formClose = function () {
    this.style.display = 'none';
};

OpenCaseForm.prototype.toggle = function () {
    this.style.display = this.style.display !== 'block' ? this.formShow() : this.formClose();
};


OpenCaseForm.prototype.timerInit = function () {
    var self = this;

    function go(timeToShow) {
        var timerID = setInterval(function () {
            var currentTime = Math.round((Date.now() - self.startTime) / 1000);
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
            go(parseInt(second));
        },
        error: function () {
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
            var span = document.getElementById('error-open-case-form');
            span.innerText = data.message;
            if (data.isSuccess) {
                span.style.color = '#12c126';
                self.submitButton.disabled = true;
            }
            span.style.display = 'block';
            span.style.textAlign = 'center';
            span.style.paddingTop = '10px';
            span.style.visibility = 'visible';
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

    if (!e.target.matches('#open-case') && !findParent(e.target)) {
        this.style.display = 'none';
    }
};

OpenCaseForm.prototype.initInputs = function () {
    var inputs = this.form.querySelectorAll('input[type=text], input[type=tel], input[type=email], ' +
        'input[type=password], input[type=file], textarea, select, div[data-role=combine-date], ' +
        'div[data-role=period-date]');

    for (var i = 0; i < inputs.length; ++i) {
        if (!this.inputs.some(function (t) {
                return t.id === inputs[i].id;
            })) {
            this.inputs.push(validation.initByInput(inputs[i]))
        }
    }
};

OpenCaseForm.prototype.validate = function () {
    var result = true;
    for (var i = 0; i < this.inputs.length; ++i) {
        if ((typeof this.inputs[i].input === 'function' && !this.inputs[i].input()) ||
            (typeof this.inputs[i].div === 'function' && !this.inputs[i].div())) {
            this.inputs.splice(i, 1);
        } else
        if (typeof this.inputs[i].doValidate === 'function' && !this.inputs[i].doValidate()) {
            result = false;
        }
    }
    return result
};

module.exports = OpenCaseForm;