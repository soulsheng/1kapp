<?php
/*$link = mysql_connect('localhost', '', '');
if (!$link) {
    die('Not Connected : ' . mysql_error());
}

// connect to database
$db_selected = mysql_select_db('', $link);

mysql_query("SET character_set_client=utf8", $link);
mysql_query("SET character_set_connection=utf8", $link);
mysql_query("SET character_set_results=utf8", $link);

if (!$db_selected) {
    die ('Can\'t Connected : ' . mysql_error());
}
*/

function format_number($number, $symbol = false )
{
   
    return  $symbol==true ? "£".number_format($number, 2, '.', '') : number_format($number, 2, '.', '');
}

?>