// JavaScript Document

$(function() {

    /*$('#slider').nivoSlider({
        effect: 'sliceDown', // Specify sets like: 'fold,fade,sliceDown'
        pauseTime: 5000 // How long each slide will show
    });*/

    //Popup desactivado
    //$(window).load(function(){
//		$.colorbox({inline:true, href:"#promo_wallpaper", open:true});
//	});

    $('#languages').hover(function() {
        $('#languagelist').toggle();
    });

    // Settings
    var viewportTop   = 80,
        scrollTime      = 600,
        openTime      = 600,
        completeTime  = 1200,
        scrollElement = "html,body";
    // Initialize waypoints
    $("#wrapper > div").waypoint({ offset: viewportTop });
    // Detect iOS and Android*/
    if((!navigator.userAgent.match(/iPhone/i)) && (!navigator.userAgent.match(/iPod/i)) &&
        (!navigator.userAgent.match(/iPad/i)) && (!navigator.userAgent.match(/Android/i))) {
        // Sticky nav for desktop
        $("#bigmenu").stickyPanel();
        // Do stuff when waypoints are reached
        $("body").delegate("#wrapper > div", "waypoint.reached", function (event, direction) {
            var $active = $(this);
            if (direction === 'up') {
                $active = $active.prev();
            }
            if (!$active.length) { $active.end(); }
            $(".section-active").removeClass("section-active");
            $active.addClass("section-active");
            $(".selected").removeClass("selected");
            $("a[href=#"+$active.attr("id")+"]").addClass("selected");
        });
    }

// Smooth scrolling for internal links
    $("a[href^='#']").click(function (event) {
        event.preventDefault();
        var $this   = $(this),
            target  = this.hash,
            $target = $(target);
        $(scrollElement).stop().animate({
            "scrollTop": $target.offset().top
        }, scrollTime, "swing", function () {
            window.location.hash = target;
        });
    });

    $('#slider').nivoSlider({
        effect: 'fold', // Specify sets like: 'fold,fade,sliceDown'
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 500, // Slide transition speed
        pauseTime: 3000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: true, // Next & Prev navigation
        directionNavHide: true, // Only show on hover
        controlNav: true, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel: false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav: true, // Use left & right arrows
        pauseOnHover: true, // Stop animation while hovering
        manualAdvance: false, // Force manual transitions
        captionOpacity: 0.8, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });

    $('#bajar').waypoint(function(event, direction) {
        //$('#monster').show();
        if (direction === 'down') {
            $('#bruja').fadeIn(3000);
        }
        else {
            //$('#bruja').fadeOut(4000);
        }

    }, {
        offset: function() {
            return $.waypoints('viewportHeight') - $(this).outerHeight();
        }
    });

    $('.colorbox').colorbox({rel:'colorbox', transition:"none", width:"90%", height:"90%"});

});
