<?php
/**
 * @package Themolio
 */
?>
<?php global $themolio_options, $themolio_is_mobile; ?>
<?php get_header(); ?>
<?php if($themolio_is_mobile) {
    $containerclass = ' fullcontainer';
} else {
    $containerclass = '';
} ?>
<div class="container<?php echo $containerclass; ?>">
    <?php if(have_posts()): ?>
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'single'); ?>
            <div class="single-navigation">
                <span class="nav-previous"><?php previous_post_link('%link', __('Previous', 'themolio')); ?></span>
                <span class="nav-next"><?php next_post_link('%link', __('Next', 'themolio')); ?></span>
            </div>
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
<?php if(!$themolio_is_mobile): ?>
<?php get_sidebar(); ?>
<?php endif; ?>
<?php get_footer(); ?>