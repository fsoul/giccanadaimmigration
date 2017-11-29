module.exports =
    (function () {
        var throttle = function(type, name, obj) {
            obj = obj || window;
            var running = false;
            var func = function() {
                if (running) { return; }
                running = true;
                requestAnimationFrame(function() {
                    obj.dispatchEvent(new CustomEvent(name));
                    running = false;
                });
            };
            obj.addEventListener(type, func);
        };

        var fixedButton = document.getElementsByClassName("fixed-panel-button");

        function onFixedButtonHover() {
            var windowWidth = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth;
            var btnHoverText = this.parentElement.querySelector('.fixed-pnl-btn-hover');
            if (
                (
                    btnHoverText.style.display === 'none' ||
                    btnHoverText.style.display === ''
                ) &&
                windowWidth > 768
            )
                btnHoverText.style.display = 'inline-block';
            else
                btnHoverText.style.display = 'none';
        }

        throttle("click", "windowClick");
        throttle("resize", "windowResize");

        // handle event
        for (var i = 0; i < fixedButton.length; i++) {
            throttle("mouseover", "fixedButtonHover", fixedButton[i]);
            throttle("mouseout", "fixedButtonHover", fixedButton[i]);
            fixedButton[i].addEventListener('mouseover', onFixedButtonHover);
            fixedButton[i].addEventListener('mouseout', onFixedButtonHover);
        }
    })();
