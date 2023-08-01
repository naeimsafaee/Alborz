let previous_scroll = 0;
$(window).scroll(function(){
    let scroll = $(window).scrollTop();

    $('.shollex').each(function() {
        let el = $(this)
        let initial_margin = el.data('initial-margin-top')
        let speed = el.data('speed') || (initial_margin / 12)
        let min_margin = el.data('minimum-margin') || 0

        if (isScrolledIntoView($(this))){
            let current_margin_str = el.css('margin-top').replace('px', '')
            let current_margin = Number(current_margin_str)

            if (scroll > previous_scroll) {

                if (current_margin > min_margin) {
                    if ((current_margin - speed) < min_margin) {
                        el.css('margin-top', min_margin + 'px')
                    }else {
                        el.css('margin-top', (current_margin - speed) + 'px')
                    }
                }
            }else {
                if (current_margin < initial_margin) {
                    if ((current_margin + speed) > initial_margin) {
                        el.css('margin-top', initial_margin + 'px')
                    }else {
                        el.css('margin-top', (current_margin + speed) + 'px')
                    }
                }

            }
        }
    });


    previous_scroll = scroll

});
function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
