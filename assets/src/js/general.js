(function ($) {

    function init() {
        $precoMinimo = '';
        $precoMaximo = '';

        smoothScroll();
        slickImovelCard();
        //slickDestaques();

        $('#header').find('.header-search').on('click', toggleSearch);
        $('#header').find('.hamburger').on('click', toogleHeaderNav);
    }

    function toggleSearch(action) {
        if ($('body').hasClass('search-opened') || action == 'close') {
            $('body').removeClass('search-opened');
            $('.header-search, #header-search').removeClass('active');
            $('html').css('overflow', 'scroll');
        } else {
            toogleHeaderNav('close');
            $('body').addClass('search-opened');
            $('.header-search, #header-search').addClass('active');
            $('html').css('overflow', 'hidden');
        }
    }

    function toogleHeaderNav(action) {
        if ($('body').hasClass('header-nav-opened') || action == 'close') {
            $('body').removeClass('header-nav-opened');
            $('.header-logo, .header-hamburger, #header-nav').removeClass('active');
            $('html').css('overflow', 'scroll');
        } else {
            toggleSearch('close');
            $('body').addClass('header-nav-opened');
            $('.header-logo, .header-hamburger, #header-nav').addClass('active');
            $('html').css('overflow', 'hidden');
        }
    }

    function slickDestaques() {
        $("#destaques").slick({
            infinite: true,
            autoplay: true,
            slidesToShow: 1,
            pauseOnHover: true,
            pauseOnFocus: true,
            arrows: true,
            dots: true,
            swipe: true,
        });
    }

    function slickImovelCard() {
        if ($(window).width() > 991) {

            $("[data-imovelcard-slick]").slick({
                infinite: false,
                autoplay: false,
                slidesToShow: 1,
                pauseOnHover: false,
                pauseOnFocus: false,
                arrows: true,
                dots: true,
                swipe: false,
            });

            $("[data-imovelcard-slick]").find(".slick-dots").on('click', function (e) {
                e.preventDefault();
            });
            $("[data-imovelcard-slick]").find(".slick-arrow").on('click', function (e) {
                e.preventDefault();
            });
            // $("[data-imovelcard-slick]").parent().find(".arrow-next").on('click', function(e) {
            //     console.log('oi');
            //     e.preventDefault();
            // });
        }
    }

    function smoothScroll() {
        $('.smoothScroll').on('click', function (e) {
            e.preventDefault();
            // window.scroll({
            //     top: $($(this).attr('href')).offset().top, 
            //     left: 0, 
            //     behavior: 'smooth' 
            // });
            //console.log($(this).children('a').attr('href'));
            window.scroll({
                top: $($(this).children('a').attr('href')).offset().top,
                left: 0,
                behavior: 'smooth'
            });
            toogleHeaderNav('close');
            return false;
        })
    }

    init();



})(jQuery);
