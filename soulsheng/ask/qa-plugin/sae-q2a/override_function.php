<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net     
 * Created  Feb 12, 2012
 * 重写的Q2A内部函数，使之更高校地在SAE运行
 *
 */

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

/**
 * 重写执行SQL函数，支持读写分离
 * @param string $query SQL语句
 */
function qa_db_query_execute($query) {
	$query = trim($query);
	//SAE不支持Lock操作
	if(FALSE !== stripos($query, 'LOCK')){
		return TRUE;
	};
	//将写类型语句提取，进行读写分离
	if (0 == preg_match('/^(SELECT|SHOW)\s+(?!LAST_INSERT_ID\s?\().*/i', $query)) {
		$result = mysql_query($query, wdb_connection()) ;
		if(!$result){
			qa_fatal_error(mysql_error());
		}
		return $result;
	}
	return qa_db_query_execute_base($query);
}

/*
	Create (or replace) the item ($type, $cacheid) in kvdb with $content
*/
function qa_db_cache_set($type, $cacheid, $content)	{
	//图片
	if(substr($type, 0, 2) == 'i_'){
		return save_img($type, $cacheid, $content);
	}
	//KVDB_MAX_VALUE_LEN KVDB中存储的最大长度
	if(KVDB_MAX_VALUE_LEN < strlen($content)){
		return kvset($type.$cacheid, $content);
	}
	qa_db_cache_set_base($type, $cacheid, $content);
}
	
/*
	Retrieve the item ($type, $cacheid) from kvdb
*/	
function qa_db_cache_get($type, $cacheid){
	//图片
	if(substr($type, 0, 2) == 'i_'){
		return NULL;
	}
	$re = kvget($type.$cacheid);
	if(FALSE != $re){
		return $re;
	}
	return qa_db_cache_get_base($type, $cacheid);
}
	
/**
 * 优化图像的URI结构
 */
function qa_get_avatar_blob_html($blobid, $width, $height, $size, $padding=false){
	require_once QA_INCLUDE_DIR.'qa-util-image.php';
	if (strlen($blobid) && ($size>0)) {
		qa_image_constrain($width, $height, $size);
		$type = 'i_'.$size;
		$src = get_img_url($type, $blobid);
		FALSE === $src && $src = qa_path('image', array('qa_blobid' => $blobid, 'qa_size' => $size), null, QA_URL_FORMAT_PARAMS);
		$html='<IMG SRC="'.$src.
				'" WIDTH="'.$width.'" HEIGHT="'.$height.'" CLASS="qa-avatar-image"/>';	
		if ($padding) {
			$padleft=floor(($size-$width)/2);
			$padright=$size-$width-$padleft;
			$padtop=floor(($size-$height)/2);
			$padbottom=$size-$height-$padtop;
			$html='<SPAN STYLE="display:inline-block; padding:'.$padtop.'px '.$padright.'px '.$padbottom.'px '.$padleft.'px;">'.$html.'</SPAN>';
		}
		return $html;
	}
	return null;
}

/**
 * 发送邮件
 * @param  Array $params 参数数组
 * $params = array(
 * 	'fromemail' => '',
 * 	'toemail' => '',
 * 	'subject' => '',
 * 	'body' => ''
 * );
 */
function qa_send_email($params){
	if(!is_array($params) || !isset($params['fromemail']) || !isset($params['toemail']) || !isset($params['subject']) || !isset($params['body'])){
		return FALSE;
	}
	require_once SAE_Q2A_DIR.'sae-mail.php';
	return Mail::send($params);
}

/**
 * 
 * 重写更新配置函数，支持更新缓存
 * @param $name
 * @param $value
 * @param $todatabase
 */
function qa_set_option($name, $value, $todatabase = TRUE){
	qa_set_option_base($name, $value, $todatabase);
	if(TRUE === $todatabase){
		update_cache_options();
		mflush();
	}
}

/**
 * 
 * 重写获得页面内容函数，支持缓存内容
 */
function qa_get_request_content(){
	$qa_html_cache = mget(get_page_cache_key());
	if(!is_string($qa_html_cache) || 0 == strlen($qa_html_cache)){
 		return qa_get_request_content_base();
 	}
 	return array('cache_page' => $qa_html_cache);
}

/**
 * 输出内容，支持缓存
 */
function qa_output_content($qa_content){
	if(isset($qa_content['cache_page']) && !empty($qa_content['cache_page'])){
		echo $qa_content['cache_page'];
		return TRUE;
	}
	ob_start();
	qa_output_content_base($qa_content);
	$cache_page = ob_get_flush();
	mset(get_page_cache_key(), $cache_page);
}


/**
 * 
 * 使用绝对路径
 */
function qa_path_to_root(){
	$site_url = qa_opt('site_url');
	if(!empty($site_url)){
		return $site_url;
	}
	return qa_path_to_root_base();
}
