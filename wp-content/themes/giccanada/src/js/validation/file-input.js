'use strict';
var d = require('./default-input');
var DefaultInput = d.DefaultInput;
var STATES = d.STATES;

var FileInput = (function () {

    function FileInput(lang, input) {
        DefaultInput.apply(this, arguments);
        this.maxSize = 2e+7;
        this.type = this.input.getAttribute('data-attach');
        var self = this;
        this.input.onchange = function () {
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
            }
            this.checkCount();
            this.input.value = '';
            return this.doNormalize();
        } catch (e) {
            this.doValidateError(e.message);
        }
    };

    MultipleFileInput.prototype.createFileNode = function (text) {
        var progress = document.createElement('div');
        var bar = document.createElement('div');
        var caption = document.createElement('span');
        var del = document.createElement('span');

        var self = this;

        progress.classList.add('progress');
        progress.classList.add('ass-file-p');
        progress.appendChild(bar);

        bar.classList.add('progress-bar');
        bar.classList.add('ass-file-pb');
        bar.setAttribute('role', 'progressbar');
        bar.setAttribute('aria-valuemin', '0');
        bar.setAttribute('aria-valuenow', '0');
        bar.setAttribute('aria-valuemax', '100');
        bar.style.width = "0%";
        bar.appendChild(caption);

        caption.classList.add('added-file-name');
        caption.innerText = text;
        caption.appendChild(del);

        del.classList.add('added-file-delete');
        del.innerHTML = '<i class="fa fa-times"></i>';

        del.onclick = function (e) {
            self.remove(e, progress);
        };

        this.addContainer.insertBefore(progress, null);

        return bar;
    };

    MultipleFileInput.prototype.upload = function (file, bar) {

        var fd = new FormData();

        fd.append('file', file);
        fd.append('filename', file.name);
        fd.append('type', this.type);
        fd.append('action', 'upload_file');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', gic.ajaxurl, true);


        if (bar) {
            xhr.upload.onprogress = function (event) {
                var p = (event.loaded / event.total) * 100;
                if (p < 90) {
                    bar.style.width = p + '%';
                    bar.setAttribute('aria-valuenow', p);
                } else {
                    bar.style.width = '90%';
                    bar.setAttribute('aria-valuenow', 90);
                }
            };

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var res = JSON.parse(xhr.responseText);
                    if (res.error || !res.success) {
                        bar.style.width = '0%';
                        bar.setAttribute('aria-valuenow', 0);
                        throw new Error(res.error);
                    }
                    bar.style.width = '100%';
                    bar.setAttribute('aria-valuenow', 100);
                }
            };
        }

        xhr.send(fd);
    };

    /**
     * @param {File} file
     */
    MultipleFileInput.prototype.add = function (file) {
        var bar = this.createFileNode(file.name);
        this.upload(file, bar);
    };

    /**
     * @param {MouseEvent} e
     * @param child The node that must be deleted.
     */
    MultipleFileInput.prototype.remove = function (e, child) {
        var caption = child.querySelector('.added-file-name');
        var filename = caption.innerText;
        var fd = new FormData();
        var self = this;
        fd.append('filename', filename);
        fd.append('action', 'remove_file_from_session');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', gic.ajaxurl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var res = JSON.parse(xhr.responseText);
                if (res.error || !res.success) {
                    throw new Error(res.error || 'File not found');
                }
                self.addContainer.removeChild(child);
            }
        };
        xhr.send(fd);
    };

    return MultipleFileInput;
})();


var PhotoInput = (function () {

    function PhotoInput(lang, input) {
        FileInput.apply(this, arguments);

        this.options = {
            viewport: {width: 200, height: 250},
            boundary: {width: 266, height: 266}
        };
        var self = this;
        this.filename = '';

        this.input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                // if (self.filename) {
                //     self.remove(self.filename);
                // }
                self.filename = this.files[0].name;
                self.showPhoto(this.files[0]);
            }
        });

        this.addEventListener('upload', function () {
            self.upload();
        });
    }

    PhotoInput.prototype = Object.create(FileInput.prototype);
    PhotoInput.prototype.constructor = PhotoInput;

    PhotoInput.prototype.showPhoto = function (file) {
        if (!this.croppie)
            this.croppie = new Croppie(document.getElementById(this.input.getAttribute('data-photo')), this.options);
        if ( file ) {
            var reader = new FileReader();
            var self = this;
            reader.onload = function (e) {
                self.croppie.bind({
                    url: e.target.result
                });
            };
            reader.readAsDataURL(file)
        }
    };


    PhotoInput.prototype.upload = function () {
        var fd = new FormData();
        var self = this;
        var xhr = new XMLHttpRequest();
        this.croppie.result('blob').then(function (blob) {
            var reader = new FileReader();

            reader.onload = function (e) {

                fd.append('file', blob);
                fd.append('filename', self.filename.split('.').shift() + '.png');
                fd.append('type', self.type);
                fd.append('action', 'upload_file');
                xhr.open('POST', gic.ajaxurl, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var res = JSON.parse(xhr.responseText);
                        if (res.error || !res.success) {
                            throw new Error(res.error || 'Upload error');
                        }
                    }
                };
                xhr.send(fd);

            };

            reader.readAsArrayBuffer(blob);
        });
    };


    PhotoInput.prototype.remove = function (filename) {
        var fd = new FormData();
        var self = this;
        fd.append('filename', filename);
        fd.append('action', 'remove_file_from_session');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', gic.ajaxurl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var res = JSON.parse(xhr.responseText);
                if (res.error || !res.success) {
                    throw new Error(res.error || 'File not found');
                }
            }
        };
        xhr.send(fd);
    };

    return PhotoInput;
})();


module.exports = {
    FileInput: FileInput,
    MultipleFileInput: MultipleFileInput,
    PhotoInput: PhotoInput
};