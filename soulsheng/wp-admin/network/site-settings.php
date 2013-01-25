<?php
/**
 * Edit Site Settings Administration Screen
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.1.0
 */

/** Load WordPress Administration Bootstrap */
require_once( './admin.php' );

if ( ! is_multisite() )
	wp_die( __( 'Multisite support is not enabled.' ) );

if ( ! current_user_can( 'manage_sites' ) )
	wp_die( __( 'You do not have sufficient permissions to edit this site.' ) );

get_current_screen()->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __('Overview'),
	'content' =>
		'<p>' . __('The menu is for editing information specific to individual sites, particularly if the admin area of a site is unavailable.') . '</p>' .
		'<p>' . __('<strong>Info</strong> - The domain and path are rarely edited as this can cause the site to not work properly. The Registered date and Last Updated date are displayed. Network admins can mark a site as archived, spam, deleted and mature, to remove from public listings or disable.') . '</p>' .
		'<p>' . __('<strong>Users</strong> - This displays the users associated with this site. You can also change their role, reset their password, or remove them from the site. Removing the user from the site does not remove the user from the network.') . '</p>' .
		'<p>' . sprintf( __('<strong>Themes</strong> - This area shows themes that are not already enabled across the network. Enabling a theme in this menu makes it accessible to this site. It does not activate the theme, but 