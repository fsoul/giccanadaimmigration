/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function toggleMenu() {
    document.getElementById("main-menu-content").classList.toggle("show-dropdown-content");
}

// Close the dropdown menu if the user clicks outside of it
function onWindowClick (event) {
    if (!event.target.matches('.dropbtn')) {

        let dropdowns = document.getElementsByClassName("dropdown-content");
        let i;
        for (i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show-dropdown-content')) {
                openDropdown.classList.remove('show-dropdown-content');
            }
        }
    }
}

function onFixedButtonHover($button) {
    let $btnHoverText = $button.parent().find('.fixed-pnl-btn-hover');
    if ($btnHoverText.css('display') === 'none')
        $btnHoverText.css('display', 'inline-block');
    else
        $btnHoverText.css('display', 'none');
}

function updateHeaderMenuPos() {
    if ($(window).scrollTop() >= 150) {
        $('.menu-container').css({
            'position': 'fixed',
            'top': '0',
            'margin-top': '0',
            'box-shadow': '0px 2px 4px rgba(0, 0, 58, 0.5)',
            'background': 'linear-gradient(50deg, #852EF6 15.55%, #00FFD4 130.9%)'
        });
        $('.menu-phone-block').css('display', 'inline-block');
    } else {
        $('.menu-container').removeAttr('style');
        $('.menu-phone-block').css('display', 'none');
    }
}


module.exports = {
    toggleMenu: toggleMenu,
    onWindowClick: onWindowClick,
    onFixedButtonHover: onFixedButtonHover,
    updateHeaderMenuPos: updateHeaderMenuPos
};
