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


    var AssessmentCopyButton = (function () {

        function AssessmentCopyButton(el) {
            this.button = el;
            var self = this;
            this.button.addEventListener('click', function (e) {
                e.preventDefault();
                self.copy();
            })
        }

        AssessmentCopyButton.prototype.onCopyInputs = function (newNode) {
            var page = document.querySelector('fieldset.' + this.button.getAttribute('data-parent'));
            var insertedInputs = newNode.querySelectorAll('input[type=text], input[type=tel], ' +
                'input[type=email], input[type=file], input[type=password], textarea, select, ' +
                'div[data-role=combine-date], div[data-role=period-date]');
            page.dispatchEvent(new CustomEvent('onCopyInputs', {
                detail: {
                    inputs: insertedInputs
                }
            }));
            newNode.scrollIntoView(true);
        };

        AssessmentCopyButton.prototype.initDel = function (newNode) {
            var del = newNode.querySelector('.added-file-delete');
            del.addEventListener('click', function (e) {
                e.preventDefault();
                var div = document.querySelector(this.getAttribute('data-parent'));
                div.removeChild(newNode);
            })
        };

        AssessmentCopyButton.prototype.copy = function () {
            var fd = new FormData();
            var div = document.getElementById(this.button.getAttribute('data-template'));
            var copyCount = div.querySelectorAll('.copied').length;
            var self = this;
            fd.append('action', 'get_additional_template');
            fd.append('template', this.button.getAttribute('data-template'));
            fd.append('index', copyCount + 1);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', gic.ajaxurl, true);


            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var res = xhr.responseText;
                    var copy = document.createElement('div');
                    copy.classList.add('copied');
                    copy.classList.add('-copy' + (copyCount + 1));
                    copy.innerHTML = res;
                    div.insertBefore(copy, null);
                    self.onCopyInputs(copy);
                    self.initDel(copy);
                }
            };

            xhr.send(fd);
        };

        return AssessmentCopyButton;
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
            var photoStep = 2;
            this.form.steps({
                headerTag: "h5",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                startIndex: 16,
                onStepChanging: function (event, currentIndex, newIndex) {

                    if (newIndex > currentIndex && !self.stepValidation(currentIndex))
                        return false;

                    if (currentIndex === photoStep) {
                        var input = self.steps[photoStep].inputs.filter(function (t) {
                            return t.id === 'ass-photo';
                        })[0];
                        input.dispatchEvent(new CustomEvent('upload'));
                    }

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
                            inputs: [],
                            copyButtons: []
                        });
                    }

                    self._loadFormByStepIndex(currentIndex + 1);
                    self.form.show();
                    self.progressBar = new AssessmentProgressBar('.progressbar div', {
                        steps: self.steps.length,
                        duration: 2000
                    });
                    self.progressBar.udpateCaption(currentIndex + 1, self.steps.length);
                },
                onFinishing: function (event, currentIndex) {
                    var paymentType = document.getElementById('ass-payment-type-hidden');
                    switch (paymentType.value) {
                        case 'tc':
                            self.payByCard();
                            break;
                    }
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
                        self.initInputsValidation(index - 1, self._getPageInputs(stepIndex));
                        var copies = page.step.querySelectorAll('.ass-add-button');
                        for (var i = 0; i < copies.length; ++i) {
                            if (self.steps[stepIndex].copyButtons.indexOf(copies[i]) === -1) {
                                self.steps[stepIndex].copyButtons.push(new AssessmentCopyButton(copies[i]));
                            }
                        }
                        self.steps[stepIndex].step.addEventListener('onCopyInputs', function (e) {
                            self.doCopyInputs(e, stepIndex);
                        });
                        self.steps[stepIndex].isLoaded = true;
                    }
                });
            }
        };


        AssessmentForm.prototype.doCopyInputs = function (e, stepIndex) {
            var inputs = e.detail.inputs;
            this.initInputsValidation(stepIndex, inputs);
        };

        AssessmentForm.prototype._getPageInputs = function (pageIndex) {
            var page = this.steps[pageIndex].step;
            return page.querySelectorAll('input[type=text], input[type=tel], input[type=email], ' +
                'input[type=password], input[type=file], textarea, select, div[data-role=combine-date], ' +
                'div[data-role=period-date]');
        };

        AssessmentForm.prototype.initInputsValidation = function (pageIndex, inputs) {
            for (var i = 0; i < inputs.length; ++i) {
                if (!this.steps[pageIndex].inputs.some(function (t) {
                        return t.id === inputs[i].id;
                    })) {
                    this.steps[pageIndex].inputs.push(validation.initByInput(inputs[i]))
                }
            }
        };

        AssessmentForm.prototype.stepValidation = function (pageIndex) {
            var page = this.steps[pageIndex];
            var result = true;
            for (var i = 0; i < page.inputs.length; ++i) {
                if ((typeof page.inputs[i].input === 'function' && !page.inputs[i].input()) ||
                    (typeof page.inputs[i].div === 'function' && !page.inputs[i].div())) {
                    page.inputs.splice(i, 1);
                } else if (typeof page.inputs[i].doValidate === 'function' && !page.inputs[i].doValidate()) {
                    result = false;
                }
            }

            return result;
        };

        AssessmentForm.prototype.payByCard = function () {
            this.sendForm();
        };


        AssessmentForm.prototype.sendForm = function () {
            var fd = new FormData(document.getElementById('assessment-form'));
            fd.append('action', 'send_assessment_form');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', gic.ajaxurl, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var res = JSON.parse(xhr.responseText);
                    debugger;
                }
            };
            xhr.send(fd);
        };

        return AssessmentForm;
    })();

    var form = new AssessmentForm();
})();