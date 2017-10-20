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
                startIndex: 4,
                onStepChanging: function (event, currentIndex, newIndex) {

                    if (newIndex > currentIndex && !self.stepValidation(currentIndex))
                        return false;

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

                    var assSteps = document.querySelectorAll('.assessment-step');
                    for (var i = 0; i < assSteps.length; ++i) {
                        self.steps.push({
                            step: assSteps[i],
                            isLoaded: false,
                            inputs: []
                        });
                    }

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
            var page = [].filter.call(this.steps, (function (s) {
                return s.step.classList.contains(stepClass);
            }))[0];
            var stepIndex = self.steps.indexOf(page);
            if (page && !page.isLoaded) {
                $.ajax({
                    url: gic.ajaxurl,
                    type: "POST",
                    data: {
                        'action': 'get_step_by_index',
                        'index': index
                    },
                    dataType: 'html',
                    success: function (html) {
                        page.step.innerHTML = html;
                        self.initInputsValidation(index - 1);
                        self.steps[stepIndex].isLoaded = true;
                    }
                });
            }
        };

        AssessmentForm.prototype._getPageInputs = function (pageIndex) {
            var page = this.steps[pageIndex].step;
            return page.querySelectorAll('input[type=text], input[type=tel], input[type=email], ' +
                'textarea, select');
        };

        AssessmentForm.prototype.initInputsValidation = function(pageIndex) {
            if (!this.steps[pageIndex].isLoaded) {
                var inputs = this._getPageInputs(pageIndex);
                for (var i = 0; i < inputs.length; ++i) {
                    this.steps[pageIndex].inputs.push( validation.initByInput(inputs[i]) );
                }
            }
        };

        AssessmentForm.prototype.stepValidation = function(pageIndex) {
            var page = this.steps[pageIndex];
            var result = true;
            for(var i = 0; i < page.inputs.length; ++i) {
                if (typeof page.inputs[i].doValidate === 'function' && !page.inputs[i].doValidate()) {
                    result = false;
                }
            }
            return result;
        };

        return AssessmentForm;
    })();

    var form = new AssessmentForm();
})();
