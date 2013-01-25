<?php
/**
 * @package Themolio
 */
?>
<?php global $themolio_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <?php if($themolio_options['show_page_meta']): ?>
    <div class="entry-meta">
        <?php themolio_posted_on(); ?>
        <p>
            <?php if(comments_open() && ! post_password_required()) : ?>
            <?php comments_popup_link(__('Reply', 'themolio'), _x('1 Comment', 'comments number', 'themolio'), _x('% Comments', 'comments number', 'themolio'), 'entry-comments'); ?>
            <?php endif; ?>
        </p>
    </div>
    <?php endif; ?>
    <div class="entry-content">
        <?php the_content(__('Continue reading', 'themolio')); ?>
        <?php wp_link_pages(array('before' => '<div class="page-link clearfix"><span class="pages-title">'.__('Pages:','themolio').'</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
    </div>
</article>