<?php
/**
 * @package Themolio
 */
?>
<?php global $themolio_options; ?>
<?php get_header(); ?>
<div class="fullcontainer">
    <article id="post-0" class="post">
        <h2 class="entry-title missing-title"><?php _e('Error! Page not found','themolio'); ?></h2>
        <div class="entry-content">
            <p><?php _e('No posts were found. Try using the search form below','themolio'); ?></p>
            <p><?php get_search_form(); ?></p>
        </div>
    </article>
</div>
<?php get_footer(); ?>