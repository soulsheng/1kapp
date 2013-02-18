<?php

$mysql = new SaeMysql();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = 'CREATE TABLE IF NOT EXISTS `shorted` (
      `url_id` int(20) NOT NULL AUTO_INCREMENT,
      `url` text NOT NULL,
      `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `ip` varchar(18) NOT NULL,
      PRIMARY KEY (`url_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
    $mysql->runSql( $sql );
    $sql = 'CREATE TABLE IF NOT EXISTS `config` (
      `basestring` varchar(64) NOT NULL,
      `host` varchar(100) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
    $mysql->runSql( $sql );
?>
<form id="setup" method="post" action="/url/setup.php">
        <fieldset>
                <legend>你的域名:</legend>
                <label for="host">你的域名:</label>
                <input type="text" id="host" name="host" value="eurl.sinaapp.com"/>
        </fieldset>
        <input type="submit" value="Submit" />
</form>
<?php
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = strip_tags( $_REQUEST['host'] );
    $basestring = 'xrK3IujFXleRZoSfmz4O1vgyEpnHJq8Ba9cCAY50M6VGwkdiT_QhL2t7sNWbPDU-';
    $sql = "INSERT INTO `config` VALUES ('$basestring','$host');";
    $mysql->runSql( $sql );
?>
<p>
你应该设置完成后马上删除"setup.php",这个文件.因为这会造成安全隐患.    
</p>    
<?php
}
$mysql->closeDb();
?>
