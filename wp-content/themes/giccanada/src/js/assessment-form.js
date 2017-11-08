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
                self.copyContainer(e);
            })
        }


        /**
         * @param {string} id Button's attribute `data-block`
         * @return {Node} Returns div.multiplication-container
         */
        AssessmentCopyButton.prototype.findMContainer = function (id) {
            var b = document.getElementById(id);
            var res;
            if (b) {
                for (var i = 0; i < b.childNodes.length; ++i) {
                    var child = b.childNodes[i];
                    if (child.nodeType === Node.ELEMENT_NODE &&
                        child.classList.contains('multiplication-container')) {
                        res = child;
                        break;
                    }
                }
            }
            return res;
        };

        /**
         * @param {string} id
         * @param {number} newId
         * @return {string} If matches then will return incremented 'id'
         * @throws {TypeError}
         */
        AssessmentCopyButton.prototype.getNewId = function (id, newId) {
            var changed = id.replace(/(-\d+)$/, function () {
                return '-' + newId;
            });
            if (id === changed) {
                throw new TypeError('Wrong item id');
            }
            return changed;
        };

        /**
         * @param {Node} node
         * @return {Node} Returns new node
         */
        AssessmentCopyButton.prototype.copyNode = function (node) {
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
                        item.id = this.getNewId(item.id, copyCount + 1);
                        item.setAttribute('name', this.getNewId(item.getAttribute('name'), copyCount + 1));
                        item.value = '';
                        item.classList.remove('invalid-input');
                        if (item.hasAttribute('data-class'))
                            item.setAttribute('data-class',
                                this.getNewId(item.getAttribute('data-class'), copyCount + 1));
                        break;
                    case 'div':
                    case 'section':
                        item.id = this.getNewId(item.id, copyCount + 1);
                        break;
                    case 'span':
                        item.id = this.getNewId(item.id, copyCount + 1);
                        item.innerText = '';
                        break;
                    case 'label':
                        item.htmlFor = this.getNewId(item.getAttribute('for'), copyCount + 1);
                        break;
                    default:
                        throw new TypeError('Item must be instance of input/select/label/div/section/span');
                }
            }

            return newNode;
        };

        /**
         * Function copies div.multiplication-container on click event
         * @see <div class="multiplication-container">
         * @param {MouseEvent} event
         */
        AssessmentCopyButton.prototype.copyContainer = function (event) {
            if (event) {
                event.preventDefault();
                var copyBtn = this.button,
                    mContainer = this.findMContainer(copyBtn.getAttribute('data-block'));

                var newNode = this.copyNode(mContainer);
                mContainer.parentNode.insertBefore(newNode, copyBtn.parentNode);
                var page = document.querySelector('fieldset.' + mContainer.getAttribute('data-parent'));
                var insertedInputs = newNode.querySelectorAll('input[type=text], input[type=tel], ' +
                    'input[type=email], input[type=file], input[type=password], textarea, select');
                page.dispatchEvent(new CustomEvent('onCopyInputs', {
                    detail: {
                        inputs: insertedInputs
                    }
                }));
                newNode.scrollIntoView(true);
            }
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
            this.form.steps({
                headerTag: "h5",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                startIndex: 14,
                onStepChanging: function (event, currentIndex, newIndex) {

                    if (newIndex > currentIndex && !self.stepValidation(currentIndex))
                        return false;

                    if (currentIndex === 2) {
                        var input = self.steps[2].inputs.filter(function (t) {
                            return t.id = 'ass-photo';
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
                                self.steps[stepIndex].step.addEventListener('onCopyInputs', function (e) {
                                    self.doCopyInputs(e, stepIndex);
                                });
                            }
                        }
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
                'input[type=password], input[type=file], textarea, select');
        };

        AssessmentForm.prototype.initInputsValidation = function (pageIndex, inputs) {
            for (var i = 0; i < inputs.length; ++i) {
                if (this.steps[pageIndex].inputs.indexOf(inputs[i]) === -1)
                    this.steps[pageIndex].inputs.push(validation.initByInput(inputs[i]));
            }
        };

        AssessmentForm.prototype.stepValidation = function (pageIndex) {
            var page = this.steps[pageIndex];
            var result = true;
            for (var i = 0; i < page.inputs.length; ++i) {
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
