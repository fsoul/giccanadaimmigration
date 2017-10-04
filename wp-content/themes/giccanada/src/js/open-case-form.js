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
    this.isMobile = window.innerWidth <= 575;
    this.timerInit(); //TODO Передавать время через которое включать таймер

    this.form.addEventListener('submit', function (e) {
        e.preventDefault();
        self.sendForm();
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


OpenCaseForm.prototype.timerInit = function (timeToShow) {
    timeToShow = timeToShow || 10;
    var self = this;
    var timerID = setInterval(function () {
        var currentTime = Math.round( (Date.now() - self.startTime) / 1000 );
        if (currentTime === timeToShow) {
            clearInterval(timerID);
            self.formShow();
        }
    }, 1000);
};

OpenCaseForm.prototype.sendForm = function () {

    var data = {
        'action': 'send_open_case_form',
        'form': {
            firstName: this.form.querySelector('input[name=first_name]').value,
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
            console.log(data);
        }
    });
};

OpenCaseForm.prototype.onWindowClick = function (e) {
    var left = this.form.offsetLeft,
        top =  window.pageYOffset + this.form.offsetTop,
        right = left + this.form.offsetWidth,
        bottom = top + this.form.offsetHeight ;

    if( !e.target.matches('#open-case') &&
        ( ( e.pageX < left || e.pageX > right ) || (e.pageY < top || e.pageY > bottom ) ) ) {
        this.style.display = 'none';
    }
};

module.exports = OpenCaseForm;