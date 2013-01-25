<?php
/**
 * @package Themolio
 */
?>
<div id="primary" class="widget-area" role="complementary">
    <?php if(!dynamic_sidebar('sidebar-1')): ?>
    <aside id="themolio-archives" class="widget widget_archives">
        <h3 class="widget-title"><?php _e('Archives','themolio'); ?></h3>
        <ul id="recentcomments">
            <?php wp_get_archives(); ?>
        </ul>
    </aside>
    <?php endif; ?>
</div>