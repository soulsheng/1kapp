<?php

/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net
 * Created  Feb 19, 2012
 *
 */
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../');
	exit;
}
require_once 'saetv2.ex.class.php';
class ST_Login extends Connect{
	
	public function __construct(){
		$this->name = '新浪微博';
		$this->id = 'sina_weibo';
		parent::__construct();
	}
	
	public function check_login() {
		if(!$this->enable()){
			return FALSE;
		}
		$o = new SaeTOAuthV2($this->key, $this->secret);
		if (isset ($_REQUEST['code'])) {
			$keys = array ();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = qa_request();
			try {
				$token = $o->getAccessToken('code', $keys);
			} catch (OAuthException $e) {
				//qa_fatal_error($e->getMessage());
			}
			$c = new SaeTClientV2($this->key, $this->secret, $token['access_token']);
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$user = $c->show_user_by_id($uid);
			if (is_array($user) && $uid > 0) {
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
		}else{
			
		}
	}
	
	private function get_authorize_URL($tourl){
		$o = new SaeTOAuthV2($this->key, $this->secret);
		return $code_url = $o->getAuthorizeURL($tourl);
	}
	
	public function login_html($tourl, $context) {
		if($context == 'menu' || !$this->enable()){
			return FALSE;
		}
		$code_url = $this->get_authorize_URL($tourl);
		echo "<a href='{$code_url}' title='用新浪微博账号直接登陆'><img src='http://www.sinaimg.cn/blog/developer/wiki/240.png' alt='用新浪微博账号直接登陆'/></a>";
	}
}
?>
