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
    <?php themolio_breadcrumbs(); ?>
    <?php if(have_posts()): ?>
        <?php while(have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="entry-title"><?php the_title(); ?></h2>
                <div class="entry-meta">
                    <?php themolio_posted_on(); ?>
                    <p>
                        <?php if(comments_open() && ! post_password_required()) : ?>
                        <?php comments_popup_link(__('Reply', 'themolio'), _x('1 Comment', 'comments number', 'themolio'), _x('% Comments', 'comments number', 'themolio'), 'entry-comments'); ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="entry-content">
                    <div class="entry-attachment">
                        <?php
                            $attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));
                            foreach($attachments as $k => $attachment) {
                                if($attachment->ID == $post->ID) break;
                            }
                            $k++;
                            if(count($attachments) > 1) {
                                if(isset($attachments[$k ]))
                                    $next_attachment_url = get_attachment_link($attachments[$k]->ID);
                                else
                                    $next_attachment_url = get_attachment_link($attachments[0]->ID);
                            } else {
                                $next_attachment_url = wp_get_attachment_url();
                            }
                        ?>
                        <a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php $attachment_size = apply_filters('themolio_attachment_size', 740); echo wp_get_attachment_image($post->ID, array($attachment_size, 1024)); ?></a>
                        <?php if(!empty($post->post_excerpt)) : ?>
                        <div class="entry-caption">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php endif; ?>
                        <div class="entry-description">
                            <?php the_content(); ?>
                            <?php wp_link_pages(array('before' => '<div class="page-link clearfix"><span class="pages-title">'.__('Pages:','themolio').'</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
                        </div>
                    </div>
                </div>
            </article>
            <div class="single-navigation">
                <span class="nav-previous"><?php previous_image_link(false, __('Previous' ,'themolio')); ?></span>
                <span class="nav-next"><?php next_image_link(false, __('Next' ,'themolio')); ?></span>
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