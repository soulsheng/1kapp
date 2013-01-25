<?php
/*
* SAE 数据存储服务
* @author Tomheng
* @date  2012-2-17
*/

class Storage extends Service{
	public static function get_instance(){
		if (!is_object(@self :: $instance['SaeStorage'])) {
			self :: $instance['SaeStorage'] = new SaeStorage();
		}
		return self :: $instance['SaeStorage'];
	}
}

//生成图片的存储路径
function get_img_path($type, $imgid){
	$dir = substr($imgid, 0, 5);
	$filename = $imgid.$type.'.jpg';
	return $dir.'/'.$filename;
}

//得到头像的URL
function get_img_url($type, $imgid){
	$filepath = get_img_path($type, $imgid);
	if(Storage::fileExists(IMG_DOMAIN, $filepath)){
		return Storage::getUrl(IMG_DOMAIN, $filepath);
	}
	return FALSE;
}

//保存图片
function save_img($type, $id, $content){
	$filepath = get_img_path($type, $id);
	$attr =  array('Content-Type' => 'image/jpeg', 'encoding' => 'gzip', 'expires' => IMG_EXPIRES);
	return Storage::write(IMG_DOMAIN, $filepath, $content, -1, $attr, TRUE);
}

