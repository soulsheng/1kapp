<?php
/**
 * @package Themolio
 */
?>
<?php
/* THEME SETTINGS PAGE */
/***********************/
//Initialize theme options on load
function themolio_init_options() {
    if(false === themolio_get_options()) add_option('themolio_options', themolio_get_default_options());
    register_setting('themolio_options', 'themolio_options', 'themolio_validate_options');
}
add_action('admin_init', 'themolio_init_options');

//Retrieve theme options
function themolio_get_options() {
    return get_option('themolio_options', themolio_get_default_options());
}

//Return capability
function themolio_page_capability($capability) {
    return 'edit_theme_options';
}
add_filter('option_page_capability_themolio_options', 'themolio_page_capability');

//Enqueue stylesheets and dependent javascripts
function themolio_enqueue_scripts($hook_suffix) {
    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
    wp_enqueue_script('themolio_color_picker', get_template_directory_uri().'/admin/jquery-colorpicker/jscolor.js', false, false);
    wp_enqueue_script('themolio_admin_js', get_template_directory_uri().'/admin/theme-options.js', array('jquery'), false);
    wp_enqueue_style('themolio_admin_css', get_template_directory_uri().'/admin/theme-options.css', false, false, 'all');
}

//Add theme option page to the admin menu
function themolio_activate_options() {
    $themolio_theme_page = add_theme_page(__('Themolio Settings','themolio'), __('Themolio Settings','themolio'), 'edit_theme_options', 'themolio_options', 'themolio_options_page');
    if(!$themolio_theme_page) return;
    add_action('admin_print_styles-' . $themolio_theme_page, 'themolio_enqueue_scripts');
}
add_action('admin_menu', 'themolio_activate_options');

//Default dropdowns
function themolio_tab_list() {
    $tabs = array(
        'typography' => array('value' => 'typography', 'label' => __('Fonts & Colors','themolio')),
        'logo' => array('value' => 'logo', 'label' => __('Logo & Favicon','themolio')),
        'layout' => array('value' => 'layout', 'label' => __('Layout','themolio')),
        'blog' => array('value' => 'blog', 'label' => __('Blog','themolio')),
        'social' => array('value' => 'social', 'label' => __('Social','themolio')),
    );
    return apply_filters('themolio_tab_list', $tabs);
}

function themolio_content_fonts() {
    $fonts = array(
        'Helvetica, Arial, sans-serif' => array('value' => 'Helvetica, Arial, sans-serif', 'label' => __('Helvetica, Arial','themolio')),
        'Georgia, serif' => array('value' => 'Georgia, serif', 'label' => __('Georgia','themolio')),
        'Verdana' => array('value' => 'Verdana', 'label' => __('Verdana','themolio')),
    );
    return apply_filters('themolio_content_fonts', $fonts);
}

function themolio_grid_columns() {
    $number_of_columns = array(
        '2' => array('value' => '2', 'label' => __('Two','themolio')),
        '3' => array('value' => '3', 'label' => __('Three','themolio')),
        '4' => array('value' => '4', 'label' => __('Four','themolio'))
    );
    return apply_filters('themolio_grid_columns', $number_of_columns);
}

function themolio_grid_layout() {
    $grid_layout = array(
        'top-bottom' => array('value' => 'top-bottom', 'label' => __('Top to Bottom','themolio')),
        'left-right' => array('value' => 'left-right', 'label' => __('Left to Right','themolio'))
    );
    return apply_filters('themolio_grid_layout', $grid_layout);
}

function themolio_blog_style() {
    $blog_styles = array(
        'standard' => array('value' => 'standard', 'label' => __('Standard','themolio')),
        'grid' => array('value' => 'grid', 'label' => __('Grid','themolio'))
    );
    return apply_filters('themolio_blog_style', $blog_styles);
}

//Retrieve Default theme settings
function themolio_get_default_options() {
    $themolio_default_options = array(
        'content_font' => 'Helvetica, Arial, sans-serif',
        'font_size' => 83.3,
        'font_color' => '666666',
        'link_color' => 'E3940B',
        'button_color' => 'E65343',
        'custom_favicon' => '',
        'custom_logo' => '',
        'blog_style' => 'grid',
        'show_sidebar_grid' => false,
        'show_search' => true,
        'show_excerpt' => false,
        'show_featured' => false,
        'show_single_utility' => true,
        'show_page_meta' => false,
        'grid_columns' => 3,
        'grid_layout' => 'top-bottom',
        'facebook_user' => '',
        'twitter_user' => '',
        'enable_rss' => true
    );
    return apply_filters('themolio_get_default_options', $themolio_default_options);
}

function themolio_options_page() {
    if(isset($_POST['settings-reset'])) {
        delete_option('themolio_options');
        add_settings_error('themolio_options','settings-reset-update',__('Default settings restored','themolio'),'updated');
    }
    ?>
    <div class="wrap"> <!-- Start of wrap -->
        <?php screen_icon(); ?>
        <?php $theme_name = function_exists('wp_get_theme') ? wp_get_theme() : get_current_theme(); ?>
        <h2><?php printf(__('%s Theme Options', 'themolio'), $theme_name); ?></h2>
        <?php settings_errors(); ?>

        <!-- Tabs -->
        <?php $count = 1; ?>
        <h2 class="nav-tab-wrapper">
            <?php foreach (themolio_tab_list() as $tab) { if($count == 1) $class = " nav-tab-active"; else $class = ""; ?>
            <a href="javascript:void(0)" id="nav-tab-<?php echo $tab['value']; ?>" class="nav-tab<?php echo $class; ?>">
                <?php echo $tab['label']; ?>
            </a>
            <?php $count++; } ?>
        </h2>
        <div class="clear"></div>

        <form class="settings-form" method="post" id="settings-form" action="options.php">
            <?php
                settings_fields('themolio_options');
                $themolio_options = themolio_get_options();
                $themolio_default_options = themolio_get_default_options();
            ?>
            <div class="settings-section current-section" id="settings-typography">
                <p>
                    <label><?php _e('Content Font','themolio'); ?>:</label>
                    <select name="themolio_options[content_font]">
                        <?php foreach (themolio_content_fonts() as $content_font) { ?>
                            <option value="<?php echo $content_font['value']; ?>" <?php selected($themolio_options['content_font'], $content_font['value']); ?>><?php echo $content_font['label']; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label><?php _e('Content Font Size','themolio'); ?>:</label>
                    <input style="font-weight: 700;font-size:15px;" type="button" value=" - " id="font_size_decr_btn"/>
                    <input type="text" readonly="readonly" name="themolio_options[font_size]" id="font_size" value="<?php echo esc_attr($themolio_options['font_size']); ?>"/> %
                    <input style="font-weight: 700;font-size:15px;" type="button" value=" + " id="font_size_incr_btn"/>
                </p>
                <p>
                    <label><?php _e('Font color','themolio'); ?>:</label>
                    <input type="text" name="themolio_options[font_color]" class="color" value="<?php echo esc_attr($themolio_options['font_color']); ?>"/>
                </p>
                <p>
                    <label><?php _e('Link color','themolio'); ?>:</label>
                    <input type="text" name="themolio_options[link_color]" class="color" value="<?php echo esc_attr($themolio_options['link_color']); ?>"/>
                </p>
                <p>
                    <label><?php _e('Button color','themolio'); ?>:</label>
                    <input type="text" name="themolio_options[button_color]" class="color" value="<?php echo esc_attr($themolio_options['button_color']); ?>"/>
                </p>
            </div>
            <div class="settings-section" id="settings-logo">
                <p>
                    <label><?php _e('Custom Logo','themolio'); ?></label>
                    <input type="text" name="themolio_options[custom_logo]" id="custom_logo" size="36" value="<?php echo esc_attr($themolio_options['custom_logo']); ?>"/>
                    <input id="custom_logo_upload" type="button" class="image_upload button-secondary" value="<?php _e('Upload Logo','themolio'); ?>" />
                </p>
                <p>
                    <label><?php _e('Custom Favicon','themolio'); ?></label>
                    <input type="text" name="themolio_options[custom_favicon]" id="custom_favicon" size="36" value="<?php echo esc_attr($themolio_options['custom_favicon']); ?>"/>
                    <input id="custom_favicon_upload" type="button" class="image_upload button-secondary" value="<?php _e('Upload Favicon Image','themolio'); ?>" />
                </p>
            </div>
            <div class="settings-section" id="settings-layout">
                <p>
                    <label><?php _e('Layout Style','themolio'); ?>:</label>
                    <select name="themolio_options[blog_style]">
                        <?php foreach (themolio_blog_style() as $blog_style) { ?>
                            <option value="<?php echo $blog_style['value']; ?>" <?php selected($themolio_options['blog_style'], $blog_style['value']); ?>><?php echo $blog_style['label']; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label><?php _e('Number of columns for Grid','themolio'); ?>:</label>
                    <select name="themolio_options[grid_columns]">
                        <?php foreach (themolio_grid_columns() as $grid_columns) { ?>
                            <option value="<?php echo $grid_columns['value']; ?>" <?php selected($themolio_options['grid_columns'], $grid_columns['value']); ?>><?php echo $grid_columns['label']; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label><?php _e('Layout for grid','themolio'); ?>:</label>
                    <select name="themolio_options[grid_layout]">
                        <?php foreach (themolio_grid_layout() as $grid_layout) { ?>
                            <option value="<?php echo $grid_layout['value']; ?>" <?php selected($themolio_options['grid_layout'], $grid_layout['value']); ?>><?php echo $grid_layout['label']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="field-meta"><?php _e('<strong>Top to bottom</strong>: Posts in the grid will be arranged starting from top moving downwards. <strong>Left to right</strong>: Posts in the grid will be arranged from left to right','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('Sidebar for Grid page','themolio'); ?></label>
                    <input type="checkbox" name="themolio_options[show_sidebar_grid]" value="true" <?php checked(true,$themolio_options['show_sidebar_grid']); ?> />
                    <span class="field-meta"><?php _e('Show sidebar on the grid page ?','themolio'); ?></span>
                </p>
            </div>
            <div class="settings-section" id="settings-blog">
                <p>
                    <label><?php _e('Front page excerpts','themolio'); ?></label>
                    <input type="checkbox" name="themolio_options[show_excerpt]" value="true" <?php checked(true,$themolio_options['show_excerpt']); ?> />
                    <span class="field-meta"><?php _e('Display excerpts on front page for standard layout blog ?','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('Featured Image','themolio'); ?></label>
                    <input type="checkbox" name="themolio_options[show_featured]" value="true" <?php checked(true,$themolio_options['show_featured']); ?> />
                    <span class="field-meta"><?php _e('Display featured images on front page (for both grid and standard layout) ?','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('Default Search Box','themolio'); ?></label>
                    <input type="checkbox" name="themolio_options[show_search]" value="true" <?php checked(true,$themolio_options['show_search']); ?> />
                    <span class="field-meta"><?php _e('Display default search box in header','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('Categories and Tags','themolio'); ?>:</label>
                    <input type="checkbox" name="themolio_options[show_single_utility]" value="true" <?php checked(true,$themolio_options['show_single_utility']); ?> />
                    <span class="field-meta"><?php _e('Show tags and categories for single entries','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('Page Meta','themolio'); ?>:</label>
                    <input type="checkbox" name="themolio_options[show_page_meta]" value="true" <?php checked(true,$themolio_options['show_page_meta']); ?> />
                    <span class="field-meta"><?php _e('Show meta information for pages','themolio'); ?></span>
                </p>
            </div>
            <div class="settings-section" id="settings-social">
                <p>
                    <label><?php _e('Facebook','themolio'); ?>:</label>
                    <input type="text" class="social-field" id="facebook-user" name="themolio_options[facebook_user]" value="<?php echo esc_attr($themolio_options['facebook_user']); ?>"/>
                    <span class="field-meta"><?php _e('Enter your facebook user id','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('Twitter','themolio'); ?>:</label>
                    <input type="text" class="social-field" id="twitter-user" name="themolio_options[twitter_user]" value="<?php echo esc_attr($themolio_options['twitter_user']); ?>"/>
                    <span class="field-meta"><?php _e('Enter your twitter user id','themolio'); ?></span>
                </p>
                <p>
                    <label><?php _e('RSS','themolio'); ?>:</label>
                    <input type="checkbox" name="themolio_options[enable_rss]" value="true" <?php checked(true,$themolio_options['enable_rss']); ?> />
                    <span class="field-meta"><?php _e('Show RSS icon','themolio'); ?></span>
                </p>
            </div>
            <?php submit_button('Save Settings','primary','settings-submit',false); ?>
        </form>

        <form class="form" method="post" id="reset-form" style="text-align: right; margin-top: 10px;" onsubmit="return confirmAction()">
            <input type="submit" class="button-secondary" name="settings-reset" id="settings-reset" value="<?php _e('Reset Settings','themolio'); ?>" />
        </form>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align: right; margin-top: 10px;">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="43VU78ENDDKSU">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
        <p style="text-align: right; margin-top: 10px; padding-top: 10px; border-top: 1px #ccc solid;">
            <?php _e('Theme designed and developed by <a href="http://www.nischalmaniar.com">Nischal Maniar</a>','themolio'); ?>
        </p>
    </div> <!-- End of settings wrap -->
    <?php
}

function themolio_validate_options($input) {
    $output = $defaults = themolio_get_default_options();

    //Validating dropdowns and radio options
    if (isset($input['blog_style']) && array_key_exists($input['blog_style'], themolio_blog_style()))
	$output['blog_style'] = $input['blog_style'];
    if (isset($input['grid_columns']) && array_key_exists($input['grid_columns'], themolio_grid_columns()))
	$output['grid_columns'] = $input['grid_columns'];
    if (isset($input['content_font']) && array_key_exists($input['content_font'], themolio_content_fonts()))
	$output['content_font'] = $input['content_font'];
    if (isset($input['grid_layout']) && array_key_exists($input['grid_layout'], themolio_grid_layout()))
	$output['grid_layout'] = $input['grid_layout'];

    //Validating Color Boxes
    if(themolio_validate_color($input['font_color']))
        $output['font_color'] = $input['font_color'];
    if(themolio_validate_color($input['link_color']))
        $output['link_color'] = $input['link_color'];
    if(themolio_validate_color($input['button_color']))
        $output['button_color'] = $input['button_color'];

    //Validating Image fields
    if(trim($input['custom_logo']) == "") {
        $output['custom_logo'] = $input['custom_logo'];
    } else {
        if(themolio_validate_image_url($input['custom_logo']))
            $output['custom_logo'] = $input['custom_logo'];
        else
            add_settings_error('themolio_options', 'invalid-logo-image', __('Invalid logo image URL','themolio'), 'error');
    }

    if(trim($input['custom_favicon']) == "") {
        $output['custom_favicon'] = $input['custom_favicon'];
    } else {
        if(themolio_validate_image_url($input['custom_favicon'])) {
            if(themolio_validate_image_size($input['custom_favicon'],16,16))
                $output['custom_favicon'] = $input['custom_favicon'];
            else
                add_settings_error('themolio_options', 'invalid-favicon-size', __('Favicon size cannot exceed 16 x 16 pixels','themolio'), 'error');
        } else
            add_settings_error('themolio_options', 'invalid-favicon-image', __('Invalid favicon image URL','themolio'), 'error');
    }

    //Validating number fields
    if(themolio_validate_decimal($input['font_size'])) {
        $output['font_size'] = $input['font_size'];
    } else {
        add_settings_error('themolio_options', 'invalid-font-size', __('Invalid font size. Font size should be in decimal format','themolio'), 'error');
    }

    //Validating Social site usernames
    if(themolio_validate_social_user($input['facebook_user']) or trim($input['facebook_user']) == "")
        $output['facebook_user'] = $input['facebook_user'];
    else
        add_settings_error('themolio_options', 'invalid-facebook-user', 'Invalid facebook username', 'error');

    if(themolio_validate_social_user($input['twitter_user']) or trim($input['twitter_user']) == "")
        $output['twitter_user'] = $input['twitter_user'];
    else
        add_settings_error('themolio_options', 'invalid-twitter-user', 'Invalid twitter username', 'error');

    //Validating all the checkboxes
    $chkboxinputs = array('show_search','show_single_utility','show_page_meta','show_excerpt','show_featured','enable_rss','show_sidebar_grid');
    foreach($chkboxinputs as $chkbox) {
        if (!isset($input[$chkbox]))
            $input[$chkbox] = null;
        $output[$chkbox] = ($input[$chkbox] == true ? true : false);
    }

    return apply_filters('themolio_validate_options', $output, $input, $defaults);
}

/* Supporting validation functions */
function themolio_validate_color($color) {
    $exp = "/([A-Za-z0-9])/";
    if(!preg_match($exp,$color))
        return false;
    else
        return true;
}

function themolio_validate_image_url($url) {
    $exp = "/^https?:\/\/(.)*\.(jpg|png|gif|ico)$/i";
    if(!preg_match($exp,$url))
        return false;
    else
        return true;
}

function themolio_validate_image_size($url,$width,$height) {
    $size = getimagesize($url);
    if($size[0] > $width or $size[1] > $height)
        return false;
    else
        return true;
}

function themolio_validate_number($value,$min,$max) {
    if(is_numeric($value)) {
        $value = intval($value);
        if($value < $min or $value > $max)
            return false;
        else
            return true;
    } else return false;
}

function themolio_validate_decimal($value) {
    if(is_numeric($value))
        return true;
    else return false;
}

function themolio_validate_social_user($user) {
    $exp = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*$/";
    if(!preg_match($exp,$user))
        return false;
    else
        return true;
}
?>