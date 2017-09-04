module.exports = (function () {

    if (document.documentElement.sticky === undefined) {
        Object.defineProperty(Element.prototype, 'sticky', {
            get: function() {
                window.addEventListener('sticky', function () {
                    Scroll(this);
                });
            }
        });
    }


    function Scroll(target) {
        var windowHeight = window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight;
        var nodeHeight = target.offsetHeight;
        var scrollTop = document.scrollTop;

        // when top of window reaches the top of the panel detach
        if (scrollTop <= document.body.clientHeight - windowHeight && // Fix for rubberband scrolling in Safari on Lion
            scrollTop > target.offsetTop) {
            target.style.position = 'fixed';
            target.style.top = '0';
            target.style.marginTop = '0';
            target.style.boxShadow = '0 2px 4px rgba(0, 0, 58, 0.5)';
            target.style.background = 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)';
        }
    }
})();