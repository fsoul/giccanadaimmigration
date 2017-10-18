'use strict';

var validation = require('./input-validation');

(function () {
    var AssessmentProgressBar = (function () {
        var ProgressBar = require('./lib/progress-bar');

        function AssessmentProgressBar(elem, options) {
            var caption = document.querySelector('#assessment-modal .progress-container');
            caption.style.display = !caption.style.display ? 'block' : caption.style.display;
            ProgressBar.apply(this, arguments);
        }

        AssessmentProgressBar.prototype = Object.create(ProgressBar.prototype);
        AssessmentProgressBar.prototype.constructor = AssessmentProgressBar;

        AssessmentProgressBar.prototype.udpateCaption = function (newIndex, count) {
            var caption = document.querySelector('#assessment-modal .progress-container'),
                currentStep = caption.querySelector('.progress-current-step'),
                stepsCount = caption.querySelector('.progress-steps-count');
            currentStep.innerHTML = newIndex;
            stepsCount.innerHTML = count;
        };

        return AssessmentProgressBar;
    })();

    var AssessmentForm = (function () {
        function AssessmentForm() {
            this.form = $('#assessment-form');
            this.isInited = false;
            this.steps = [];
            var self = this;

            var initBtn = document.getElementById('ass-init-btn');
            initBtn.addEventListener('click', function () {
                if (!self.isInited)
                    self._init();
            });
        }

        AssessmentForm.prototype._init = function () {
            var self = this;
            this.form.steps({
                headerTag: "h5",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                // startIndex: 9,
                onStepChanging: function (event, currentIndex, newIndex) {
                    self._loadFormByStepIndex(newIndex + 1);
                    return true;
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    self.progressBar.udpateCaption(currentIndex + 1, self.steps.length);

                    if (currentIndex > priorIndex) {
                        self.progressBar.nextStep();
                    } else {
                        self.progressBar.prevStep();
                    }
                },
                onInit: function (event, currentIndex) {
                    var stepInit = document.getElementById('ass-step-init');
                    stepInit.style.display = 'none';
                    self.steps = document.querySelectorAll('.assessment-step');
                    self._loadFormByStepIndex(currentIndex + 1);
                    self.form.show();
                    self.progressBar = new AssessmentProgressBar('.progressbar div', {
                        steps: self.steps.length,
                        duration: 2000
                    });
                    self.progressBar.udpateCaption(currentIndex + 1, self.steps.length);
                }
            });
        };


        AssessmentForm.prototype._loadFormByStepIndex = function (index) {
            var self = this;
            var stepClass = '-step' + index;
            var step = [].filter.call(this.steps, (function (s) {
                return s.classList.contains(stepClass);
            }))[0];
            if (step && !step.innerHTML) {
                $.ajax({
                    url: gic.ajaxurl,
                    type: "POST",
                    data: {
                        'action': 'get_step_by_index',
                        'index': index
                    },
                    dataType: 'html',
                    success: function (html) {
                        step.innerHTML = html;
                        self.initInputsValidation(index - 1);
                    }
                });
            }
        };

        AssessmentForm.prototype._getPageInputs = function (pageIndex) {
            var page = this.steps[pageIndex];
            return page.querySelectorAll('input, select');
        };

        AssessmentForm.prototype.initInputsValidation = function(pageIndex) {
            var inputs = this._getPageInputs(pageIndex);
            for (var i = 0; i < inputs.length; ++i) {
                validation.initByInput(inputs[i]);
            }
        };

        return AssessmentForm;
    })();

    var form = new AssessmentForm();
})();
