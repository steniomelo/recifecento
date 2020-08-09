(function ($) {

    function init() {
        $precoMinimo = '';
        $precoMaximo = '';

        configFilters();
        smoothScroll();
        slickImovelCard();

        $('#header').find('.header-search').on('click', toggleSearch);
        $('#header').find('.hamburger').on('click', toogleHeaderNav);
    }

    function configFilters() {
        configFilterValue();
    }

    function configFilterValue() {
        function getValue(val) {
            var value = val.split(',');

            $precoMinimo = value[0];
            $precoMaximo = value[1];

            $('.filters-search .filter-valor .range-header .range-min span').html(parseInt(value[0]).toLocaleString('pt-BR'));
            $('.filters-search .filter-valor .range-header .range-max span').html(parseInt(value[1]).toLocaleString('pt-BR'));
            $('.filters-search .filter-valor .value').html('R$ ' + parseInt(value[1]).toLocaleString('pt-BR'));
        }

        getValue($('.filters-search .filter-valor').find('.range-value').val());

        $('.filters-search .filter-valor .range-value').jRange({
            from: 70000,
            to: 3000000,
            step: 500,
            format: 'R$ %s',
            showLabels: false,
            showScale: false,
            theme: 'theme-green',
            isRange: true,
            onstatechange: function (val) {
                getValue(val);
            }
        });

        $('.filters-search .filter-valor .btn-limpar').on('click', function () {
            $('.filters-search .filter-valor .range-value').jRange('setValue', '70000,3000000');
            delete $filtros.precoMinimo;
            delete $filtros.precoMaximo;
            submitFilters();
        });

        // Pega o código da construtora
        $('.header-search-construtoras ul li').on('click', function () {
            $('.header-search-construtoras ul li').removeClass('active');
            $(this).addClass('active');

            if ($(this).data('value')) {
                $('#construtora').val($(this).data('value'));
                //console.log($('#construtora').val());
            }
        })

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
