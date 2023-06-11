jQuery("#loading-wrapper").css("display", "block");
setTimeout(function () {
    jQuery('#loading-wrapper').fadeOut(800);
    jQuery('#loading__content').fadeOut(200);
}, 2500);
