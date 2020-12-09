(function ($) {

    $('a.vizinhanca').on('shown.bs.tab', function (e) {
        streetView();
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    })

    function galeriaFoto() {
        $('.galeria-foto.slick-active').hover(function () {
            // $(this).css('width', '36%');
            $(this).addClass('current');
            //$(this).siblings().css('width', '16%');  
            $(this).siblings('.slick-active').addClass('notCurrent');
        }, function () {
            //$('.imgWrap').css('width', '20%');  
            $('.galeria-foto').siblings().removeClass('notCurrent');
            $('.galeria-foto').removeClass('current');
        });
    }

    function slickGaleria() {


        $("[data-destaque-galeria]").slick({
            infinite: false,
            autoplay: false,
            slidesToShow: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
            arrows: true,
            dots: true,
            lazyLoad: 'ondemand',
            prevArrow: $('.arrow-prev'),
            nextArrow: $('.arrow-next'),
            appendDots: $('.imovel-header__dots'),
        })

    }

    function btnTelefone() {
        $('.btn-telefone').click(function() {
            console.log('oi');
            $(this).parents('.info-telefone').find('.telefone').show();
        })
    }

    function btnNegociar() {

        $(document).on('nfFormReady', function () {
            $('.imovel-btn').on('click', function (e) {

                e.preventDefault();

                window.scroll({
                    top: $('#vamosnegociar').offset().top,
                    left: 0,
                    behavior: 'smooth'
                });

                $(window).on('scroll', function () {
                    if ($(window).scrollTop() == $('#vamosnegociar').offset().top) {
                        $('.input_nome').focus();
                    }
                });
                return false;

            })
        });

    }

    function Tabs() {
        $('.simulation-tabs li').click(function () {
            var index = $(this).index();
            //
            $(this).closest('.simulation-tabs').find('li').removeClass('current');
            $(this).closest('li').addClass('current');
            // 
            if (index === 0) {
                $('#nf-form-1-cont, #nf-form-5-cont').addClass('show');
                $('#nf-form-6-cont, #nf-form-7-cont').removeClass('show');
            }

            if (index === 1) {
                $('#nf-form-6-cont, #nf-form-7-cont').addClass('show');
                $('#nf-form-1-cont, #nf-form-5-cont').removeClass('show');
            }
        });
    }

    function nfFormReadys() {
        $(document).on('nfFormReady', function (e, layoutView) {
            // Mudando o formulário
            $('#nf-form-1-cont, #nf-form-5-cont').addClass('show');
            // Preenchando o campo hidden com o código do imóvel
            $('#nf-form-1-cont #nf-field-7, #nf-form-5-cont #nf-field-31').val($('#vamosnegociar').data('codigo'));
            $('#nf-form-6-cont #nf-field-38, #nf-form-7-cont #nf-field-47').val($('#vamosnegociar').data('codigo'));
            // Primeiro Form ( PT )
            if (layoutView.el === '#nf-form-1-cont') {
                // Enviando o primeiro formulário
                $('#nf-field-4').click(function () {
                    if (
                        $('#nf-form-1-cont .input_nome').val() != '' &&
                        $('#nf-form-1-cont .input_email').val() != '' &&
                        $('#nf-form-1-cont .input_telefone').val() != '' &&
                        $('#nf-form-1-cont .input_proposta').val() != ''
                    ) {
                        $.ajax({
                            type: 'POST',
                            url: 'http://leads.ingaia.com.br/leads/integration',
                            data: {
                                reference: $('#vamosnegociar').data('codigo'),
                                registerDate: new Date().toISOString(),
                                name: $('#nf-form-1-cont .input_nome').val(),
                                email: $('#nf-form-1-cont .input_email').val(),
                                phone: $('#nf-form-1-cont .input_telefone').val(),
                                message: 'Código do Imóvel: ' + $('#vamosnegociar').data('codigo') + ', Valor da Proposta: ' + $('#nf-form-1-cont .input_proposta').val()
                            },
                            headers: {
                                "Authorization": "Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="
                            },
                            error: function (xhr) {
                                console.log('Erro! Algo inesperado aconteceu.');
                            }
                        });
                    }
                });
            }
            // Segundo Form ( PT )
            if (layoutView.el === '#nf-form-6-cont') {
                // Enviando o segundo formulário
                $('#nf-field-35').click(function () {
                    if (
                        $('#nf-form-6-cont .input_nome').val() != '' &&
                        $('#nf-form-6-cont .input_email').val() != '' &&
                        $('#nf-form-6-cont .input_telefone').val() != '' &&
                        $('#nf-form-6-cont .input_financiamento').val() != '' &&
                        $('#nf-form-6-cont .input_renda').val() != ''
                    ) {
                        $.ajax({
                            type: 'POST',
                            url: 'http://leads.ingaia.com.br/leads/integration',
                            data: {
                                reference: $('#vamosnegociar').data('codigo'),
                                registerDate: new Date().toISOString(),
                                name: $('#nf-form-6-cont .input_nome').val(),
                                email: $('#nf-form-6-cont .input_email').val(),
                                phone: $('#nf-form-6-cont .input_telefone').val(),
                                message: 'Código do Imóvel: ' + $('#vamosnegociar').data('codigo') + ', Valor do Financiamento: ' + $('#nf-form-6-cont .input_financiamento').val() + ', Renda Mensal: ' + $('#nf-form-6-cont .input_renda').val()
                            },
                            headers: {
                                "Authorization": "Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="
                            },
                            error: function (xhr) {
                                console.log('Erro! Algo inesperado aconteceu.');
                            }
                        });
                    }
                });
            }
            // Primeiro Form ( EN )
            if (layoutView.el === '#nf-form-5-cont') {
                // Enviando o primeiro formulário
                $('#nf-field-28').click(function () {
                    if (
                        $('#nf-form-5-cont .input_nome').val() != '' &&
                        $('#nf-form-5-cont .input_email').val() != '' &&
                        $('#nf-form-5-cont .input_telefone').val() != '' &&
                        $('#nf-form-5-cont .input_proposta').val() != ''
                    ) {
                        $.ajax({
                            type: 'POST',
                            url: 'http://leads.ingaia.com.br/leads/integration',
                            data: {
                                reference: $('#vamosnegociar').data('codigo'),
                                registerDate: new Date().toISOString(),
                                name: $('#nf-form-5-cont .input_nome').val(),
                                email: $('#nf-form-5-cont .input_email').val(),
                                phone: $('#nf-form-5-cont .input_telefone').val(),
                                message: 'Código do Imóvel: ' + $('#vamosnegociar').data('codigo') + ', Valor da Proposta: ' + $('#nf-form-5-cont .input_proposta').val()
                            },
                            headers: {
                                "Authorization": "Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="
                            },
                            error: function (xhr) {
                                console.log('Erro! Algo inesperado aconteceu.');
                            }
                        });
                    }
                });
            }
            // Segundo Form ( EN )
            if (layoutView.el === '#nf-form-7-cont') {
                // Enviando o segundo formulário
                $('#nf-field-44').click(function () {
                    if (
                        $('#nf-form-7-cont .input_nome').val() != '' &&
                        $('#nf-form-7-cont .input_email').val() != '' &&
                        $('#nf-form-7-cont .input_telefone').val() != '' &&
                        $('#nf-form-7-cont .input_financiamento').val() != '' &&
                        $('#nf-form-7-cont .input_renda').val() != ''
                    ) {
                        $.ajax({
                            type: 'POST',
                            url: 'http://leads.ingaia.com.br/leads/integration',
                            data: {
                                reference: $('#vamosnegociar').data('codigo'),
                                registerDate: new Date().toISOString(),
                                name: $('#nf-form-7-cont .input_nome').val(),
                                email: $('#nf-form-7-cont .input_email').val(),
                                phone: $('#nf-form-7-cont .input_telefone').val(),
                                message: 'Código do Imóvel: ' + $('#vamosnegociar').data('codigo') + ', Valor do Financiamento: ' + $('#nf-form-7-cont .input_financiamento').val() + ', Renda Mensal: ' + $('#nf-form-7-cont .input_renda').val()
                            },
                            headers: {
                                "Authorization": "Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="
                            },
                            error: function (xhr) {
                                console.log('Erro! Algo inesperado aconteceu.');
                            }
                        });
                    }
                });
            }
        });
    }

    function init() {
        //galeriaFoto();
        slickGaleria();
        btnNegociar();
        Tabs();
        nfFormReadys();
        btnTelefone();
    }

    init();


})(jQuery);


// function initMap() {

//     var myLatLng = {lat: -25.363, lng: 131.044};

//     // Create a map object and specify the DOM element
//     // for display.
//     var map = new google.maps.Map(document.getElementById('mapa'), {
//         center: myLatLng,
//         zoom: 12
//     });

//     // Create a marker and set its position.
//     var marker = new google.maps.Marker({
//         map: map,
//         position: myLatLng,
//     });
// }