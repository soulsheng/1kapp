<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net     
 * Created  Feb 20, 2012
 * 使用SAE的验证码
 *
 */

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../');
	exit;
}

class SAE_QA_Captcha{
	private $session_name = 'sae_vcode';
	private $form_field = 'answer';
	public function _allow_captcha(){
		return class_exists('SaeVCode');
	}
	
	public function form_html(&$qa_content, $error){
		qa_start_session();
		$vcode = new SaeVCode();
		if ($vcode === false){
			qa_fatal_error($vcode->errno().$vcode->errmsg());
		}
		$_SESSION[$this->session_name] = $vcode->answer();
		$question=$vcode->question();
		
		return "<table><tr><td>{$question['img_html']}</td><td><input name='{$this->form_field}' style='width:80px;'/></td></tr></table>";;
	}
	
	public function validate_post(&$error){
		if(0 == strcasecmp(qa_post_text($this->form_field), $_SESSION[$this->session_name])){
			return TRUE;
		}
		$error = '验证码错误';
		return FALSE;
	}
	
}

