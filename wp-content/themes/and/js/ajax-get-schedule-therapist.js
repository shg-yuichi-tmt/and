jQuery(document).ready(function ($) {
    $('.date .item').click(function () {
        var date = $(this).data('date');
        loadPosts(date);
    });

    function loadPosts(date) {
        var data = {
            action: 'load_posts',
            date: date
        };
        var url = ajaxurl;

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            beforeSend: function () {
            },
            success: function (response) {
                $('.list').html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
});