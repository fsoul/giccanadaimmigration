module.exports =
    (function () {
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
                windowWidth > 375
            )
                btnHoverText.style.display = 'inline-block';
            else
                btnHoverText.style.display = 'none';
        }


        // Close the dropdown menu if the user clicks outside of it
        function onWindowClick(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show-dropdown-content')) {
                        openDropdown.classList.remove('show-dropdown-content');
                    }
                }
            }
        }

        function toggleMenu() {
            document.getElementById("main-menu-content").classList.add('show-dropdown-content');
        }

        function assignReadyEvents() {
            document.querySelector('button.dropbtn').addEventListener('click', toggleMenu);

            var fixedButton = document.getElementsByClassName("fixed-panel-button");
            for (var i = 0; i < fixedButton.length; i++) {
                fixedButton[i].addEventListener('mouseover', onFixedButtonHover);
                fixedButton[i].addEventListener('mouseout', onFixedButtonHover);
            }

            document.addEventListener('click', onWindowClick);
        }

        //on document load
        assignReadyEvents();
    })();
