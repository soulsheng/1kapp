<?php
//DBank直链使用DEMO
require_once('include/NSPClient.class.php');
require_once('config.php');
//文件对应网盘/我的网盘/我的应用/PublicFiles/相对路径地址，如果在/我的网盘/我的应用/PublicFiles/hello.txt, 只需要传hello.txt
$path = isset($_REQUEST['path']) ? $_REQUEST['path'] : '';
/*echo $_SERVER['SERVER_NAME']."<br>";//获取来源网址,即点击来到本页的上页网址
echo $_SERVER["HTTP_REFERER"]."<br>";
echo $_SERVER['REQUEST_URI']."<br>";//获取当前域名的后缀
echo $_SERVER['HTTP_HOST']."<br>";//获取当前域名
exit;*/
if(empty($path)) {
	exit;
}
$file_suffix = substr($path,strpos($path,".")+1);
if(!in_array($file_suffix,$FILE_OUT))
{
	if(!empty($SECURITY_ARR))
	{
		$flg = 0;
		if(empty($_SERVER['HTTP_REFERER']))
		{
			$jump_url = $SECURITY_ARR[0];
			if(!empty($WEB_URL))
			{
				$jump_url = $WEB_URL;
			}
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			echo '你要访问的资源来自<a href="http://'.$jump_url.'">'.$jump_url.'</a>';
			echo '<script>setTimeout("location.href=\'http://'.$jump_url.'\'",2000);</script>';
			exit;
		}
		foreach($SECURITY_ARR as $key=>$val)
		{
			if(strpos($_SERVER['HTTP_REFERER'],$val))
			{
				$flg++;
			}
		}
		//如果等于0说明不在白名单内
		if($flg==0)
		{
			$jump_url = $SECURITY_ARR[0];
			if(!empty($WEB_URL))
			{
				$jump_url = $WEB_URL;
			}
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			echo '你要访问的资源来自<a href="http://'.$jump_url.'">'.$jump_url.'</a>';
			echo '<script>setTimeout("location.href=\'http://'.$jump_url.'\'",2000);</script>';
			exit;
		}
	}
}
$path = "/我的网盘/我的应用/PublicFiles/".iconv( "GBK//IGNORE","UTF-8", urldecode($path));
//clientIp 为需要下载直链的客户端ip地址
$clientIp = getonlineip();
//$appid $appsecret 为你申请的直链appid和secret
$appid = $APPID;
$appsecret = $APPSECRET;
$nsp = new NSPClient($appid, $appsecret);
//访问直链的service服务
$link = $nsp->service('nsp.vfs.link');
$ret = $link->getDirectUrl($path,$clientIp);
//如果白名单为空则不开启防盗链
if(isset($ret["retcode"]) && $ret["retcode"] == "0000") {
	//跳转到直链的下载地址
	header("Location: ".$ret["url"]);
} else {
	if($ret["retcode"] == "0001") {
		//path不合法
		header('HTTP/1.0 400 Bad Request');
		exit;
	}else if($ret["retcode"] == "0002") {
		//该用户无权限
		header('HTTP/1.0 400 Bad Request');
		exit;
	}else if($ret["retcode"] == "0003") {
		//流量已使用完
		header('HTTP/1.0 400 Bad Request');
		exit;
	}else if($ret["retcode"] == "0004") {
		//文件不存在
		header('HTTP/1.0 400 Bad Request');
		exit;
	}
}
function getonlineip($format=0) {
    global $_SGLOBAL;
    if(empty($_SGLOBAL['onlineip'])) {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
        $_SGLOBAL['onlineip'] = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
    }
    if($format) {
        $ips = explode('.', $_SGLOBAL['onlineip']);
        for($i=0;$i<3;$i++) {
            $ips[$i] = intval($ips[$i]);
        }
        return sprintf('%03d%03d%03d', $ips[0], $ips[1], $ips[2]);
    } else {
        return $_SGLOBAL['onlineip'];
    }
}
