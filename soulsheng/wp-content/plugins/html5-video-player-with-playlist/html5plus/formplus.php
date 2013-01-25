<?php
//include_once("db.php");
include_once("function.php");

if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
 $id = $_REQUEST['id'];
else
 $id = 0;

$qq = mysql_query("select * from `".$table."` where id = '".$id."' ");

$docdata = mysql_fetch_assoc($qq);



/* Save Playlist */

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Save Playlist")
{

include("saveplus.php");

}


/* Save Playlist */


$ele = '';

if($id)
{



if(file_exists(plugin_dir_path(__FILE__)."../xml/".$docdata['xml']))
{

//echo plugin_dir_url(__FILE__)."../xml/".$docdata['xml'];

$str = file_get_contents(plugin_dir_url(__FILE__)."../xml/".$docdata['xml']); 
				
				// load the string as xml object  
			  $xml = simplexml_load_string($str); 			  

              $result = $xml->xpath("//video");
			  
			  $mm=1;
			  
			  
			  //echo "<pre>"; print_r($result);
				
					  
   		      foreach($result as $ii)
			  {	
					
				$mp3p = $ii->image;						
					
				$mp3s = $ii->url;  
                 
				$mp3t = $ii->name; 
				
				$mp3a = $ii->artist;
				
				$mp3d = $ii->download;
				
				if($mp3d=='1')
				{  
				  $ddd = ' checked="checked" '; 
				  $vvv = 1; 
				}  
				else
				{
				 $ddd = '';
				 $vvv = 0;
				} 
				
			
			    $ele .= '<div id="divId' .$mm. '">';
				
				$ele .= '<input type="checkbox" name="download['.($mm-1).']" id="download' .$mm. '" '.$ddd.' value="1" />&nbsp;<input type="text" name="title[]"	id="title' .$mm. '" value="'.$mp3t.'" placeholder="title" />&nbsp;<input type="text" name="artist[]"	id="artist' .$mm. '" value="'.$mp3a.'" placeholder="artist" />&nbsp;<input type="text" size="70" name="song[]"	id="song' .$mm. '" value="'.$mp3s.'" placeholder="video" />&nbsp;<input type="text" size="70" name="image[]"	id="image' .$mm. '" value="'.$mp3p.'" placeholder="image" />';
				
				if($mm==1)
				  $ele .= '&nbsp;<a href="javascript:void(0)" onclick="return addNewElement()">+ Add More</a><br><br><br>';
				else
				  $ele .= '&nbsp;<a href="javascript:void(0)" onclick="return removeThisElement(' .$mm. ')">Remove This</a><br><br><br>';  
				  
				$ele .= '</div>';
				  
				
				$mm++;
				
			  }
			  
			  
			
			
			
}			


}


?>

<?php if(isset($_REQUEST['page']) && $_REQUEST['page']=="html5video-options") { ?>
<h2>Manage Playlist</h2>	 <br />
<?php } ?>

		
	 
 <form name="frm" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=html5video_add_playlist&action=update&id=<?php echo $_REQUEST['id']; ?>" method="post">
		

<br />
Manage HTML5 Video link and other information<br /><br />


<br />

<strong>Title</strong>: <input type="text" name="ptitle" value="<?php echo $docdata['title']; ?>" placeholder="title" />&nbsp;&nbsp;
<strong>Description</strong>: <input type="text" name="description" value="<?php echo $docdata['description']; ?>" placeholder="description" />&nbsp;&nbsp;
 

<?php //echo plugin_dir_path(__FILE__).'../videoplayer/jquery-ui'; ?>

<br /><br /><br />


<table width="90%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="5%" align="left"><strong>Download</strong></td>
    <td width="13%" align="center"><strong>Name</strong></td>
    <td width="11%" align="center"><strong>Artist</strong></td>
    <td width="32%" align="center"><strong>Media</strong></td>
    <td width="39%" align="center"><strong>Image</strong></td>
  </tr>
</table>





<div id="more_element_area">
  
  <script language="javascript">
  
  var idno = <?php echo isset($mm)?$mm:'2'; ?>;
  
  </script>
  
  <?php if($ele!="") { ?>
  
  <?php echo $ele; ?>
  
  <?php }else{ ?>
  
    <input type="checkbox" name="download[0]" id="download1"  value="1" />&nbsp;<input type="text" name="title[]" id="title1" value="" placeholder="title" />&nbsp;<input type="text" name="artist[]" id="artist1" value="" placeholder="artist" />&nbsp;<input type="text" name="song[]" id="song1" size="70" value="" placeholder="video" />&nbsp;<input type="text" name="image[]" id="image1" size="70" value="" placeholder="image" />&nbsp;<a href="javascript:void(0)" onclick="return addNewElement()">+ Add More</a><br><br>
    
  <?php } ?>  
    
  
</div>


<br />

<input type="hidden" name="host" value="<?php echo $_REQUEST['host']; ?>" />
 <input type="hidden" name="url" value="<?php echo $docdata['url']; ?>" />
 
 <input type="hidden"   name="size" value="full" />


<input type="submit" name="submit" style="background-color:#D84937; height:35px; color:#ffffff; font-weight:bold;" value="Save Playlist" />



</form>

<br />

Buy now this player for <a href="http://html5.svnlabs.com/html5-video-player-with-playlist/" target="_blank">Paid Features</a> 

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" onsubmit="return confirm('Have you checked Terms and Condition for HTML5 Video Player with Playlist on above link?');">
<p><input type="hidden" name="cmd" value="_s-xclick"><br>
<input type="hidden" name="hosted_button_id" value="AKNZ6S4PW2862"><br>
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online."></p>
<p><img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"></p>
</form>



<?php



?>


  <div>
        		
 </div>
