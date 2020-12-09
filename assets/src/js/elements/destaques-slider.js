( function( $ ) {

    $("[data-destaque-slider]").slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 1,
        pauseOnHover: true,
        pauseOnFocus: true,
        swipe: true,
        arrows: true
    });


} )( jQuery );