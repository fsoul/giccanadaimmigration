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

module.exports = {
    toggleMenu: toggleMenu,
    onWindowClick: onWindowClick,
    onFixedButtonHover: onFixedButtonHover
};
