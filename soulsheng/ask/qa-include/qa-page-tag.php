<?php
	
/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-include/qa-page-tag.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Controller for page for a specific tag


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../');
		exit;
	}

	require_once QA_INCLUDE_DIR.'qa-db-selects.php';
	require_once QA_INCLUDE_DIR.'qa-app-format.php';
	require_once QA_INCLUDE_DIR.'qa-app-updates.php';
	
	$tag=qa_request_part(1); // picked up from qa-page.php
	$start=qa_get_start();
	$userid=qa_get_logged_in_userid();


//	Find the questions with this tag

	if (!strlen($tag))
		qa_redirect('tags');

	@list($questions, $tagword, $favorite)=qa_db_select_with_pending(
		qa_db_tag_recent_qs_selectspec($userid, $tag, $start, false, qa_opt_if