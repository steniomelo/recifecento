( function( $ ) {

    $("[data-destaque-slider]").slick({
        infinite: true,
        fade: true,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 1,
        pauseOnHover: false,
        pauseOnFocus: false,
        swipe: false,
        arrows: false
    });

    $("[data-destaque-slider]").on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        $("[data-destaque-slider-nav]").find('.list-item').removeClass('active desactive');
        $("[data-destaque-slider-nav]").find('.list-item:eq('+currentSlide+')').addClass('desactive');
        $("[data-destaque-slider-nav]").find('.list-item:eq('+nextSlide+')').addClass('active');
    });

    $("[data-destaque-slider-nav]").find(".list-item").click(function() {
        var index = $('.list-item').index(this);
        if(index < 5) {
            $("[data-destaque-slider]").slick('slickGoTo', index);
        }
    })



} )( jQuery );