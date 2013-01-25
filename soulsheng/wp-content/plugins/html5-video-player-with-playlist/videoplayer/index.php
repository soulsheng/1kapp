<?php

$qq = mysql_query("select * from `".$table."` where id = '".$id."' ");

$docdata = mysql_fetch_assoc($qq);

//print_r($docdata);

?>
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"></script>
<?php 

$width = isset($docdata['width'])? $docdata['width'] : '600'; 
$height = isset($docdata['height'])? $docdata['height'] : '400';
$logo = isset($docdata['logo'])? $docdata['logo'] : ''; 

$scrollMode = isset($docdata['scrollMode'])? $docdata['scrollMode'] : 'auto';
$playlistmod = $docdata['playlistmod']=="t" ? "true" : "false"; 
$autoNext = $docdata['autoNext']=="t" ? "true" : "false";
$shuffle = $docdata['shuffle']=="t" ? "true" : "false";
$loop = $docdata['loop']=="t" ? "true" : "false"; 

$theme = isset($docdata['theme'])? $docdata['theme'] : 'smoothness'; 

$xml = isset($docdata['xml'])? $docdata['xml'] : 'videolist.xml';
 


?>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>jquery-ui/<?php echo $theme;?>/jquery-ui-1.8.18.custom.css">
<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>player-compressed.js"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>player.css">
<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>template-compressed.js"></scrip