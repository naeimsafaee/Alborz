var clicked_id;
var audio_var = new Audio();


$('.client-item .ppbutton').on("click",function(){
    var datasrc = $(this).attr('data-src');
    clicked_id= $(this).attr('id');
    console.log(clicked_id);
    audio_var.pause();

    $('.ppbutton').not(this).each(function(){
        $(this).removeClass('fa-pause');
        $(this).addClass('fa-play');
    });
    if($(this).hasClass('fa-play')){
        console.log('play_click');
        audio_var.src=datasrc;
        $(this).removeClass('fa-play');
        $(this).addClass('fa-pause');
        console.log(audio_var);
        audio_var.play();
    } else {
        console.log('pause_click');
        $(this).removeClass('fa-pause');
        $(this).addClass('fa-play');
        console.log(audio_var);
        audio_var.pause();
        //audio_var.src='';
        //audio_var.load();
        console.log(audio_var);
    }
});

audio_var.onended = function() {
    $("#"+clicked_id).removeClass('fa-pause');
    $("#"+clicked_id).addClass('fa-play');
};

$(function() {
    // Owl Carousel
    var owl = $("#owl-carousel1");
    owl.owlCarousel({
        items: 1,
        loop: true,
        nav:false,
        dots: true,
        autoplay:true,
        autoplayTimeout:10000,
        autoplayHoverPause:true,
        smartSpeed: 3000,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
    });
    owl.on('changed.owl.carousel', function(e) {
        owl.trigger('stop.owl.autoplay');
        owl.trigger('play.owl.autoplay');
    });


});
$(document).ready(function(){
    var owl = $('#owl-carousel2');
    owl.owlCarousel({
        loop:false,
        autoHeight:true,
        margin:10,
        nav:false,
        items: 1,
        dots: false,
        animateOut: "zoomOut",
        animateIn: "zoomIn",
        rewind: true,
        autoplay:false,
    });

    // Custom Button
    $('.customNextBtn').click(function() {
        owl.trigger('next.owl.carousel');
    });
    $('.customPreviousBtn').click(function() {
        owl.trigger('prev.owl.carousel');
    });
    if($(window).width() > 767){
        $('.client-item').click(function () {
            let index = Number(this.id.replace('client_item_', ''))
            $('#owl-carousel2').trigger('to.owl.carousel', index - 1);
        })
    }
    $('#owl-carousel2').on('translate.owl.carousel', function (event) {
        let index = event.item.index

        let items = $('.client-item')
        if (index >= items.length) {
            return
        }
        if($(window).width() > 767){
            for (i = 0; i < items.length; i++) {
                items[i].classList.remove("active");
            }
            {
                $('#client_item_' + (event.item.index + 1)).addClass('active')

            }
        }
    })
    let g = document.getElementsByClassName('client-item')[0];
    for (let i = 0, len = g.children.length; i < len; i++)
    {
        (function(index){
            g.children[i].onclick = function(){
                $('#owl-carousel2').trigger('to.owl.carousel', index)
            }
        })(i);
    }


});


