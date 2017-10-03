function OpenCaseForm() {

    var self = this;

    this.form = document.getElementById('open-case-form');
    this.style = this.form.style;
    this.startTime = Date.now();
    this.timerInit(); //TODO Передавать время через которое включать таймер
    //TODO перенести функцию позиционирования сюда

    this.form.addEventListener('submit', function (e) {
        e.preventDefault();
        self.sendForm();
    });
}

OpenCaseForm.prototype.formShow = function () {
    this.style.display = 'block';
};

OpenCaseForm.prototype.formClose = function () {
    this.style.display = 'none';
};

OpenCaseForm.prototype.toggle = function () {
    this.style.display = this.style.display !== 'block' ?  this.formShow() : this.formClose();
};


OpenCaseForm.prototype.timerInit = function (timeToShow) {
    timeToShow = timeToShow || 5;
    var self = this;
    var timerID = setInterval(function () {
        var currentTime = Math.round( (Date.now() - self.startTime) / 1000 );
        console.log(currentTime);
        if (currentTime === timeToShow) {
            clearInterval(timerID);
            self.formShow();
        }
    }, 1000);
};

OpenCaseForm.prototype.validateForm = function () {

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


module.exports = OpenCaseForm;