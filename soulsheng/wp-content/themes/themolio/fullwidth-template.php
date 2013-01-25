<?php
/**
 * Template Name: Full-width, no sidebar
 * @package Themolio
 */
?>
<?php global $themolio_options; ?>
<?php get_header(); ?>
<div class="fullcontainer">
    <?php if(have_posts()): ?>
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'page'); ?>
            <?php comments_template('', true); ?>
        <?php endwhile; ?>
    <?php else: ?>
    <article id="post-0" class="post">
        <h2 class="entry-title missing-title"><?php _e('Missing!','themolio'); ?></h2>
        <div class="entry-content">
            <p><?php _e('No posts were found. Try using the search form below','themolio'); ?></p>
            <p><?php get_search_form(); ?></p>
        </div>
    </article>
    <?php endif; ?>
</div>
<?php get_footer(); ?>