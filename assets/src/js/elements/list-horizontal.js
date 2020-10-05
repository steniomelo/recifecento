(function ($) {
    //if ($(window).width() > 991) {

    $("[data-list-horizontal]").each(function (e) {

        if ($(this).find(".list-item").length > 2) {

            var index = e;

            $('img').on('dragstart', function (event) { event.preventDefault(); });

            $(this).mCustomScrollbar({
                axis: "x",
                //setWidth: 4500,
                autoHideScrollbar: true,
                theme: "ang",
                mouseWheel: {
                    enable: false,
                    preventDefault: true,
                },
                //snapAmount: 300
            });

            var mc = new Hammer(this);

            mc.get('pan').set({ direction: Hammer.DIRECTION_ALL, threshold: 10 });

            mc.on("panmove", function (ev) {
                $('[data-list-horizontal]:eq(' + index + ')').addClass('panmove');
            });
            mc.on("panend", function (ev) {
                $('[data-list-horizontal]:eq(' + index + ')').removeClass('panmove');
            });


            mc.on("panleft panright", function (ev) {

                if (ev.type == 'panleft') {
                    $('[data-list-horizontal]:eq(' + index + ')').mCustomScrollbar("scrollTo", '-=400', {
                        scrollInertia: 300
                    });
                } else if (ev.type == 'panright') {
                    $('[data-list-horizontal]:eq(' + index + ')').mCustomScrollbar("scrollTo", '+=400', {
                        scrollInertia: 300
                    });
                }
            });
        }
    });

    $("[data-list-horizontal-nobar]").each(function (e) {
        var index = e;

        $(this).mCustomScrollbar({
            axis: "x",
            theme: "ang",
            mouseWheel: {
                enable: false,
                preventDefault: true,
            },
            autoHideScrollbar: true,
            autoExpandScrollbar: false,
            alwaysShowScrollbar: 0,
        });

        var mc = new Hammer(this);

        mc.get('pan').set({ direction: Hammer.DIRECTION_ALL, threshold: 10 });

        mc.on("panmove", function (ev) {
            $('[data-list-horizontal-nobar]:eq(' + index + ')').addClass('panmove');
        });
        mc.on("panend", function (ev) {
            $('[data-list-horizontal-nobar]:eq(' + index + ')').removeClass('panmove');
        });


        mc.on("panleft panright", function (ev) {

            if (ev.type == 'panleft') {
                $('[data-list-horizontal-nobar]:eq(' + index + ')').mCustomScrollbar("scrollTo", '-=250', {
                    scrollInertia: 300
                });
            } else if (ev.type == 'panright') {
                $('[data-list-horizontal-nobar]:eq(' + index + ')').mCustomScrollbar("scrollTo", '+=250', {
                    scrollInertia: 300
                });
            }
        });

        $(this).parent().find('.arrow-next').on('click', function () {
            $('[data-list-horizontal-nobar]:eq(' + index + ')').mCustomScrollbar("scrollTo", '-=250', {
                scrollInertia: 300
            });
        })
        $(this).parent().find('.arrow-prev').on('click', function () {
            $('[data-list-horizontal-nobar]:eq(' + index + ')').mCustomScrollbar("scrollTo", '+=250', {
                scrollInertia: 300
            });
        })

    });
    //}

})(jQuery);