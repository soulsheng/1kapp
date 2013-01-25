<?php

/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-plugin/recaptcha-captcha/qa-recaptcha-captcha.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Captcha module for reCAPTCHA


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


	class qa_recaptcha_captcha {
	
		var $directory;
		
		function load_module($directory, $urltoroot)
		{
			$this->directory=$directory;
		}


		function admin_form()
		{
			$saved=false;
			
			if (qa_clicked('recaptcha_save_button')) {
				qa_opt('recaptcha_public_key', qa_post_text('recaptcha_public_key_field'));
				qa_opt('recaptcha_private_key', qa_post_text('recaptcha_private_key_field'));
				
				$saved=true;
			}
			
			$form=array(
				'ok' => $saved ? 