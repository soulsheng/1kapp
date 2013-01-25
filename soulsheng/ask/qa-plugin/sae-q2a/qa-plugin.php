<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net
 * Created  Feb 11, 2012
 * Description a plugin which tweak Q2A to running on SAE
 */

/*
 Plugin Name: SAE Q2A
 Plugin URI: htpp://q2achina.sinaapp.com/sae_q2a_plugin
 Plugin Description: Tweak Q2A to running on SAE
 Plugin Version: 1.0
 Plugin Date: 2012-02-11
 Plugin Author: Tomheng
 Plugin Author URI: http://blog.webfuns.net
 Plugin License: GPLv2
 Plugin Minimum Question2Answer Version: 1.5
 Plugin Update Check URI: htpp://q2achina.sinaapp.com/check/sae_q2a_plugin
 */

// don't allow this page to be requested directly from browser
if (!defined('QA_VERSION')) {
	header('Location: ../../');
	exit;
}

defined('SAE_Q2A_DIR') || define('SAE_Q2A_DIR', QA_PLUGIN_DIR.'sae-q2a/'); //插件目录
defined('CACHE_OPTIONS_KEY') || define('CACHE_OPTIONS_KEY', 'qa-all-options'); //option 缓存的key值
defined('IMG_DOMAIN') || define('IMG_DOMAIN', 'images');  //图片存储Storage的名称
defined('IMG_EXPIRES') || define('IMG_EXPIRES', 'access plus 1 year');  //Storage中图片文件的缓存时间
defined('KVDB_MAX_VALUE_LEN') || define('KVDB_MAX_VALUE_LEN', 1024*1024*4); //KVDB value的最大存储长度
defined('PAGE_CACHE_ENABLE') || define('PAGE_CACHE_ENABLE', TRUE); //是否启用页面缓存
defined('MINIFY_CSS_JS') || define('MINIFY_CSS_JS', TRUE); //是否启用对CSS,JS的合并压缩
defined('CSS_JS_EXPIRE') || define('CSS_JS_EXPIRE', 86400*30); //合并压缩后的缓存时间

defined('CSS_VERSION') || define('CSS_VERSION', '1') ; //CSS 版本，通过修改这里的值可以更新缓存
defined('JS_VERSION') || define('JS_VERSION', '1');    //JS 版本，通过修改这里的值可以更新缓存

require_once SAE_Q2A_DIR.'sae-kvdb.php';
require_once SAE_Q2A_DIR.'sae-memcache.php';
require_once SAE_Q2A_DIR.'sae-storage.php';

/*---------------------------------------------------------
 *
 * 注册插件功能
 *
 *--------------------------------------------------------*/

qa_register_plugin_overrides('override_function.php'); //重写函数
qa_register_plugin_module('process', 'qa-process.php', 'SAE_QA_Process', 'Process'); //过程处理
qa_register_plugin_module('event', 'qa-event.php', 'SAE_QA_Event', 'Event'); //事件处理
qa_register_plugin_module('login', 'qa-sw-login.php', 'ST_Login', '新浪微博登录'); //支持新浪微博登陆
qa_register_plugin_module('login', 'qa-qq-login.php', 'QQ_Login', '腾讯QQ登录');   //支持QQ登陆
qa_register_plugin_module('captcha', 'sae-captcha.php', 'SAE_QA_Captcha', 'SAE Captcha'); //使用SAE上的验证码服务

/*---------------------------------------------------------
 *
 * 下面定义了一些插件中使用的函数
 *
 *--------------------------------------------------------*/

/**
 * 建立写入链接
 * @param boolen $connect 无连接时是否尝试连接
 */
function wdb_connection($connect = true) {
	global $_qa_db_connection;
	if ($connect && !is_resource($_qa_db_connection)) {
		$_qa_db_connection = mysql_connect(SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, QA_FINAL_MYSQL_USERNAME, QA_FINAL_MYSQL_PASSWORD);
		if (!is_resource($_qa_db_connection)) {
			//qa_fatal_error('Failed to connect to database');
		}
		if (!mysql_select_db(QA_FINAL_MYSQL_DATABASE, $_qa_db_connection)) {
			mysql_close($_qa_db_connection);
			qa_db_fail_error('select');
		}
	}
	return $_qa_db_connection;
}

//加载缓存的配置
function qa_preload_cache_options(){
	require_once SAE_Q2A_DIR.'sae-kvdb.php';
	global $qa_options_cache, $qa_options_loaded;
	$qa_options_cache = @unserialize(kvget(CACHE_OPTIONS_KEY));
	if(!is_array($qa_options_cache)){
		require_once QA_INCLUDE_DIR.'qa-app-options.php';
		qa_get_options(array());
		return update_cache_options();
	}
	return $qa_options_loaded = TRUE;
}

/**
 * 处理合并压缩文件请求(css,js)
 */
function check_combine_compress_request(){
	sae_set_display_errors(false); //关闭信息输出
	error_reporting(0);
	$requestparts=qa_request_parts();
	$firstpart = @$requestparts[0];
	$firstpart == 'qa-theme' && $firstpart = 'cb'; //hack for css combination
	if($firstpart == 'cb'){
		$cb_param = str_replace('/cb/', '', $_SERVER['REQUEST_URI']);
		if(0 == preg_match('/^[\w\-\/\.,]+$/i', $cb_param) || FALSE !== strpos($cb_param, '..') || !is_array($cb_parts = explode(',', $cb_param))){
			qa_redirect();
		}
		$ext = pathinfo($cb_parts[0], PATHINFO_EXTENSION);
		$key = $cb_param;
		if('js' == $ext){
			$type = 'js';
			$content_type = "content-type:application/x-javascript; charset: UTF-8";
			//$key .= ':'.JS_VERSION;
		}elseif('css' == $ext){
			$type = 'css';
			$content_type = "content-type: text/css; charset: UTF-8";
			//$key .= ':'.CSS_VERSION;
		}else{
			exit('Are you joking?:)');
		}
		//之前已经加载
		//if (extension_loaded('zlib') && !headers_sent()){
			//ob_start('ob_gzhandler');
		//}
		header($content_type);
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		$offset = defined('CSS_JS_EXPIRE') && CSS_JS_EXPIRE > 0 ? CSS_JS_EXPIRE : 60 * 60; //默认一小时
		header("expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT");
		
		$cb_content = mget($key);
		if(0 == strlen($cb_content)){
			foreach ($cb_parts as $part){
				if(!file_exists(QA_BASE_DIR.$part)){
					continue;
				}
				$content = file_get_contents(QA_BASE_DIR.$part);
				//未压缩文件进行压缩
				if(FALSE === stripos($part, '.min.')){
					$content = css_js_min($content, $type);
				}
				$cb_content .= $content;
			}
			mset($key, $cb_content);
		}
		echo $cb_content;
		extension_loaded('zlib') && ob_end_flush();
		exit();
	}

}

//压缩合并文件
function css_js_min($content, $type = 'js'){
	include_once 'class.JavaScriptPacker.php';
	include_once 'Compressor.php';
	if('js' == $type && class_exists('JavaScriptPacker')){
		$packer = new JavaScriptPacker($content, 'Normal', true, false);
		return $packer->pack();
	}else if('css' == $type && class_exists('Minify_CSS_Compressor')){
		return Minify_CSS_Compressor::process($content);		
	}
	return $content;
}

//更新缓存的配置
function update_cache_options(){
	require_once SAE_Q2A_DIR.'sae-kvdb.php';
	global $qa_options_cache;
	if(is_array($qa_options_cache)){
		return kvset(CACHE_OPTIONS_KEY, serialize($qa_options_cache));
	}
	return FALSE;
}

//生成页面的缓存key
function get_page_cache_key(){
	//post页面和登陆用户访问缓存内容
	if(qa_is_http_post() || qa_get_logged_in_userid() > 0){
		return FALSE;
	}
	$requestlower=strtolower(qa_request());
	$requestparts=qa_request_parts();
	$firstpart = $requestparts[0];
	$firstlower=strtolower($firstpart);
	//问题页面
	if(is_numeric($firstpart)){
		return get_question_page_cache_key($firstpart);
	}
	//列表页
	$uri = $_SERVER['REQUEST_URI'];
	if(in_array($uri, get_list_page_uri()) && empty($_GET)){
		return get_page_cache_key_prifix().$uri;
	}
}

//生成问题页面的缓存key
function get_question_page_cache_key($questionid){
	return 'q:'.$questionid;
}

//列表页的URI
function get_list_page_uri($type = 'all'){
	switch($type){
		case 'post' :
			$uri = array('question', 'tags', 'unanswered');
			break;
		case 'all' :
		default:
			$uri = array('questions', 'tags', 'users', 'unanswered');
	}
	return $uri;
}

/**
 *
 * 使用SAE debug功能实现日志记录功能
 * @param $msg
 */
function sae_log($msg) {
	sae_set_display_errors(false); //关闭信息输出
	sae_debug($msg); //记录日志
	sae_set_display_errors(true); //记录日志后再打开信息输出，否则会阻止正常的错误信息的显示
}

/**
 *
 * 封装SAE服务
 *
 */
class Service{
	private function __construct() {
	}
	protected static $instance = array();
	public static function get_instance(){
		throw new RuntimeException("Unimplemented");
	}
	public static function __callStatic($name, $arguments){
		$object = static::get_instance();
		if (is_object($object) && method_exists($object, $name)) {
			return call_user_func_array(array($object, $name), $arguments);
		}
		return FALSE;
	}
}

/*
 * OPEN ID登陆
 */
class Connect{
	protected $name = '';
	protected $id = '';

	protected $directory;
	protected $urltoroot;

	protected $key = '';
	protected $secret = '';

	public function __construct(){

		$this->key_opt_name = $this->id.'_app_key';
		$this->secret_opt_name = $this->id.'_app_secret';
		
	}

	protected function enable(){
		$this->key = qa_opt($this->key_opt_name);
		$this->secret = qa_opt($this->secret_opt_name);
		return strlen($this->key) && strlen($this->secret);
	}

	public function load_module($directory, $urltoroot) {
		$this->directory = $directory;
		$this->urltoroot = $urltoroot;
	}

	public function admin_form() {
		
		$saved = false;
		$btn_name = "{$this->id}_save_button";
		if (qa_clicked($btn_name)) {
			$this->key = &qa_post_text($this->key_opt_name);
			$this->secret = &qa_post_text($this->secret_opt_name);
			$this->key != qa_opt($this->key_opt_name) && qa_opt($this->key_opt_name, $this->key);
			$this->secret != qa_opt($this->secret_opt_name) && qa_opt($this->secret_opt_name, $this->secret);
			$saved = true;
		}else{
			$this->enable();
		}

		return array(
				'ok' => $saved ? '信息保存成功' : null,
				'fields' => array(
						array(
							'label' => 'App KEY:',
							'value' => qa_html($this->key),
							'tags' => "NAME='{$this->key_opt_name}'",
						),
						array(
							'label' => 'App Secret:',
							'value' => qa_html($this->secret),
							'tags' => "NAME='{$this->secret_opt_name}'",
						),
				),
				'buttons' => array(
						array(
							'label' => '保存设置',
							'tags' => "NAME='{$btn_name}'",
						),
				),
		);
	}
}