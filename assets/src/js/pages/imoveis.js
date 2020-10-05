
(function ($) {
    function init() {
        $filtros = {};
        $scroll = true;
        $page = 1;
        locations = [];
        imoveisHtml = [];
        $postVars = ajaxapi.post;
        $imoveisTotais = 0;

        postVars();
        configFilters();
        getImoveis();
        loadMoreBtn();
    }



    function postVars() {
        if ($postVars && $postVars.length > 0) {
            toogleFiltered(true);
        }
    }

    function configFilters() {
        $('.filters .filter').each(function () {
            $(this).find('> button').on('click', function () {
                if ($(this).parent().hasClass('opened')) {
                    $('.filters .filter').removeClass('opened');
                    $('.filters').css({ 'overflow-x': 'scroll' });

                } else {
                    $('.filters .filter').removeClass('opened');
                    $(this).parent().addClass('opened');
                    $('.filters').css('overflow', 'visible');
                }
            });

            $(this).find('.btn-aplicar').on('click', function () {
                if ($(this).parents('.filter').hasClass('valid')) {
                    $(this).parents('.filter').removeClass('opened').addClass('active');
                }
            });
            $(this).find('.btn-limpar').on('click', function () {
                $(this).parents('.filter').removeClass('active opened valid');
            });
        });

        configFilterSubcategoria();
        configFilterProduto();
        configFilterKeyword();
        resetFilters();
    }

    function configFilterSubcategoria() {
        function getValue(val) {
            var value = val;

            $subcategoria = value.data('value');

            $('.filter-subcategoria .btn').html(value.html());
        }

        $('.filter-subcategoria .dropdown-item').on('click', function () {
            getValue($(this));
            $filtros.subcategoria = $subcategoria;
            resetConfig();
            getImoveis();
        });
    }

    function configFilterProduto() {
        function getValue(val) {
            var value = val;

            $produto = value.data('value');

            $('.filter-produto .btn').html(value.html());
        }

        $('.filter-produto .dropdown-item').on('click', function () {
            getValue($(this));
            $filtros.produto = $produto;
            resetConfig();
            getImoveis();
        });
    }

    function configFilterKeyword() {
        $('.filter-keyword').bind('enterKey', function () {
            $filtros.keyword = $(this).val();
            resetConfig();
            getImoveis();
        });

        $('.filter-keyword').keyup(function (e) {
            if (e.keyCode == 13) {
                $(this).trigger("enterKey");
            }
        });
    }

    function resetConfig() {
        $page = 1;
        delete $filtros.paginado;
        delete $filtros.startpag;
        locations = [];
        imoveisHtml = [];
        $('.imoveis-list .imoveis .imoveis-row').html('');
    }

    function resetFilters() {
        $('[data-filtered]').on('click', function () {
            $filtros = {};
            if ($ordenacao) {
                $filtros.ordenacao = $ordenacao;
            } else {
                delete $filtros.ordenacao;
            }
            $('.filters .filter').removeClass("opened active valid");
            toogleFiltered(false);
            resetConfig();
            getImoveis();
        })
    }


    function toogleFiltered(bool) {
        if (bool) {
            $('[data-filtered]').addClass('active');
        } else {
            $('[data-filtered]').removeClass('active');
        }
    }
    function toogleTotalImoveis(bool) {
        if (bool) {
            $('[data-total]').addClass('active');
        } else {
            $('[data-total]').removeClass('active');
        }
    }
    function toogleError(bool, text) {
        if (bool) {
            $('[data-error]').addClass('active');
            $('[data-error]').html(text);
        } else {
            $('[data-error]').removeClass('active');
        }
    }

    function toogleLoader(bool) {
        if (bool) {
            $('[data-loader]').addClass('active');
        } else {
            $('[data-loader]').removeClass('active');
        }
    }

    function getImoveis(more) {
        $.ajax({
            url: ajaxapi.ajaxurl,
            type: 'post',
            data: {
                action: 'get_estabelecimentos',
                query_vars: ajaxapi.query_vars,
                get: ajaxapi.get,
                post: ajaxapi.post,
                query: ajaxapi.query,
                filters: $filtros,
                page: $page
            },
            beforeSend: function () {
                toogleError(false);
                if (!more) {
                    toogleTotalImoveis(false);
                }
                toogleLoader(true);
                toogleLoadMoreBtn(false);
            },
            success: function (response) {
                $imoveisTotais = response.total;
                $imoveisCarregadosTotais = response.imoveis.length;
                $i = 0;

                toogleTotalImoveis(true);

                toogleLoadMoreBtn(true);

                var responseHtml = response.html;
                var responseImoveis = response.imoveis;


                responseImoveis.forEach((item, i) => {
                    if (item.lat && item.lng) {
                        let location = {
                            'lat': item.lat,
                            'lng': item.lng
                        }
                        locations.push(location);
                        imoveisHtml.push(responseHtml[i])
                    }
                })

                initMap();
                toogleLoader(false);


                if ($imoveisTotais == 1) {
                    $('.listItemTotal [data-total]').html('Achamos <strong class="totalImoveis">' + $imoveisTotais + '</strong> imóvel com essas características');
                } else if ($imoveisTotais == 0 || $imoveisTotais > 1) {
                    $('.listItemTotal [data-total]').html('Achamos <strong class="totalImoveis">' + $imoveisTotais + '</strong> imóveis com essas características');
                }

                // Controlando o blank state da listagem de imóveis
                if ($imoveisTotais > 0) {
                    $('.imoveis-blank').removeClass('show');
                } else {
                    $('.imoveis-blank').addClass('show');
                }

                $('.imoveis-list .imoveis #loader, .imoveis-list .imoveis #error').remove();
                $('.imoveis-list .imoveis .imoveis-row').append(response.html);

                // if ($(window).width() > 991) {

                //     //response.imoveis.forEach(latLng);
                //     //latLng(response.imoveis[0]);

                //     $('.col-left .imoveis .imoveis-container').mCustomScrollbar({
                //         //setWidth: 4500,
                //         theme: "ang",
                //         autoHideScrollbar: true,
                //         mouseWheel: {
                //             enable: true,
                //             preventDefault: false,
                //         },
                //         scrollInertia: 100000,
                //         scrollbarPosition: 'outside',
                //         // callbacks: {
                //         //     onTotalScroll: function () {
                //         //         loadMore();
                //         //     }
                //         // }
                //     });
                // }

                // if (!more) {
                //     slickImovelCard();
                // } else {
                //     slickImovelCard(true);
                // }


                //
            }, error: function (response, status, error) {
                $('.imoveis-list .imoveis #loader').remove();
                toogleLoader(false);
                toogleError(true, response.responseText);
            }
        });
    }

    // function loadMore() {
    //     console.log($(document).height());
    //     if($page < $imoveisTotais && $('.imoveis .imoveis-row > div').length < $imoveisTotais ) {
    //         $(window).scroll(function() {
    //             if($(this).scrollTop() >= $(document).height()/2) {
    //                 console.log('chegou lá');
    //                 $(window).off('scroll');

    //                 $page = $page+6;
    //                 console.log($page);

    //                 $filtros = {
    //                     'paginado': true,
    //                     'startpag': $page
    //                 }

    //                 getImoveis();
    //             }
    //         });
    //     } else {
    //         $(window).off('scroll');
    //     }
    // }

    function loadMore() {
        if ($page < $imoveisTotais && $('.imoveis .imoveis-row > div').length < $imoveisTotais) {
            $page = $page + 1;

            // $filtros.paginado = true;
            // $filtros.startpag = $page;

            getImoveis(true);

        } else {
            toogleLoadMoreBtn(false);
        }
    }

    function initMap() {


        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: { lat: -8.06094, lng: -34.8801875 },
            mapTypeControl: false,
            streetViewControl: false,
            rotateControl: false,
        });

        var infoWin = new google.maps.InfoWindow();

        // Create an array of alphabetical characters used to label the markers.
        //var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.

        var markers = locations.map(function (location, i) {

            var count = i + 1;
            var el = i;

            var marker = new google.maps.Marker({
                position: location,
                icon: ajaxapi.assets + "/img/layout/m2.png",
                label: {
                    //text: count.toString(),
                    text: '1',
                    textSize: 13,
                    fontFamily: "ITC Avant Garde Gothic",
                    fontWeight: 'bold',
                    color: "white",
                }
            });
            google.maps.event.addListener(marker, 'click', function (evt) {
                infoWin.setContent(imoveisHtml[el]);
                infoWin.open(map, marker);
            })
            return marker;
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {
                //imagePath: ajaxapi.assets+'/img/layout/m'
                styles: [{

                    url: ajaxapi.assets + "/img/layout/m1.png",
                    width: 53,
                    height: 53,
                    fontFamily: "ITC Avant Garde Gothic",
                    textSize: 15,
                    textColor: "white",
                    //color: #00FF00,
                }]
            }
        );
    }

    function slickImovelCard(reinit) {
        if ($(window).width() > 991) {

            if (!reinit) {
                $("[data-imovelcard-slick]").slick({
                    infinite: false,
                    autoplay: false,
                    slidesToShow: 1,
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    arrows: true,
                    dots: true,
                    swipe: false,
                    //lazyLoad: 'ondemand',

                });
                $("[data-imovelcard-slick]").find(".slick-dots").on('click', function (e) {
                    e.preventDefault();
                });
                $("[data-imovelcard-slick]").find(".slick-arrow").on('click', function (e) {
                    e.preventDefault();
                });
            } else {
                $(".slick-slider").slick('unslick');
                slickImovelCard();
            }
        }

    }

    function loadMoreBtn() {
        $('[data-loadmorebtn]').on("click", function (e) {
            e.preventDefault();
            loadMore();
        })
    }

    function toogleLoadMoreBtn(bool) {
        if (bool) {
            $('[data-loadmorebtn]').removeClass('d-none').addClass('d-block');
        } else {
            $('[data-loadmorebtn]').removeClass('d-block').addClass('d-none');
        }

    }

    init();

})(jQuery);




