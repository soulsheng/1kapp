<?php
/*
 *
 * @author Tomheng
 * @date  2012-2-20
 */

class SAE_QA_Social_Login {

	private $connects = array();

	private $directory;
	private $urltoroot;

	public function __construct(){
		$this->add_connect('SW');
	}

	//添加支持的社会化连接服务
	private function add_connect($name){
		$name = strtoupper($name);
		if(class_exists($name)){
			$this->connects[$name] = new $name();
		}
	}

	public function load_module($directory, $urltoroot) {
		$this->directory = $directory;
		$this->urltoroot = $urltoroot;
	}

	//检查用户是否需要登录系统（回调页面检查）
	public function check_login() {
		foreach ($this->connects as $connect){
			if(!is_object($connect)){
				continue;
			}
			$connect->check_login();
		}
	}

	//显示登录连接HTML
	public function login_html($tourl, $context) {
		$html = '';
		foreach ($this->connects as $connect){
			if(!is_object($connect)){
				continue;
			}
			$html .= $connect->login_html();
		}
		echo $html;
	}

	public function &admin_form() {
		return $saved = false;
		if (qa_clicked('social_login_save_button')) {
			$this->save_opt();
			$saved = true;
		}
		$admin_form = array(
			'ok' => $saved ? '信息保存成功' : null,
			'buttons' => array (
				array (
					'label' => '保存设置',
					'tags' => 'NAME="social_login_save_button"',
				),
			),
		);
		foreach ($this->connects as $connect){
			if(!is_object($connect)){
				continue;
			}
			$connect->opt_fileds($admin_form['fields']);
		}
		return $admin_form;
	}
}

/**
 *
 * 连接接口
 * @author Tomheng
 *
 */
abstract class Connect{
	protected $name = '';
	protected $id = '';
	protected $key = '';
	protected $secret = '';
	protected $key_field = '';
	protected $secret_field = '';
	public function __construct(){
		$this->key_field = $this->id.'_key';
		$this->secret_field = $this->id.'_secret';
	}
	protected function get_opt(){
		$this->key = qa_opt($this->key_field);
		$this->secret = qa_opt($this->secret_field);
		return strlen($this->secret) && strlen($this->key);
	}

	public abstract function check_login();
	public abstract function get_authorize_URL($tourl); //获得授权链接
	
	public function login_html($tourl){
		$code_url = $this->get_authorize_URL($tourl);
		return "<a href='{$code_url}'>登录</a>";
	}
	
	private function opt_fileds(&$fields){
		if(!is_array($fields)){
			$fields = array();
		}
		$fields[] =	array (
						'label' => "{$this->name} App Key:",
						'value' => qa_html($this->key),
						'tags' => "NAME='{$this->key_field}'",
					);
		$fields[] =	array (
						'label' => "{$this->name} App Secret:",
						'value' => qa_html($this->secret),
						'tags' => "NAME='{$this->secret_field}'",
					);
	}

}

/**
 * 新浪微博
 */
require_once 'saetv2.ex.class.php';
class SW extends Connect{
	protected static $oauth = NULL;
	public function __construct(){
		$this->id = 'sina_weibo';
		$this->name = '新浪微博';
		parent::__construct();
		if($this->get_opt()){
			self::$oauth = new SaeTOAuthV2($this->key, $this->secret);
		}
	}

	public function get_authorize_URL($tourl){
		return self::$oauth->getAuthorizeURL($tourl);
	}
	
	public function check_login(){
		if (isset ($_REQUEST['code'])) {
			$keys = array ();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = qa_request();
			try {
				$token = $this->getAccessToken('code', $keys);
			} catch (OAuthException $e) {
				qa_fatal_error($e->getMessage());
			}
			$c = new SaeTClientV2($this->key, $this->secret, $token['access_token']);
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$user = $c->show_user_by_id($uid);
			if (is_array($user)) {
				qa_log_in_external_user($this->id, $uid, array (
					'email' => @ $user['email'],
					'handle' => @ $user['screen_name'],
					'confirmed' => TRUE,
					'name' => @ $user['name'],
					'location' => @ $user['location'],
					'website' => @ $user['url'],
					'about' => @ $user['description'],
					'avatar' => strlen(@ $user['avatar_large']) ? qa_retrieve_url($user['avatar_large']) : null,
					
				));
			}
		}
	}
}