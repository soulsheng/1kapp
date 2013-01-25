<?php

/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-include/qa-ajax-click-comment.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Server-side response to Ajax single clicks on comments


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

	require_once QA_INCLUDE_DIR.'qa-app-cookies.php';
	require_once QA_INCLUDE_DIR.'qa-app-format.php';
	require_once QA_INCLUDE_DIR.'qa-app-users.php';
	require_once QA_INCLUDE_DIR.'qa-db-selects.php';
	require_once QA_INCLUDE_DIR.'qa-page-question-view.php';
	require_once QA_INCLUDE_DIR.'qa-page-question-submit.php';


//	Load relevant information about this comment

	$commentid=qa_post_text('commentid');
	$questionid=qa_post_text('questionid');
	$parentid=qa_post_text('parentid');

	$userid=qa_get_logged_in_userid();

	@list($comment, $question, $parent, $children)=qa_db_select_with_pending(
		q