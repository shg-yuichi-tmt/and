(function ($) {
    $(function () {
        $(window).scroll(function () {
            const windowHeight = $(window).height();
            const scroll = $(window).scrollTop();

            $('.fadein').each(function () {
                const targetPosition = $(this).offset().top;
                if (scroll > targetPosition - windowHeight + 200) {
                    $(this).addClass("is-fadein");
                }
            });
        });
    });
}(jQuery));