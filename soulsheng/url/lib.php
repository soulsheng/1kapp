<?php
function id2url($dec) {
    global $basestring,$host;
    $result = '';   
  
    do {   
        $result = $basestring[$dec % 64] . $result;   
        $dec = intval($dec / 64);   
    } while ($dec != 0);   
  
    return 'http://'.$host.'/'.$result;   
}

function code2id($dec) {
    global $basestring;
    $result = 0;

    $len = strlen($dec);
    for ($i = 0; $i < $len; $i++) {
        $key = $dec[$len-$i-1];
        $result = $result+strpos($basestring, $key)*pow(64,$i);
    }

    return $result;
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function get_url_num() {
    $mysql = new SaeMysql();

    $sql = "SELECT * FROM `shorted` order by `url_id` desc limit 1";
    $data = $mysql->getData( $sql );
    return $data[0]['url_id'];
}
