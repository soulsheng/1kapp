<?php

/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-include/qa-app-captcha.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Wrapper functions and utilities for captcha modules


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


	function qa_captcha_available()
/*
	Return whether a captcha module has been selected and it indicates that it is fully set up to go
*/
	{
		$module=qa_load_module('captcha', qa_opt('captcha_module'));
		
		return isset($module) && ( (!method_exists($module, 'allow_captcha')) || $module->allow_captcha());
	}
	
	
	function qa_set_up_captcha_field(&$qa_content, &$fields, $errors, $note=null)
/*
	Prepare $qa_content for showing a captcha, adding the element to $fields, give