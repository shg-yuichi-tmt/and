(function ($) {
    $('#menu_btn').on('click', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('#main').removeClass('open');
            $('#site-navigation').removeClass('open');
            $('.overlay').removeClass('open');
        } else {
            $(this).addClass('active');
            $('#main').addClass('open');
            $('#site-navigation').addClass('open');
            $('.overlay').addClass('open');
        }
    });
    $('.overlay').on('click', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('#menu_btn').removeClass('active');
            $('#main').removeClass('open');
            $('#site-navigation').removeClass('open');
        }
    });

    // メニューアコーディオン
    var submenu = $("#header-nav");
    submenu.each(function () {
        var noTargetSubmenu = $(this).siblings(submenu);
        $(this).find(".menu-item-has-children > a:first-of-type").click(function () {
            $(this).next(".sub-menu").slideToggle();
            $(this).toggleClass("open");
            noTargetSubmenu.find(".sub-menu").slideUp();
            noTargetSubmenu.find(".menu-item-has-children > a:first-of-type").removeClass("open");
            return false;
        });
    });
    var accordion = $("#header-nav");
}(jQuery));
