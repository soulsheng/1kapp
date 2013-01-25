<?php
/**
 * Build Network Administration Menu.
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.1.0
 */

/* translators: Network menu item */
$menu[2] = array(__('Dashboard'), 'manage_network', 'index.php', '', 'menu-top menu-top-first menu-icon-dashboard', 'menu-dashboard', 'div');

$menu[4] = array( '', 'read', 'separator1', '', 'wp-menu-separator' );

/* translators: Sites menu item */
$menu[5] = array(__('Sites'), 'manage_sites', 'sites.php', '', 'menu-top menu-icon-site', 'menu-site', 'div');
$submenu['sites.php'][5]  = array( __('All Sites'), 'manage_sites', 'sites.php' );
$submenu['sites.php'][10]  = array( _x('Add New', 'site'), 'create_sites', 'site-new.php' );

$menu[10] = array(__('Users'), 'manage_network_users', 'users.php', '', 'menu-top menu-icon-users', 'menu-users', 'div');
$submenu['users.php'][5]  = array( __('All Users'), 'manage_network_users', 'users.php' );
$submenu['users.php'][10]  = array( _x('Add New', 'user'), 'create_users', 'user-new.php' );

$update_data = wp_get_update_data();

if ( $update_data['counts']['themes'] ) {
	$menu[15] = array(sprintf( __( 'Themes %s' ), "<span class='update-plugins count-{$update_data['counts']['themes']}'><span class='theme-count'>" . number_format_i18n( $update_data['counts']['themes'] ) . "</span></span>" ), 'manage_network_themes', 'themes.php', '', 'menu-top menu-icon-appearance', 'menu-appearance', 'div' );
} else {
	$menu[15] = array( __( 'Themes' ), 'mana