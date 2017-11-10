'use strict';

var paymentMethodClick = function (e) {
    var target = e.target;
    var activePanel = target.nextElementSibling;
    var buttons = document.querySelectorAll('.payment-method input[type=radio] + label');

    for (var i = 0; i < buttons.length; ++i) {
        if (buttons[i].classList.contains('active')) {
            buttons[i].classList.remove('active');
            var next = buttons[i].nextElementSibling;
            if (next && next.classList.contains('payment-panel'))
                next.style.maxHeight = null;
        }
    }
    target.classList.toggle('active');
    if (activePanel && activePanel.classList.contains('payment-panel'))
        activePanel.style.maxHeight = 20*4 + activePanel.scrollHeight + "px";
};


/**
 * @param {string} code Selected province code is in upper case.
 * @param {string} selector Selector of Element in which cities have to be changed. Must be ID.
 */
var onProvinceChanged = function (code, selector) {

    $.ajax({
        url: gic.ajaxurl,
        type: "POST",
        data: {
            'action': 'get_cities_list_by_province',
            'code': code
        },
        dataType: 'json',
        success: function (cities) {
            var select = document.getElementById(selector);
            if (Array.isArray(cities)) {

                var i;
                for(i = 0; i < select.options.length; ++i) {
                    select.remove(i);
                }

                for (i = 0; i < cities.length; ++i) {
                    var option = document.createElement('option');
                    option.value = cities[i];
                    option.text = cities[i];
                    select.add(option);
                }

                if (select.length) {
                    select.classList.remove('invalid-input');
                    var errMsg = document.getElementById('error-' + select.id);
                    if (errMsg)
                        errMsg.innerText = '';
                }
            }
        }
    });
};
var onPartnerAddRadioClick = function (e) {
    var fd = new FormData();
    var div = document.getElementById(e.target.getAttribute('data-template'));
    var self = e.target;
    fd.append('action', 'get_additional_template');
    fd.append('template', e.target.getAttribute('data-template'));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', gic.ajaxurl, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var res = xhr.responseText;
            var copy = document.createElement('div');
            copy.classList.add('copied');
            copy.innerHTML = res;
            div.insertBefore(copy, null);

            var page = document.querySelector('fieldset.' + self.getAttribute('data-parent'));
            var insertedInputs = copy.querySelectorAll('input[type=text], input[type=tel], ' +
                'input[type=email], input[type=file], input[type=password], textarea, select, ' +
                'div[data-role=combine-date], div[data-role=period-date]');
            page.dispatchEvent(new CustomEvent('onCopyInputs', {
                detail: {
                    inputs: insertedInputs
                }
            }));

            var work = document.getElementById('part-work-cont');
            var educ = document.getElementById('part-educ-cont');
            work.style.display = 'block';
            educ.style.display = 'block';
        }
    };

    xhr.send(fd);
};

var onPartnerDelRadioClick = function (e) {
    var div = document.getElementById(e.target.getAttribute('data-template'));
    if (div.childNodes.length > 2) {
        var c = div.querySelector('.copied');
        div.removeChild(c);
        var work = document.getElementById('part-work-cont');
        var educ = document.getElementById('part-educ-cont');
        work.style.display = 'none';
        educ.style.display = 'none';

        var dels = work.querySelectorAll('span.added-file-delete');
        var i;
        for (i = 0; i < dels.length; ++i ) {
            dels.item(i).dispatchEvent(new Event('click'))
        }

        dels = educ.querySelectorAll('span.added-file-delete');
        for (i = 0; i < dels.length; ++i ) {
            dels.item(i).dispatchEvent(new Event('click'))
        }
    }
};


module.exports = {
    paymentMethodClick: paymentMethodClick,
    onProvinceChanged: onProvinceChanged,
    onPartnerDelRadioClick: onPartnerDelRadioClick,
    onPartnerAddRadioClick: onPartnerAddRadioClick
};