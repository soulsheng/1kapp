<?php

if ( !defined('ABSPATH') )
    die('You are not allowed to call this page directly.');

global $wpdb, $nggdb;

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

// Get WordPress scripts and styles
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-widget');
wp_enqueue_script('jquery-ui-position');
global $wp_scripts;
if (!isset($wp_scripts->registered['jquery-ui-autocomplete'])) {
	wp_register_script( 'jquery-ui-autocomplete', NGGALLERY_URLPATH .'admin/js/jquery.ui.autocomplete.min.js', array('jquery-ui-core'), '1.8.15');
}
wp_enqueue_script('jquery-ui-autocomplete');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>NextGEN Gallery</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<?php wp_print_scripts() ?>
    <script language="javascript" type="text/javascript" src="<?php echo NGGALLERY_URLPATH ?>admin/js/ngg.autocomplete.js"></script>
	<script language="javascri