<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net
 * Created  Feb 16, 2012
 * KV操作
 */
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

class KVDB extends Service{
	public static function get_instance() {
		if (!is_object(@self :: $instance['SaeKV'])) {
			self :: $instance['SaeKV'] = new SaeKV();
			self :: $instance['SaeKV']->init();
		}
		return self :: $instance['SaeKV'];
	}
}

//获取
function kvget($key){
	return KVDB::get($key);
}

//设置
function kvset($key, $value){
	return KVDB::set($key, $value);
}