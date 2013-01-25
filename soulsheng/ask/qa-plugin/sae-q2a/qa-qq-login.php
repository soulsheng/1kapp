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

class QQ_Login extends Connect{
	private $api = 'https://graph.qq.com';
	private $scope = 'get_user_info';
	public function __construct(){
		$this->name = '腾讯QQ';
		$this->id = 'tencent_qq';
		parent::__construct();
	}

	public function check_login() {
		if(!$this->enable()){
			return FALSE;
		}
		$access_token = $this->callback();
		if(FALSE == $access_token){
			return FALSE;
		}
		$openid = $this->get_openid($access_token);
		if(empty($openid)){
			return FALSE;
		}
		$user = $this->get_user_info($access_token, $openid);
		if (is_array($user) && $user['ret'] == 0 && strlen($openid)) {
			qa_log_in_external_user($this->id, $openid, array (
				'handle' => @ $user['nickname'],
				'avatar' => strlen(@ $user['figureurl']) ? qa_retrieve_url($user['figureurl']) : null,
			));
		}
	}

	private function get_user_info($access_token, $openid){
		$get_user_info = "{$this->api}/user/get_user_info?"
		. "access_token=" . $access_token
		. "&oauth_consumer_key=" . $this->key
		. "&openid=" .$openid 
		. "&format=json";
		$info = qa_retrieve_url($get_user_info);
		$arr = json_decode($info, true);
		return $arr;
	}
	private function callback(){
		if(isset($_REQUEST['state']) && isset($_SESSION['state']) && $_REQUEST['state'] == $_SESSION['state']){//csrf
			$token_url = "{$this->api}/oauth2.0/token?grant_type=authorization_code&"."client_id=".$this->key."&redirect_uri=".urlencode(qa_path(qa_request()))
			."&client_secret=".$this->secret."&code=".@$_REQUEST["code"];
			$response = qa_retrieve_url($token_url);
			if (strpos($response, "callback") !== false){
				$lpos = strpos($response, "(");
				$rpos = strrpos($response, ")");
				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($response);
				if (isset($msg->error)){
					//qa_fatal_error($msg->error_description);
				}
			}
			$params = array();
			parse_str($response, $params);
			//set access token to session
			return isset($params["access_token"]) ? $params["access_token"] : '';
		}else{
			return false;
			//qa_fatal_error("The state does not match. You may be a victim of CSRF.");
		}
	}

	private function get_openid($access_token){
		$graph_url = "{$this->api}/oauth2.0/me?access_token={$access_token}";
		$str  = qa_retrieve_url($graph_url);
		if (strpos($str, "callback") !== false){
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
		}
		$user = json_decode($str);
		if (isset($user->error)){
			return '';
			//qa_fatal_error($msg->error_description);
		}
		//set openid to session
		return $user->openid;
	}

	public function login_html($tourl, $context) {
		if($context == 'menu' || !$this->enable()){
			return FALSE;
		}
		$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
		$login_url = "{$this->api}/oauth2.0/authorize?response_type=code&client_id=".$this->key."&redirect_uri=".urlencode($tourl)."&state=".$_SESSION['state']."&scope=".$this->scope;
		echo "<a href='{$login_url}' title='用QQ账号登陆'><img src='http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_3.png' alt='用QQ账号登陆'/></a>";
	}

}
?>
