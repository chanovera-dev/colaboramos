jQuery(document).ready(function($) {
    $('.category-list_item').on('click', function() {
        $('.category-list_item').removeClass('active');
        $(".section .posts").addClass("loading"),
        $(this).addClass('active');

        jQuery.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'html',
            data: {
                action: 'filter_projects',
                category: jQuery(this).data('slug'),
            },
            success: function(res) {
                jQuery(".section .posts").removeClass("loading"),
                jQuery('.posts').html(res);
            }
        });
    });
});