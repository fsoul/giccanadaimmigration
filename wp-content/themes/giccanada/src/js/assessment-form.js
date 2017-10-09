'use strict';

(function () {
    function AssessmentForm() {
        this.form = $('#assessment-form');
        this.isInited = false;
        this.steps = [];

        var self = this;

        var initBtn = document.getElementById('ass-init-btn');
        initBtn.addEventListener('click', function(){
            self.init();
        });
    }

    AssessmentForm.prototype.init = function () {
        var self = this;
        if (!this.isInited) {
            this.form.steps({
                headerTag: "h5",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                onStepChanging: function (event, currentIndex, newIndex) {
                    self.loadFormByStepIndex(newIndex);
                    return true;
                },
                onInit: function(event, currentIndex) {
                    var stepInit = document.getElementById('ass-step-init');
                    stepInit.style.display = 'none';
                    self.steps = document.querySelectorAll('.assessment-step');
                    self.loadFormByStepIndex(currentIndex);
                    self.form.show();
                }
            });
        }
    };


    AssessmentForm.prototype.loadFormByStepIndex = function(index) {
        var stepClass = '-step' + ++index;
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
                }
            });
        }
    };

    new AssessmentForm();
})();
