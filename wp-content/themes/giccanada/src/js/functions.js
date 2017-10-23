'use strict';

/**
 * @param {MouseEvent} e
 * @param {string} id Container's id
 * @param {Node} child The node that must be deleted.
 */
var deleteFileFromList = function (e, id, child) {
    e.preventDefault();
    var addContainer = document.getElementById(id).querySelector('.added-files');
    addContainer.removeChild(child);
};


/**
 * @param input input[type=file]
 * @param {string} id Container's id
 */
var addFileToList = function (input, id) {
    /**
     * @type {FileList}
     */
    var fList = input.files;

    var addContainer = document.getElementById(id).querySelector('.added-files');

    for (var i = 0; i < fList.length; ++i) {
        /**
         * @type {File}
         */
        var file = fList[i];
        var s = document.createElement('span');
        s.classList.add('added-file-name');
        s.innerHTML = file.name + '<span class="added-file-delete"><i class="fa fa-times"></i></span>';

        s.querySelector('.added-file-delete').onclick = function(e) {
            deleteFileFromList(e, id, this.parentNode);
        };

        //TODO Load file to server

        addContainer.insertBefore(s, null);

        input.innerHTML = input.innerHTML;
    }
};

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

module.exports = {
    addFileToList: addFileToList,
    paymentMethodClick: paymentMethodClick,
    onProvinceChanged: onProvinceChanged
};