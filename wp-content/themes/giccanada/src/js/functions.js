'use strict';

var helper = require('./lib/helpers');

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
                    item.id = getNewId(item.id, copyCount + 1);
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



module.exports = {
    copyMultiplicationContainer: copyMultiplicationContainer
};