<?php
/*
Plugin Name: 云商店海外域名加速插件
Plugin URI: http://www.yuanshangdian.com/
Author: luofei614
Author URI: http://weibo.com/luofei614
Description: 使云商店的wordpress运行速度更快。
Version: 1.1
*/
if(isset($_SERVER['HTTP_APPNAME'])){
	add_filter('pre_option_siteurl','ysd_siteurl');
	add_filter('pre_option_home','ysd_home');
	add_filter('site_url','ysd_site_url',10,2);
	add_filter('login_url','ysd_login_url');
	add_filter('logout_url','ysd_logout_url');
	add_filter('admin_url','ysd_admin_url');
	add_action('wp_before_admin_bar_render','ysd_before_admin_bar_render');
	add_action('wp_after_admin_bar_render','ysd_after_admin_bar_render');
}
function ysd_siteurl(){
	return 'index.php'==basename($_SERVER['SCRIPT_FILENAME']) && false===strpos($_SERVER['SCRIPT_FILENAME'], 'wp-admin')?'http://'.substr($_SERVER['HTTP_APPNAME'],5).'.1kapp.com':'http://'.$_SERVER['HTTP_HOST'];
}
function ysd_home(){
	return 'http://'.$_SERVER['HTTP_HOST'];
}
function ysd_site_url($url,$path){
	if(in_array($path,array('wp-login.php?action=register','/wp-comments-post.php'))){
		return str_replace('http://'.substr($_SERVER['HTTP_APPNAME'],5).'.1kapp.com', 'http://'.$_SERVER['HTTP_HOST'],$url);
	}else{
		return $url;
	}
}
function ysd_before_admin_bar_render(){
	ob_start();
}
function ysd_after_admin_bar_render(){
	echo str_replace('http://'.substr($_SERVER['HTTP_APPNAME'],5).'.1kapp.com', 'http://'.$_SERVER['HTTP_HOST'],ob_get_clean());
}
function ysd_login_url($login_url){
	return str_replace('http://'.substr($_SERVER['HTTP_APPNAME'],5).'.1kapp.com', 'http://'.$_SERVER['HTTP_HOST'],$login_url);
}
function ysd_logout_url($logout_url){
	return str_replace('http://'.substr($_SERVER['HTTP_APPNAME'],5).'.1kapp.com', 'http://'.$_SERVER['HTTP_HOST'],$logout_url);
}
function ysd_admin_url($url){
	return str_replace('http://'.substr($_SERVER['HTTP_APPNAME'],5).'.1kapp.com', 'http://'.$_SERVER['HTTP_HOST'],$url);
}