'use strict';

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
                    break
                }
            }
            return res;
        } else {
            return findMContainer(node.parentNode);
        }
    }

    /**
     * @param {Node} node
     * @return {Node} Returns new node
     */
    function copyNode(node) {
        var newNode = node.cloneNode(true);
        newNode.classList.remove('multiplication-container');
        newNode.classList.add('copied');
        return newNode;
    }


    if (event && event instanceof MouseEvent) {
        event.preventDefault();
        var copyBtn = event.currentTarget,
            mContainer = findMContainer(copyBtn);
        mContainer.parentNode.insertBefore(copyNode(mContainer), mContainer.nextSibling);
    }
};



module.exports = {
    copyMultiplicationContainer: copyMultiplicationContainer
};