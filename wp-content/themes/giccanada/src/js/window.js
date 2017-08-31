function Window() {
    var loadContentByWidth = function () {
        let windowWidth = $(window).width();
        $.ajax({
            url: gic.ajaxurl,
            method: "POST",
            data: {
                action: 'get_content',
                windowWidth: windowWidth
            },
            dataType: "json"
        }).done(function (data) {
            $.each(data, function (i, val) {
                alert("." + i);
                $("." + i).html(val);
            });
        });
    };

    Window.prototype.onLoad = function () {
        loadContentByWidth();
    };
}



module.exports = {
    Window: Window
};