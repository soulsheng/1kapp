<?php
/**
 * @package Themolio
 */
?>
<?php global $themolio_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'themolio'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    <div class="entry-meta">
        <?php themolio_posted_on(); ?>
        <p>
            <?php if(comments_open() && ! post_password_required()) : ?>
            <?php comments_popup_link(__('Reply', 'themolio'), _x('1 Comment', 'comments number', 'themolio'), _x('% Comments', 'comments number', 'themolio'), 'entry-comments'); ?>
            <?php endif; ?>
        </p>
    </div>
    <?php if(trim(get_the_post_thumbnail($post->ID)) != '' and $themolio_options['show_featured']): ?>
    <div class="entry-thumb">
        <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('themolio-featured-image');?>
        </a>
    </div>
    <?php endif; ?>
    <div class="entry-content">
        <?php if($themolio_options['show_excerpt'] or is_search()): ?>
            <?php the_excerpt(); ?>
        <?php else: ?>
            <?php the_content(__('Continue reading', 'themolio')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-link clearfix"><span class="pages-title">'.__('Pages:','themolio').'</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
        <?php endif; ?>
    </div>
</article>