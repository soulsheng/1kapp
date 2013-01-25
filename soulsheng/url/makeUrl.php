<?php
$ips = explode(',', GetIP());
$ip = $ips[0];
$url = strip_tags( $_REQUEST['url'] );
$info = parse_url($url); 
$url_num = get_url_num();
if (($info === false) || (!isset($info['scheme'])) || (!isset($info['host'])) || ($info['scheme'] != 'ftp' && $info['scheme'] != 'http' && $info['scheme'] != 'https') || ($info['host'] == '')){
    $maked = false;
    require 'index.tpl'; 
}
else {
    $mysql = new SaeMysql();

    $sql = "SELECT * FROM `shorted` where url='$url' LIMIT 10";
    $data = $mysql->getData( $sql );
    if (!$data) {
        $sql = "INSERT  INTO `shorted` ( `url` , `ip` ) VALUES ( '"  . $mysql->escape( $url ) . "' , '" . $ip . "' ) ";
        $mysql->runSql( $sql );
        if( $mysql->errno() != 0 )
        {
            die( "Error:" . $mysql->errmsg() );
        }
        $mysql->closeDb();  
        $mysql = new SaeMysql();
        $maked = true;
        $sql = "SELECT * FROM `shorted` where url='$url' LIMIT 10";
        $data = $mysql->getData( $sql );
        $maked_url = id2url($data[0]['url_id']);
        require 'index.tpl';
    }
    else {
        $maked = true;
        $maked_url = id2url($data[0]['url_id']);
        require 'index.tpl'; 
    }
    $mysql->closeDb();  
}

function GetIP(){ 
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR"); 
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
        $ip = getenv("REMOTE_ADDR"); 
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
        $ip = $_SERVER['REMOTE_ADDR']; 
    else 
        $ip = "unknown"; 
    return($ip); 
} 
