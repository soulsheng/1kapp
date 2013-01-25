<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net
 * Created  Feb 16, 2012
 * 邮件服务
 */
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

/**
 * 发送邮件服务
 */
class Mail {
	private static $option = array (
		'smtp_host' => 'smtp.sina.com',
		'smtp_port' => 25,
		'from' => 'question2answer@sina.com',
		'smtp_username' => 'question2answer@sina.com',
		'smtp_password' => 'question2answer',
		'content_type' => 'HTML',
		'charset' => 'utf8'
	);

	private static $main_instance = NULL;

	private function __construct() {
	}

	public static function send($params) {
		require_once QA_INCLUDE_DIR.'qa-util-string.php';
		if(!isset($params['toemail']) || !qa_email_validate($params['toemail']) || !strlen(@$params['subject']) || !strlen($params['body'])){
			return FALSE;
		}
		if (NULL === self :: $main_instance) {
			self :: $main_instance = new SaeMail();
		}
		if ($params['html']) {
			self :: $option['content_type'] = 'HTML';
		}
		if (qa_opt('smtp_active') && qa_opt('smtp_authenticate')) {
			self :: $option['smtp_host'] = qa_opt('smtp_address');
			self :: $option['smtp_port'] = qa_opt('smtp_port');
			self :: $option['smtp_username'] = qa_opt('smtp_username');
			self :: $option['smtp_password'] = qa_opt('smtp_password');
		}
		self :: $option['from'] = $params['fromemail'];
		//SAE Email服务须要 from == smtp_username
		self :: $option['from'] != self :: $option['smtp_username'] && self :: $option['from'] =  self :: $option['smtp_username']; 
		self :: $option['to'] = $params['toemail'];
		self :: $option['subject'] = $params['subject'];
		self :: $option['content'] = $params['body'];
		if(self :: $option['content_type'] == 'HTML'){
			self :: $option['content'] = nl2br(self :: $option['content']);
		}
		self :: $main_instance->setOpt(self :: $option);
		return self :: $main_instance->send() && self :: $main_instance->clean();
	}
}
