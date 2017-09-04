/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function toggleMenu() {
    document.getElementById("main-menu-content").classList.toggle("show-dropdown-content");
}

// Close the dropdown menu if the user clicks outside of it
function onWindowClick (event) {
    if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show-dropdown-content')) {
                openDropdown.classList.remove('show-dropdown-content');
            }
        }
    }
}

function onFixedButtonHover($button) {
    var $btnHoverText = $button.parent().find('.fixed-pnl-btn-hover'),
        windowWidth = $(window).width();
    if ($btnHoverText.css('display') === 'none' && windowWidth > 375)
        $btnHoverText.css('display', 'inline-block');
    else
        $btnHoverText.css('display', 'none');
}

function updateHeaderMenuPos() {
    var windowWidth = $(window).width(),
        $menuContainer = $('.menu-container'),
        $menuLogo = $('.menu-container').find('.menu-logo'),
        menuContainerCSS = {},
        scrollTop = 0;

    if (windowWidth > 375) {
        scrollTop = 150;
        menuContainerCSS = {
            'position': 'fixed',
            'top': '0',
            'margin-top': '0',
            'box-shadow': '0px 2px 4px rgba(0, 0, 58, 0.5)',
            'background': 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)'
        };
    } else {
        scrollTop = 125;
        menuContainerCSS = {
            'position': 'fixed',
            'top': '0',
            'margin-top': '0',
            'box-shadow': '0 2px 4px rgba(0, 0, 58, 0.5)',
            'background': 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)',
            'height': '48px'
        };
    }

    if ($(window).scrollTop() >= scrollTop) {

        if (windowWidth <= 375) {
            $menuLogo.css({
                'background': 'none',
                'height': '24px',
                'width': 'auto'
            });
            $menuLogo.text('GIC Canada');
        }
        $menuContainer.css(menuContainerCSS);
        $('.menu-phone-block').css('display', 'inline-block');
    } else {
        $menuContainer.removeAttr('style');
        $menuLogo.removeAttr('style');
        $menuLogo.text('');
        $('.menu-phone-block').css('display', 'none');
    }
}


module.exports = {
    toggleMenu: toggleMenu,
    onWindowClick: onWindowClick,
    onFixedButtonHover: onFixedButtonHover,
    updateHeaderMenuPos: updateHeaderMenuPos
};
