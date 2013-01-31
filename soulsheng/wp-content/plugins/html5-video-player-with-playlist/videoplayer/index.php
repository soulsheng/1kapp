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
<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>template-compressed.js"></script>
<script type="text/javascript">
      
	  var siteurl = '<?php echo plugin_dir_url(__FILE__); ?>';
	  
	  jQuery(function() {
        jQuery("#html5player<?php echo $id; ?>").html5player({
          width: '<?php echo $width; ?>px',
          height: '<?php echo $height; ?>px',
          playlist: '<?php echo plugin_dir_url(__FILE__); ?>../xml/<?php echo $xml; ?>',
		  vertical: <?php echo $playlistmod; ?>,
		  autoNext: <?php echo $autoNext; ?>,
		  shuffle: <?php echo $shuffle; ?>,
		  loop: <?php echo $loop; ?>,
		  scrollMode: "<?php echo $scrollMode; ?>", //"auto"
		  logo: "<?php echo $logo; ?>" // logo.png
        });
      
	  //jQuery(".html5playerer-default-playlist-pager").innerHTML( jQuery("#social").html() );
	  
	  //alert(jQuery("#social").html());
	  
	  
	  
	  });
    </script>

<?php /*?><div id="social"><div style="float:right;"><a href="https://twitter.com/intent/tweet?status=<?php echo "HTML5 Video Player with Playlist "; ?><?php echo urlencode('http://html5.svnlabs.com'); ?>&amp;url=<?php echo urlencode('http://html5.svnlabs.com'); ?>" target="_blank" title="Twitter"><img src="<?php echo plugin_dir_url(__FILE__); ?>twitter.png" border="0" width="20" /></a><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://html5.svnlabs.com'); ?>" target="_blank" title="Facebook"><img src="<?php echo plugin_dir_url(__FILE__); ?>facebook.png" border="0" width="20" /></a><a href="http://html5.svnlabs.com" target="_blank" title="HTML5 Video Player with Playlist"><img src="<?php echo plugin_dir_url(__FILE__); ?>link-icon.png" border="0" width="20" /></a></div></div><?php */?>

<?php /*?>	<div style="position: relative;"><!-- Hot Spots - Video Map --> 
<div id="ihint1" style="border: 1px dotted #FF0000; background: none repeat scroll 0% 0% transparent; cursor: pointer; outline: medium none; text-align: center; vertical-align: middle; position: absolute; top: 69px; left: 243px; z-index: 99; padding: 10px;"><a style="color:#000000" href="http://blog.svnlabs.com/category/concentrate/"><strong>Concentrate</strong></a></div>
<div id="ihint2" style="border: 3px dotted #FFFF00; background: none repeat scroll 0% 0% transparent; cursor: pointer; outline: medium none; text-align: center; vertical-align: middle; position: absolute; top: 264px; left: 109px; z-index: 99; padding: 10px;"><a style="color:#000000" href="http://blog.svnlabs.com/category/observe/"><strong>Observe</strong></a></div>
<div id="ihint3" style="border: 3px dotted #FF6666; background: none repeat scroll 0% 0% transparent; cursor: pointer; outline: medium none; text-align: center; vertical-align: middle; position: absolute; top: 357px; left: 272px; z-index: 99; padding: 10px;"><a style="color:#000000" href="http://blog.svnlabs.com/category/imagine/"><strong>Imagine</strong></a></div>
<div id="ihint4" style="border: 1px dotted #9900CC; background: none repeat scroll 0% 0% transparent; cursor: pointer; outline: medium none; text-align: center; vertical-align: middle; position: absolute; top: 61px; left: 92px; z-index: 99; padding: 10px;"><a style="color:#000000" href="http://blog.svnlabs.com/category/launch/"><strong>Launch</strong></a></div>
<p><!-- Main Video --><br><?php */?>

<div id="html5player<?php echo $id; ?>"></div>

<img src="http://html5.svnlabs.com/html5log/html5video.php" alt="" width="1" height="1" />


