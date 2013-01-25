<?php

// 当前：sharedbank
// 备用1：lovelesson@ymail.com
//$APPID = "52926";
//$APPSECRET = "70jonYDNxjZFKZPbhx6oa4oGp3PqNX2V";
// 备用2：lovelesson@ymail.com
//$APPID = "52922";
//$APPSECRET = "Mjm0ChxibbuW3o1zcH4CzP36R18YBMoJ";
// 备用3：sharedbank
//$APPID = "50999";
//$APPSECRET = "H7fQXg40ZdDZBrkVlJLDNszrDfc0ZNEM";
$APPID = "50999";
$APPSECRET = "H7fQXg40ZdDZBrkVlJLDNszrDfc0ZNEM";
//防盗链设置 如果不需要请勿填写
//添加方法 $HTTP_HOST = array('www.baidu.com','www.123.com');
//不要加上http:// 最好配置完整的域名地址 例如:bbs.baidu.com www.baidu
$SECURITY_ARR = array('soulshenglife.sinaapp.com',
'v.liushousheng.com',
'soulshengit.sinaapp.com',
'tastewordpress.sinaapp.com',
'faithhopelove.sinaapp.com',
'soulsheng.1kapp.com');

//指定跳转的url 如果不填默认 $SECURITY_ARR 的第一个URL
$WEB_URL = '';
//防盗链的时候排除某些后缀的
$FILE_OUT = array('jpg','gif','bmp','png');