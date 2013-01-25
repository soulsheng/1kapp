<?php
/**
 * @package Themolio
 */
?>
<?php
/**
 * Setting the content width based on theme's layout
 */
if(!isset($content_width))
    $content_width = 740;

/**
 * Calling the theme options template and retrieving the theme options
 */
require(get_template_directory().'/admin/theme-options.php');
$themolio_options = themolio_get_options();
$themolio_is_mobile = themolio_is_mobile();
/**
 * Telling wordpress to run themolio_setup whenever "after_setup_theme" hook is run
 */
add_action('after_setup_theme', 'themolio_setup');
if (!function_exists('themolio_setup')):
function themolio_setup() {

    /* Make Themolio available for translation.
      * Translations can be added to the /languages/ directory.
      * If you're building a theme based on Themolio, use a find and replace
      * to change 'themolio' to the name of your theme in all the template files.
    */
    load_theme_textdomain('themolio', get_template_directory().'/languages' );
    add_editor_style();
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');

    /**
     * This sets up the image size for the grid based top-down layouts (with no sidebar).
     * If you change the width/height of your content,
     * you will have to modify the width and height mentioned below as well
     */
    add_image_size('themolio-two-col-grid-image-nosidebar',460,300,true);
    add_image_size('themolio-three-col-grid-image-nosidebar',290,200,true);
    add_image_size('themolio-four-col-grid-image-nosidebar',210,150,true);

    /**
     * This sets up the image size for the grid based top-down layouts (with sidebar).
     * If you change the width/height of your content,
     * you will have to modify the width and height mentioned below as well
     */
    add_image_size('themolio-two-col-grid-image-sidebar',356,250,true);
    add_image_size('themolio-three-col-grid-image-sidebar',230,150,true);
    add_image_size('themolio-four-col-grid-image-sidebar',171,110,true);

    /**
     * This sets up the image size for the featured image.
     * If you change the width/height of your content,
     * you will have to modify the width and height mentioned below as well
     */
    add_image_size('themolio-featured-image',800,300,true);

    register_nav_menu('primary', __('Primary Menu', 'themolio'));

    add_theme_support('post-formats', array('link', 'gallery', 'status', 'quote', 'image', 'video'));

    if(themolio_is_wp_version('3.4')) {
	add_theme_support('custom-background');
    } else {
	add_custom_background();
    }
}
endif;

/**
 * Checks the version of WP
 */
function themolio_is_wp_version($is_ver) {
    $wp_ver = explode('.', get_bloginfo('version'));
    $is_ver = explode('.', $is_ver);
    for($i=0; $i<=count($is_ver); $i++)
        if(!isset($wp_ver[$i])) array_push($wp_ver, 0);
    foreach($is_ver as $i => $is_val)
        if($wp_ver[$i] < $is_val) return false;
    return true;
}

/**
 * This removes the default gallery styling applied by wordpress
 */
add_filter('use_default_gallery_style', '__return_false');

/**
 * Default menu to use if custom menu is not used
 */
function themolio_page_menu_args($args) {
    $args['show_home'] = false;
    $args['menu_class'] = 'main-menu clearfix';
    return $args;
}
add_filter('wp_page_menu_args', 'themolio_page_menu_args');

/**
 * Enqueue javascript files required by theme
 */
function themolio_enqueue_head_scripts() {
    global $themolio_options;
    if(is_admin())
	return;
    if(is_singular() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
    wp_enqueue_script('jquery');
    wp_register_script('themolio-theme-js', get_template_directory_uri().'/js/themolio.js','jquery');
    wp_enqueue_script('themolio-dropdown-js');
    wp_enqueue_script('themolio-browser-detect-js');
    wp_enqueue_script('themolio-theme-js');
}
add_action('wp_enqueue_scripts', 'themolio_enqueue_head_scripts');

/**
 * Add style statements to the head
 */
function themolio_enqueue_styles() {
    global $themolio_is_mobile;
    $style = "";
    $style .= '<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="'.get_template_directory_uri().'/ie.css" /> <![endif]-->'."\n";
    $style .= '<link rel="stylesheet" type="text/css" media="all" href="'.get_template_directory_uri().'/fonts/stylesheet.css" />'."\n";
    $style .= '<style type="text/css">'."\n";
    $style .= themolio_typography();
    $style .= themolio_background_color_styling();
    $style .= '</style>'."\n";
    if($themolio_is_mobile)
	$style .= '<link rel="stylesheet" type="text/css" media="all" href="'.get_template_directory_uri().'/mobile.css" />'."\n";
    echo $style;
}
add_action('wp_head','themolio_enqueue_styles');

/**
 * Custom Typography Styling
 */
function themolio_typography() {
    global $themolio_options;
    $style = "";
	$style .= "\t".'body, #cancel-comment-reply-link { font-family: '.$themolio_options['content_font'].'; }'."\n";
    $style .= "\t".'.entry-content, .widget, #author-info, .entry-utility, .comment-meta, .comment-content, .pingback-content, #respond, .nocomments, .nopassword { color: #'.$themolio_options['font_color'].'; font-size: '.$themolio_options['font_size'].'%; }'."\n";
    $style .= "\t".'.entry-meta a, .entry-content a, .widget a, #author-info a, .entry-utility a, #crumbs a:hover, .comments-write-link a, .comment-meta a, .comment-content a, .pingback-content a, #respond a { color: #'.$themolio_options['link_color'].'; }'."\n";
    $style .= "\t".'.more-link:hover, .page-link a:hover span, .page-link span, .navigation a:hover, .navigation .current, .single-navigation span a:hover, .tagcloud a:hover { text-decoration: none; background-color: #'.$themolio_options['button_color'].'; text-shadow: #'.themolio_color_darken($themolio_options['button_color'],50).' 1px 1px !important; border-color: #'.themolio_color_darken($themolio_options['button_color'],50).'; }'."\n";
    $style .= "\t".'input[type="submit"], input[type="reset"], input[type="button"] { background-color: #'.$themolio_options['button_color'].'; text-shadow: #'.themolio_color_darken($themolio_options['button_color'],50).' 1px 1px !important; border-color: #'.themolio_color_darken($themolio_options['button_color'],50).'; }'."\n";
    $style .= "\t".'input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover { background-color: #'.themolio_color_darken($themolio_options['button_color'],30).'; text-shadow: #'.themolio_color_darken($themolio_options['button_color'],80).' 1px 1px !important; border-color: #'.themolio_color_darken($themolio_options['button_color'],80).'; }'."\n";
    return $style;
}

/**
 * Border color adjustment based on background color
 */
function themolio_background_color_styling() {
    global $themolio_options;
    $bgcolor = get_theme_mod('background_color');
    $bgimage = get_theme_mod('background_image');
    $style = '';
    if((trim($bgcolor) != '' and trim($bgimage) != '') or (trim($bgcolor) != '' and trim($bgimage) == '')) {
        $style .= "\t".'article.post, article.page, article.type-attachment, .widget, #crumbs, .navigation a, .single-navigation span a, .comment-title-container, .commentlist li, #respond, .nocomments, .nopassword { border-color: #'.themolio_color_darken($bgcolor,30).'; }'."\n";
    } else if(trim($bgimage) != '' and trim($bgcolor) == '') {
        $style .= "\t".'article.post, article.page, article.type-attachment, .widget, #crumbs, .navigation a, .single-navigation span a, .comment-title-container, .commentlist li, #respond, .nocomments, .nopassword { border-color: #222; }'."\n";
    }
    return $style;
}

/**
 * Setting global variable to maintain the count of items in the grid
 * Do not modify this function
 */
$themolio_grid_item_count = 1;
function themolio_grid_item_count_incr() {
    global $themolio_grid_item_count;
    $themolio_grid_item_count++;
}

function themolio_grid_col_class() {
    global $themolio_options;
    if($themolio_options['grid_columns'] == 2)
        echo ' grid-col-2';
    elseif($themolio_options['grid_columns'] == 3)
        echo ' grid-col-3';
    elseif($themolio_options['grid_columns'] == 4)
        echo ' grid-col-4';
}

/**
 * Register sidebars and widgetized areas
 */
function themolio_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'themolio'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'themolio_widgets_init');

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own themolio_posted_on to override in a child theme
 */
if (!function_exists('themolio_posted_on')):
function themolio_posted_on() {
	printf(__('<span class="entry-date">Posted on <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a> </span><span class="entry-author">By <a href="%4$s" title="%5$s" rel="author">%6$s</a></span>', 'themolio' ),
		esc_url(get_permalink()),
		esc_attr(get_the_time()),
		esc_html(get_the_date()),
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		esc_attr(sprintf(__('View all posts by %s', 'themolio'), get_the_author())),
		get_the_author()
	);
	?>
	<?php edit_post_link(__('Edit','themolio'), '<span class="edit-link">', '</span>'); ?>
	<?php
}
endif;

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function themolio_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'themolio_excerpt_length');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function themolio_continue_reading_link() {
    return '<p><a class="more-link" href="'.esc_url(get_permalink()).'">'.__('Continue reading', 'themolio').'</a></p>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with a themolio_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function themolio_auto_excerpt_more($more) {
    return themolio_continue_reading_link();
}
add_filter('excerpt_more', 'themolio_auto_excerpt_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function themolio_custom_excerpt_more( $output ) {
    if(has_excerpt() && !is_attachment()) {
        $output .= themolio_continue_reading_link();
    }
    return $output;
}
add_filter('get_the_excerpt', 'themolio_custom_excerpt_more');

/**
 * Create pagination link for posts
 */
function themolio_get_pagination($range = 4){
    global $paged, $wp_query;
    $max_page = 0;
    if (!$max_page) {
        $max_page = $wp_query->max_num_pages;
    }
    if($max_page > 1){
        echo '<div class="navigation clearfix">'."\n";
        if(!$paged){
            $paged = 1;
        }
        if($paged != 1){
            echo "<a href=".get_pagenum_link(1).">".__('First','themolio')."</a>";
        }
        previous_posts_link(' &laquo; ');
        if($max_page > $range){
            if($paged < $range){
                for($i = 1; $i <= ($range + 1); $i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged) echo " class='current'";
                    echo ">".number_format_i18n($i)."</a>";
                }
            }
            elseif($paged >= ($max_page - ceil(($range/2)))){
                for($i = $max_page - $range; $i <= $max_page; $i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged) echo " class='current'";
                    echo ">".number_format_i18n($i)."</a>";
                }
            }
            elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
                for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged) echo " class='current'";
                    echo ">".number_format_i18n($i)."</a>";
                }
            }
        }
        else{
            for($i = 1; $i <= $max_page; $i++){
                echo "<a href='".get_pagenum_link($i) ."'";
                if($i==$paged) echo " class='current'";
                echo ">".number_format_i18n($i)."</a>";
            }
        }
        next_posts_link(' &raquo; ');
        if($paged != $max_page){
            echo " <a href=".get_pagenum_link($max_page).">".__('Last','themolio')."</a>";
        }
        echo '</div>'."\n";
    }
}

/**
 * Displays breadcrumbs
 */
function themolio_breadcrumbs() {
    $delimiter = '<span class="sep">&raquo;</span>';
    $home = __('Home','themolio'); // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div id="crumbs">';
        global $post;
        $homeLink = home_url();
        echo '<a href="'.$homeLink.'">'.$home.'</a> '.$delimiter.' ';
        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' '.$delimiter.' '));
            echo $before.__('Archive by category','themolio').' "'.single_cat_title('', false).'"'.$after;
        } elseif (is_day()) {
            echo '<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.' ';
            echo '<a href="'.get_month_link(get_the_time('Y'),get_the_time('m')).'">'.get_the_time('F').'</a> '.$delimiter.' ';
            echo $before.get_the_time('d').$after;
        } elseif (is_month()) {
            echo '<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.' ';
            echo $before.get_the_time('F').$after;
        } elseif (is_year()) {
            echo $before.get_the_time('Y').$after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="'.$homeLink.'/'.$slug['slug'].'/">'.$post_type->labels->singular_name.'</a> '.$delimiter.' ';
                echo $before.get_the_title().$after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' '.$delimiter.' ');
                echo $before.get_the_title().$after;
            }
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' '.$delimiter.' ');
            echo '<a href="'.get_permalink($parent).'">'.$parent->post_title.'</a> '.$delimiter.' ';
            echo $before.get_the_title().$after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before.get_the_title().$after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="'.get_permalink($page->ID).'">'.get_the_title($page->ID).'</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb.' '.$delimiter.' ';
                echo $before.get_the_title().$after;
        } elseif (is_search()) {
            echo $before.__('Search results for','themolio').' "'.get_search_query().'"'.$after;
        } elseif (is_tag()) {
            echo $before.__('Posts tagged','themolio').' "'.single_tag_title('', false).'"'.$after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before.__('Articles posted by','themolio').' '.$userdata->display_name.$after;
        } elseif (is_404()) {
            echo $before.__('Error 404','themolio').' '. $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
            echo __('Page','themolio').' '.get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
        }
        echo '</div>';
    }
}

/**
 * Displays Author's description on Single post templates
 */
function themolio_post_author_info() {
    global $themolio_options;
    // If a user has filled out their description and this is a multi-author blog, show a bio on their entries
    if(get_the_author_meta('description') && (!function_exists('is_multi_author') || is_multi_author())) {
        ?>
        <div id="author-info" class="clearfix">
            <div id="author-avatar">
                <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('themolio_author_bio_avatar_size', 48)); ?>
            </div>
            <div id="author-description">
                <h3><?php printf(__('About %s', 'themolio'), get_the_author()); ?></h3>
                <p><?php the_author_meta('description'); ?></p>
                <p>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"><?php printf(__('View all posts by %s <span class="meta-nav">&rarr;</span>', 'themolio'), get_the_author()); ?></a>
                </p>
            </div>
        </div>
        <?php
    }
}

/**
 * Prints HTML with post category and tags.
 */
function themolio_utility() {
    global $themolio_options;
    $utility_text = "";
    $categories_list = get_the_category_list(__(', ', 'themolio'));
    $tag_list = get_the_tag_list('', __(', ', 'themolio'));
    if($categories_list != "")
        $utility_text .= '<p><span class="utility-title">'.__('Posted under: ','themolio').'</span>'.$categories_list.'</p>';
    if($tag_list != "")
        $utility_text .= '<p><span class="utility-title">'.__('Tagged as: ','themolio').'</span>'.$tag_list.'</p>';

    if($utility_text != "" and $themolio_options['show_single_utility']) {
        echo '<div class="entry-utility">';
        echo $utility_text;
        echo '</div>';
    }
}

/**
 * Outputs pages in dropdown (used for mobile displays)
 */
function themolio_pages_dropdown() {
    ?>
    <select id="themolio_page_dropdown" name="themolio_page_dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
    <option value=""><?php _e('Select page','themolio'); ?></option> 
    <?php 
	$pages = get_pages(); 
	foreach ($pages as $page) {
	    $option = '<option value="'.get_page_link($page->ID).'">';
	    $option .= $page->post_title;
	    $option .= '</option>';
	    echo $option;
	}
    ?>
   </select>    
    <?php
}

/**
 * Function to return darker color shade
 */
function themolio_color_darken($color, $dif=80){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '000000'; }
    $rgb = '';
    for ($x=0;$x<3;$x++){
        $c = hexdec(substr($color,(2*$x),2)) - $dif;
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
    return $rgb;
}

if(!function_exists('themolio_comment')):
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own themolio_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function themolio_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch($comment->comment_type):
        case 'pingback':
	case 'trackback':
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="pingback">
                <div class="pingback-content">
                    <?php _e('Pingback:', 'themolio'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'themolio'), '<p class="pingback-edit-link">', '</p>'); ?>
                </div>
            </article>
        <?php
        break;
        default:
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-meta">
                <table class="tablayout"><tr>
                <td class="tdleft" style="width:55px;vertical-align:top;"><?php echo get_avatar($comment, '40'); ?></td>
                <td class="tdleft" style="vertical-align:top;">
                    <p class="comment-author"><?php printf(__('<strong>%1$s</strong> on %2$s <span class="says">said:</span>', 'themolio'), sprintf('<span class="fn">%s</span>', get_comment_author_link()), sprintf('<a href="%1$s">%2$s</a>', esc_url(get_comment_link($comment->comment_ID)), sprintf(__('%1$s at %2$s', 'themolio'), get_comment_date(), get_comment_time()))); ?></p>
                    <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'themolio'), 'before' => '<p class="comment-reply">', 'after' => '</p>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    <?php edit_comment_link( __('Edit', 'themolio'), '<p class="edit-link">', '</p>'); ?>
                    <?php if($comment->comment_approved == '0'): ?>
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'themolio'); ?></p>
                    <?php endif; ?>
                </td>
                </tr></table>
            </div>
            <div class="comment-content"><?php comment_text(); ?></div>
        </article>
<?php
        break;
    endswitch;
}
endif;

function themolio_is_mobile() {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	return true;
    else
	return false;
}
?>