'use strict';

var helper =require('./lib/helpers');

/**
 * Function copies div.multiplication-container on click event
 * @see <div class="multiplication-container">
 * @param {MouseEvent} event
 */
var copyMultiplicationContainer = function (event) {

    /** Button must be inside selector '.assessment-step'
     * @param {EventTarget|Node} node button.ass-add-button
     * @return {Node} Returns div.multiplication-container
     */
    function findMContainer(node) {
        if (node.classList.contains('assessment-step')) {
            var res;
            for (var i = 0; i < node.childNodes.length; ++i) {
                var child = node.childNodes[i];
                if (child.nodeType === Node.ELEMENT_NODE &&
                    child.classList.contains('multiplication-container')) {
                    res = child;
                    break;
                }
            }
            return res;
        } else {
            return findMContainer(node.parentNode);
        }
    }


    /**
     * @param {string} id
     * @param {number} newId
     * @return {string} If matches then will return incremented 'id'
     * @throws {TypeError}
     */
    function getNewId(id, newId) {
        var changed = id.replace(/(-\d+)$/, function(){
            return '-' + newId;
        });
        if (id === changed) {
            throw new TypeError('Wrong item id');
        }
        return changed;
    }



    /**
     * @param {Node} node
     * @return {Node} Returns new node
     */
    function copyNode(node) {
        var newNode = node.cloneNode(true),
            copyCount = node.parentNode.querySelectorAll('.copied').length;

        newNode.classList.remove('multiplication-container');
        newNode.classList.add('copied');
        newNode.classList.add('-copy' + (copyCount + 1));

        var changeIdList = newNode.querySelectorAll('.to-change-id');

        for (var i = 0; i < changeIdList.length; ++i) {
            var item = changeIdList.item(i);
            switch (item.nodeName.toLowerCase()) {
                case 'input':
                case 'select':
                case 'textarea':
                    item.id = getNewId(item.id, copyCount + 1);
                    item.setAttribute('name',  getNewId(item.getAttribute('name'), copyCount + 1) );
                    break;
                case 'label':
                    item.htmlFor = getNewId(item.getAttribute('for'), copyCount + 1);
                    break;
                default:
                    throw new TypeError('Item must be instance of input/select/label');
            }
        }

        return newNode;
    }


    if (event && event instanceof MouseEvent) {
        event.preventDefault();
        var copyBtn = event.currentTarget,
            mContainer = findMContainer(copyBtn);

        var newNode = copyNode(mContainer);
        mContainer.parentNode.insertBefore(newNode, copyBtn.parentNode);
        newNode.scrollIntoView(true);
    }
};


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
        activePanel.style.maxHeight = activePanel.scrollHeight + "px";
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
    copyMultiplicationContainer: copyMultiplicationContainer,
    addFileToList: addFileToList,
    paymentMethodClick: paymentMethodClick,
    onProvinceChanged: onProvinceChanged
};