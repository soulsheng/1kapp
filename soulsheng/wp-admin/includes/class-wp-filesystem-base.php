<?php
/**
 * Base WordPress Filesystem.
 *
 * @package WordPress
 * @subpackage Filesystem
 */

/**
 * Base WordPress Filesystem class for which Filesystem implementations extend
 *
 * @since 2.5
 */
class WP_Filesystem_Base {
	/**
	 * Whether to display debug data for the connection.
	 *
	 * @since 2.5
	 * @access public
	 * @var bool
	 */
	var $verbose = false;
	/**
	 * Cached list of local filepaths to mapped remote filepaths.
	 *
	 * @since 2.7
	 * @access private
	 * @var array
	 */
	var $cache = array();

	/**
	 * The Access method of the current connection, Set automatically.
	 *
	 * @since 2.5
	 * @access public
	 * @var string
	 */
	var $method = '';

	/**
	 * Returns the path on the remote filesystem of ABSPATH
	 *
	 * @since 2.7
	 * @access public
	 * @return string The location of the remote path.
	 */
	function abspath() {
		$folder = $this->find_folder(ABSPATH);
		//Perhaps the FTP folder is rooted at the WordPress install, Check for wp-includes folder in root, Could have some false positives, but rare.
		if ( ! $folder && $this->is_dir('/wp-includes') )
			$folder = '/';
		return $folder;
	}
	/**
	 * Returns the path on the remote filesystem of WP_CONTENT_DIR
	 *
	 * @since 2.7
	 * @access public
	 * @return string The location of the remote path.
	 */
	function wp_content_dir() {
		return $this->find_folder(WP_CONTENT_DIR);
	}
	/**
	 * Returns the path on the remote filesystem of WP_PLUGIN_DIR
	 *
	 * @since 2.7
	 * @acc