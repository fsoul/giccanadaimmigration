'use strict';
var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var FileInput = (function () {

    function FileInput(lang, input) {
        DefaultInput.apply(this, arguments);
        this.maxSize = 2e+7;

        var self = this;

        this.input.onchange =  function () {
            self.doValidate();
        };
    }

    FileInput.prototype = Object.create(DefaultInput.prototype);
    FileInput.prototype.constructor = FileInput;

    /**
     * The function to validate uploaded file.
     * @param {File} file
     * @throws {RangeError} File size of uploaded file should be less than 20Mb
     */
    FileInput.prototype.checkSize = function (file) {
        if (file.size > this.maxSize)
            throw new RangeError('File size should be less than 20Mb');
    };

    FileInput.prototype.checkCount = function () {
        if (!this.input.files.length)
            throw new ReferenceError('File is required');
    };

    FileInput.prototype.doValidate = function () {
        try {
            this.checkCount();
            var file = this.input.files[0];
            this.checkSize(file);
            return this.doNormalize();
        } catch (e) {
            this.doValidateError(e.message);
        }
    };

    FileInput.prototype.doValidateError = function (errMsg) {
        this.setState(STATES.invalid);
        this.setErrorText(errMsg);
        this.fire(new CustomEvent('onValidateError'));
        return false;
    };

    return FileInput;
})();

var MultipleFileInput = (function () {

    function MultipleFileInput(lang, input) {
        FileInput.apply(this, arguments);
        this.addContainer = document.getElementById(this.input.getAttribute('data-container'));
        var self = this;
        this.input.onchange =  function () {
            self.doValidate();
        };
    }

    MultipleFileInput.prototype = Object.create(FileInput.prototype);
    MultipleFileInput.prototype.constructor = MultipleFileInput;

    MultipleFileInput.prototype.count = function () {
        return this.addContainer.childNodes.length;
    };

    MultipleFileInput.prototype.checkCount = function () {
        if (!this.count())
            throw new ReferenceError('Files are required');
    };

    MultipleFileInput.prototype.doValidate = function () {
        try {
            var fList = this.input.files;

            for (var i = 0; i < fList.length; ++i) {
                var file = fList[i];
                this.checkSize(file);
                this.add(file);
                //TODO Load file to server
            }
            this.checkCount();
            this.input.value = '';
            return this.doNormalize();
        } catch (e) {
            this.doValidateError(e.message);
        }
    };

    MultipleFileInput.prototype.add = function (file) {
        var s = document.createElement('span');
        var self = this;
        s.classList.add('added-file-name');
        s.innerHTML = file.name + '<span class="added-file-delete"><i class="fa fa-times"></i></span>';
        s.querySelector('.added-file-delete').onclick = function(e) {
            self.remove(e, this.parentNode);
        };
        this.addContainer.insertBefore(s, null);
    };

    /**
     * @param {MouseEvent} e
     * @param {Node} child The node that must be deleted.
     */
    MultipleFileInput.prototype.remove = function (e, child) {
        e.preventDefault();
        this.addContainer.removeChild(child);
    };


    /**
      * {File} @param file
     */
    MultipleFileInput.prototype.upload = function (file) {
        $.ajax({
            url: gic.ajaxurl,
            type: "POST",
            data: {
                'action': 'get_cities_list_by_province',
                'file': file
            },
            dataType: 'json',
            success: function () {
                console.log('file loaded');
            }
        });
    };

    return MultipleFileInput;
})();

module.exports = {
    FileInput: FileInput,
    MultipleFileInput: MultipleFileInput
};