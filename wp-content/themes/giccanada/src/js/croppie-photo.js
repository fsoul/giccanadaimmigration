'use strict';

function CroppieAssPhoto() {
    this.options = {
        viewport: {width: 200, height: 250},
        boundary: {width: 266, height: 266}
    };
}

CroppieAssPhoto.prototype._init = function () {
    if (!this.croppie)
        this.croppie = new Croppie(document.getElementById('added-photo'), this.options);
};

CroppieAssPhoto.prototype.croppieLoadImage = function (imgUrl) {
    this._init();
    imgUrl = imgUrl || 'http://giccanadaimmigration.lo/wp-content/themes/giccanada/public/images/Review2-f94bca7e14.jpg';
    this.croppie.bind({
        url: imgUrl
    });
};

CroppieAssPhoto.prototype.saveCroppedBlob = function () {
    this.croppie.result('blob').then(function (blob) {

        var reader = new FileReader();

        reader.onloadend = function () {
            var base64 = reader.result;
            var link = document.createElement("a");

            link.setAttribute("href", base64);
            link.setAttribute("download", 'test');
            link.click();
        };

        reader.readAsDataURL(blob);

        // window.URL.createObjectURL(blob)
    });
};


module.exports =  CroppieAssPhoto;
