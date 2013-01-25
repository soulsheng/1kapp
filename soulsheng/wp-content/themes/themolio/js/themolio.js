/* Themolio JavaScript */
jQuery(document).ready(function() {
    jQuery('.entry-content *:last-child').addClass('last');
    jQuery('.comment-content *:last-child').addClass('last');
    jQuery('.pingback-content *:last-child').addClass('last');

    jQuery('.comments-write-link a').click(function() {
        jQuery('.commentlist').toggle();
    });
});