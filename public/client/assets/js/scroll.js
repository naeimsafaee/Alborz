$(document).ready(function() {
    $('.scroll').mousedown(function (event) {
        $(this)
            .data('down', true)
            .data('x', event.clientX)
            .data('scrollLeft', this.scrollLeft)
            .addClass("dragging");

        return false;
    }).mouseup(function (event) {
        $(this)
            .data('down', false)
            .removeClass("dragging");
    }).mousemove(function (event) {
        if ($(this).data('down') == true) {
            this.scrollLeft = $(this).data('scrollLeft') + $(this).data('x') - event.clientX;
        }
    }).mousewheel(function (event, delta) {
        this.scrollLeft -= (delta * 30);
    }).css({
        'overflow' : 'hidden',
        'cursor' : '-moz-grab'
    });
    $(window).mouseout(function (event) {
        if ($('.team-form-data').data('down')) {
            try {
                if (event.originalTarget.nodeName == 'BODY' || event.originalTarget.nodeName == 'HTML') {
                    $('.team-form-data').data('down', false);
                }
            } catch (e) {}
        }
    });
});
