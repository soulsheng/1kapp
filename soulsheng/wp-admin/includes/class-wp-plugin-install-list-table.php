<?php
/**
 * Plugin Installer List Table class.
 *
 * @package WordPress
 * @subpackage List_Table
 * @since 3.1.0
 * @access private
 */
class WP_Plugin_Install_List_Table extends WP_List_Table {

	function ajax_user_can() {
		return current_user_can('install_plugins');
	}

	function prepare_items() {
		include( ABSPATH . 'wp-admin/includes/plugin-install.php' );

		global $tabs, $tab, $paged, $type, $term;

		wp_reset_vars( array( 'tab' ) );

		$paged = $this->get_pagenum();

		$per_page = 30;

		// These are the tabs which are shown on the page
		$tabs = array();
		$tabs['dashboard'] = __( 'Search' );
		if ( 'search' == $tab )
			$tabs['search']	= __( 'Search Results' );
		$tabs['upload'] = __( 'Upload' );
		$tabs['featured'] = _x( 'Featured','Plugin Installer' );
		$tabs['popular']  = _x( 'Popular','Plugin Installer' );
		$tabs['new']      = _x( 'Newest','Plugin Installer' );

		$nonmenu_tabs = array( 'plugin-information' ); //Valid actions to perform which do not have a Menu item.

		$tabs = apply_filters( 'install_plugins_tabs', $tabs );
		$nonmenu_tabs = apply_filters( 'install_plugins_nonmenu_tabs', $nonmenu_tabs );

		// If a non-valid menu tab has been selected, And its not a non-menu action.
		if ( empty( $tab ) || ( !isset( $tabs[ $tab ] ) && !in_array( $tab, (array) $nonmenu_tabs ) ) )
			$tab = key( $tabs );

		$args = array( 'page' => $paged, 'per_page' => $per_page );

		switch ( $tab ) {
			case 'search':
				$type = is