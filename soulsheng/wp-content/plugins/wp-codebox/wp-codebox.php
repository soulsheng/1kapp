<?php
/*
Plugin Name: WP-CodeBox
Plugin URI: http://www.ericbess.com/ericblog/2008/03/03/wp-codebox/
Description: WP-CodeBox provides clean syntax highlighting and AJAX advanced features for embedding source code within pages or posts.Wrap code blocks with <code>&lt;pre lang="LANGUAGE" line="1" file="download.txt" colla="+"&gt;</code> <code>&lt;/pre&gt;</code>. The <code>LANG</code> is supported by wide range of popular languages syntax. The <code>FILE</code> will create code downloading attribute. <code>line="n"</code>is the starting line number, <code>colla="+/-"</code> will expand/collapse the codebox.
Author: Eric Wang
Version: 1.4.3
Author URI: http://www.ericbess.com/ericblog/
*/
#
#  Copyright (c) 2008 Eric Wang
#
#  This file is part of WP-CodeBox.
#
#  Wp-CodeBox is free software; you can redistribute it and/or modify it under
#  the terms of the GNU General Public License as published by the Free
#  Software Foundation; either version 2 of the License, or (at your option)
#  any later version.
#
define('CB_VERSION', "1.4.3"); // Version of the Plugin
define('CB_FILE', "wp-codebox.php"); // Plugin File Name
$tOffAutoFmt = false; // set autoFormatOff as FALSE to enable auto formatting by default
$wp_codebox_token = md5(uniqid(rand()));
require_once ("geshi/geshi.php");
// Download the code
if (isset($_GET['download'])) {
    include_once "../../../wp-config.php";
    include_once "../../../wp-settings.php";
 