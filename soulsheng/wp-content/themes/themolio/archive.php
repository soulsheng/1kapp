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
<?php get_header(); ?>
<div class="container<?php echo $containerclass; ?>">
    <?php themolio_breadcrumbs(); ?>
    <?php if(have_posts()): ?>
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
        <?php endwhile; ?>
        <?php themolio_get_pagination(); ?>
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