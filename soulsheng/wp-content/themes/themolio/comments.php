<?php
/**
 * @package Themolio
 */
?>
<?php global $themolio_is_mobile; ?>
<div id="comments">
    <?php if(post_password_required()): ?>
        <p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'themolio'); ?></p>
    </div>
    <?php return; endif; ?>

    <?php if(have_comments()): ?>
        <table class="comment-title-container tablayout"><tr>
        <td style="width:50%; text-align:left;">
            <h2 class="comments-title">
                <?php printf(_n('One comment', '%1$s comments', get_comments_number(), 'themolio'), number_format_i18n(get_comments_number())); ?>
            </h2>
        </td>
        <?php if(comments_open() and !$themolio_is_mobile): ?>
        <td style="width:50%; text-align:right;">
            <h4 class="comments-write-link"><a href="javascript:void(0)"><?php _e('Toggle Comments','themolio'); ?></a></h4>
        </td>
        <?php endif; ?>
        </tr></table>

        <?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
        <div class="comment-navigation single-navigation">
            <span class="nav-previous"><?php previous_comments_link(__('Older Comments', 'themolio')); ?></span>
            <span class="nav-next"><?php next_comments_link(__('Newer Comments', 'themolio')); ?></span>
        </div>
        <?php endif; ?>

        <ul class="commentlist">
            <?php wp_list_comments(array('callback' => 'themolio_comment')); ?>
        </ul>
    <?php elseif(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="nocomments"><?php _e('Comments are closed.', 'themolio'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>