<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net
 * Created  Feb 16, 2012
 * memcache操作
 */
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

/**
 * memcache 操作
 */
class MC extends Service{
	public static function get_instance() {
		if (!is_object(@self :: $instance['Memcache'])) {
			self :: $instance['Memcache'] = memcache_init();
		}
		return self :: $instance['Memcache'];
	}
} 

//获取
function mget($key){
	if(empty($key)){
		return '';
	}
	return MC::get($key);
}

//设置
function mset($key, $value, $expire = 86400){
	if(empty($key)){
		return FALSE;
	}
	return MC::set($key, $value, MEMCACHE_COMPRESSED, $expire);	
}

//flush memcache
function mflush(){
	return MC::flush();
}