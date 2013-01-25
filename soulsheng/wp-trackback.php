<?php
/**
 * Handle Trackbacks and Pingbacks sent to WordPress
 *
 * @package WordPress
 */

if (empty($wp)) {
	require_once('./wp-load.php');
	wp( array( 'tb' => '1' ) );
}

/**
 * trackback_response() - Respond with error or success XML message
 *
 * @param int|bool $error Whether there was an error
 * @param string $error_message Error message if an error occurred
 */
function trackback_response($error = 0, $error_message = '') {
	header('Content-Type: text/xml; charset=' . get_option('blog_charset') );
	if ($error) {
		echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
		echo "<response>\n";
		echo "<error>1</error>\n";
		echo "<message>$error_message</message>\n";
		echo "</response>";
		die();
	} else {
		echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
		echo "<response>\n";
		echo "<error>0</error>\n";
		echo "</response>";
	}
}

// trackback is done by a POST
$request_array = 'HTTP_POST_VARS';

if ( !isset($_GET['tb_id']) || !$_GET['tb_id'] ) {
	$tb_id = explode('/', $_SERVER['REQUEST_URI']);
	$tb_id = intval( $tb_id[ count($tb_id) - 1 ] );
}

$tb_url  = isset($_POST['url'])     ? $_POST['url']     : '';
$charset = isset($_POST['charset']) ? $_POST['charset'] : '';

// These three are stripslashed here so that they can be properly escaped after mb_convert_encoding()
$title     = isset($_POST['title'])     ? stripslashes($_POST['title'])      : '';
$excerpt   = isset($_POST['excerpt'])   ? stripslashes($_POST['excerpt'])    