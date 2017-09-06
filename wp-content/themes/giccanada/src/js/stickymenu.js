module.exports = (function () {


    var h = document.getElementById("menu-container");
    var menuLogo = h.querySelector('.menu-logo');
    var menuPhoneBlock = h.querySelector('.menu-phone-block');
    var stuck = false;
    var stickPoint = getDistance();

    function getDistance() {
        return h.offsetTop;
    }

    function updateHeaderMenuPos(e) {
        var windowWidth = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
        var offset = window.pageYOffset;
        var distance = getDistance() - offset;

        if ((distance <= 0) && !stuck) {
            h.style.position = 'fixed';
            h.style.top = '0px';
            h.style.marginTop = '0px';
            h.style.boxShadow = '0px 2px 4px rgba(0, 0, 58, 0.5)';
            h.style.background = 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)';
            stuck = true;


            if (windowWidth <= 768) {
                menuLogo.style.background = 'none';
                menuLogo.style.height = '24px';
                menuLogo.style.width = 'auto';
                menuLogo.innerText = 'GIC Canada';

                menuPhoneBlock.style.display = 'inline-block';
            }
        } else if (stuck && (offset <= stickPoint)) {
            h.removeAttribute('style');
            stuck = false;
            if (windowWidth <= 768) {
                menuLogo.removeAttribute('style');
                menuLogo.innerText = '';

                menuPhoneBlock.style.display = 'none';
            }
        }
    }
    document.addEventListener('scroll', updateHeaderMenuPos);

    //on document load
    updateHeaderMenuPos();
})();