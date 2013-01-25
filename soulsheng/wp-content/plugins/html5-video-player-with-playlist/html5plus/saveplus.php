<?php
//include_once("db.php");
include_once("function.php");

if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
 $id = $_REQUEST['id'];
 

$qq = mysql_query("select * from `".$table."` where id = '".$id."' ");

$docdata = mysql_fetch_assoc($qq);
 

$url = isset($_REQUEST['url'])?$_REQUEST['url']:"";

$ptitle = isset($_REQUEST['ptitle'])?$_REQUEST['ptitle']:"";
$description = isset($_REQUEST['description'])?$_REQUEST['description']:"";

$width = isset($_REQUEST['width'])?$_REQUEST['width']:"600";
$height = isset($_REQUEST['height'])?$_REQUEST['height']:"400";
$logo = isset($_REQUEST['logo'])?$_REQUEST['logo']:"";
$theme = isset($_REQUEST['theme'])?$_REQUEST['theme']:"";
$scrollMode = isset($_REQUEST['scrollMode'])?$_REQUEST['scrollMode']:"auto";
$playlistmod = isset($_REQUEST['playlistmod'])?$_REQUEST['playlistmod']:"t";
$autoNext = isset($_REQUEST['autoNext'])?$_REQUEST['autoNext']:"t";
$shuffle = isset($_REQUEST['shuffle'])?$_REQUEST['shuffle']:"f";
$loop = isset($_REQUEST['loop'])?$_REQUEST['loop']:"f";


$size = isset($_REQUEST['size'])?$_REQUEST['size']:"";
$xml = isset($_REQUEST['xml'])?$_REQUEST['xml']:"";
$id = isset($_REQUEST['id'])?$_REQUEST['id']:"";
$host = isset($_REQUEST['host'])?$_REQUEST['host']:"";


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Save Playlist")
{

$c = count($_REQUEST['song']);

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";

//$xml .= "<playlist version=\"1\" xmlns=\"http://xspf.org/ns/0/\">\r\n";
$xml .= "<playlist>\r\n";

$xml .= "<video-list>\r\n";

$maxfields = count($_REQUEST['title']);

$selectboxes = $_REQUEST['download'];
for($i = 0; $i < $maxfields; $i++)
{
  if(!isset($selectboxes[$i])) $selectboxes[$i] = 0;
}


for($i=0;$i<$c;$i++)
{

/*if(isset($_POST['download'][$i]) && $_POST['download'][$i]=='1')
{  print_r($selectboxes); die(); }
else
  $ddll = '0';  */


  $xml .= "\r\n<video>\r\n";

    $xml .= "<name><![CDATA[".$_REQUEST['title'][$i]."]]></name>\r\n";

	$xml .= "<artist><![CDATA[".$_REQUEST['artist'][$i]."]]></artist>\r\n";

	$xml .= "<url><![CDATA[".$_REQUEST['song'][$i]."]]></url>\r\n";

    $xml .= "<image><![CDATA[".$_REQUEST['image'][$i]."]]></image>\r\n";
	
	$xml .= "<download>".$selectboxes[$i]."</download>\r\n";

  $xml .= "</video>\r\n\r\n";

}
	
$xml .= "</video-list>\r\n";

$xml .= "</playlist>\r\n";	


if(isset($docdata['xml']))
file_put_contents(plugin_dir_path(__FILE__)."../xml/".$docdata['xml'], PHP_slashes($xml, "strip")); 


$ierror = "Please save playlist using Save Playlist button ";


}


if(isset($xml) && $xml!="")
{


$qq = mysql_query("select * from `".$table."` where id = '".$id."' ");

$docdata = mysql_fetch_assoc($qq);


	if(isset($docdata['id']) && $docdata['id']!="")
	{
	
	  //die("update `xml` set `url` = '".$url."', `size` = '".$size."', `xml` = '".base64_encode($xml)."', `adddate` = now() where id = '".$docdata['id']."' ");
	  
	  $xxmmll = $docdata['xml'];
	  
	  if($xxmmll=="") $xxmmll = time().".xml";
	  
      file_put_contents(plugin_dir_path(__FILE__)."/../xml/".$xxmmll, PHP_slashes($xml, "strip"));
	  
	  mysql_query("update `".$table."` set `title` = '".$ptitle."', `description` = '".$description."', `url` = '".$url."', `size` = '".$size."', `xml` = '".$xxmmll."', `sandbox`='1', `width`='".$width."', `height`='".$height."', `logo`='".$logo."', `playlistmod`='".$playlistmod."', `autoNext`='".$autoNext."', `shuffle`='".$shuffle."', `loop`='".$loop."', `scrollMode`='".$scrollMode."', `theme`='".$theme."', `adddate` = now() where id = '".$docdata['id']."' ");
	  
	  $iiid = $docdata['id'];
	
	}
	else
	{
	
	  $xxmmll = time().".xml";

      file_put_contents(plugin_dir_path(__FILE__)."/../xml/".$xxmmll, PHP_slashes($xml, "strip"));
	
	  mysql_query("insert into `".$table."` set  `title` = '".$ptitle."', `description` = '".$description."', `url` = '".$url."', `size` = '".$size."', `xml` = '".$xxmmll."', `sandbox`='1', `width`='".$width."', `height`='".$height."', `logo`='".$logo."', `playlistmod`='".$playlistmod."', `autoNext`='".$autoNext."', `shuffle`='".$shuffle."', `loop`='".$loop."', `scrollMode`='".$scrollMode."', `theme`='".$theme."',  `adddate` = now() ");
	  
	  $iiid = mysql_insert_id();	
	
	}
	
	?>
    
    <script language="javascript">
    
	document.location = "<?php echo get_bloginfo('url')."/wp-admin/admin.php?page=html5video_playlist&isuccess=Playlist saved successfully"; ?>";
	
	</script>
    
    <?php
	
	
 	
    //wp_redirect(get_bloginfo('url')."/wp-admin/admin.php?page=html5video_add_playlist",301); exit; 
	
	$isuccess = "Playlist saved successfully ";

}
else
{

   $ierror = "Something went wrong... navigate back";

}

?>