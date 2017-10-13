'use strict';

var defaultOptions = {
  steps: 1,
  duration: 2000
};

/**
 * @param {Element|string} elem - DOM Element | selector
 * @param {Object} options
 * @throws {TypeError} Parameter 'elem' is required
 * @constructor
 */
function ProgressBar(elem, options) {
    options = options || defaultOptions;
    if (!elem) {
        throw new TypeError('Parameter \'elem\' is required');
    }

    this.steps = options.steps;
    this.oneStep = 1 / this.steps;
    this.currentPos = this.oneStep;
    this.duration = options.duration;
    this.container = typeof elem === 'string' || elem instanceof String ?
        document.querySelector(elem) : elem;

    var self = this;
    var style = this.container.style;
    style.width = this.getStepWidth() + 'px';

    this.setDuration(this.duration);

    window.addEventListener('resize', function() {
        style.width = self.getStepWidth() + 'px';
    });

}

/**
 * @param {number} duration Duration of an animation in ms
 */
ProgressBar.prototype.setDuration = function(duration) {
    var style = this.container.style;
    style.webkitTransition = 'width ' + duration / 1000 + 's';
    style.mozTransition = 'width ' + duration / 1000 + 's';
    style.oTransition = 'width ' + duration / 1000 + 's';
    style.transition = 'width ' + duration / 1000 + 's';
};

ProgressBar.prototype.getStepWidth = function (){
    return Math.round(this.container.parentElement.clientWidth * this.currentPos);
};

ProgressBar.prototype.nextStep = function (){
    this.currentPos += this.oneStep;
    var width = this.getStepWidth(),
        style =  this.container.style;
    style.width = width + 'px';
};

ProgressBar.prototype.prevStep = function () {
    this.currentPos -= this.oneStep;
    var width = this.getStepWidth(),
        style =  this.container.style;
    style.width = width + 'px';
};


module.exports = ProgressBar;