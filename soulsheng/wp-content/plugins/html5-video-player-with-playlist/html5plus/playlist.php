<?php

global $wpdb;
$table		=	$wpdb->prefix."html5video_playlist";


$isuccess = isset($_REQUEST['isuccess'])?$_REQUEST['isuccess']:"";
$ierror = isset($_REQUEST['ierror'])?$_REQUEST['ierror']:"";


if(isset($_GET['id'])){
	$id		=	$_GET['id'];
}


$usql		=	"SELECT * FROM $table WHERE id='$id'";
$uresults 	= 	$wpdb->get_row( $usql  );


$action		=	"add";
if(isset($_GET['action'])){
	$action	=	$_GET['action'];	
}

if($action=="delete") {

$delete		=	$wpdb->query(
							"DELETE FROM $table WHERE id='$id'"
						);
						
$isuccess	=	"Playlist deleted successfully";						
						
}						


if(isset($_REQUEST['width']) && $_REQUEST['width']!="")
{
  $width=$_REQUEST['width'];
}
else
{
  $width = '600';
}

if(isset($_REQUEST['height']) && $_REQUEST['height']!="")
{
  $height=$_REQUEST['height'];
}
else
{
  $height = '250';
}


if(isset($_REQUEST['stitle']) && $_REQUEST['stitle']!="")
{
  $stitle=$_REQUEST['stitle'];
}
else
{
  $stitle = '0';
}


if(isset($_REQUEST['size']) && $_REQUEST['size']!="")
{
  $size=$_REQUEST['size'];
}
else
{
  $size = 'full';
}


if(isset($_REQUEST['links']) && $_REQUEST['links']!="")
{
  $links=$_REQUEST['links'];
}
else
{
  $links = '0';
}


$c=array('DA1D1E', '497BF3', '13A536', 'F6C230', '343434');
$rnd = rand(0,4);


if(isset($_REQUEST['fcolor']) && $_REQUEST['fcolor']!="")
{
  $fcolor=$_REQUEST['fcolor'];
}
else
{
  $fcolor = '000000'; //$c[$rnd];
}


if(isset($_REQUEST['bcolor']) && $_REQUEST['bcolor']!="")
{
  $bcolor=$_REQUEST['bcolor'];
}
else
{
  $bcolor = 'ff0000'; //$c[$rnd];
}


if(isset($_REQUEST['tcolor1']) && $_REQUEST['tcolor1']!="")
{
  $tcolor1=$_REQUEST['tcolor1'];
}
else
{
  $tcolor1 = 'ffffff'; //$c[$rnd];
}

if(isset($_REQUEST['tcolor2']) && $_REQUEST['tcolor2']!="")
{
  $tcolor2=$_REQUEST['tcolor2'];
}
else
{
  $tcolor2 = 'a19b9b'; //$c[$rnd];
}


if(isset($_REQUEST['dlicon']) && $_REQUEST['dlicon']!="")
{
  $dlicon=$_REQUEST['dlicon'];
}
else
{
  $dlicon = 'http://html5.svnlabs.com/html5plus/download.png'; //$c[$rnd];
}



if(isset($_REQUEST['dlpos']) && $_REQUEST['dlpos']!="")
{
  $dlpos=$_REQUEST['dlpos'];
}
else
{
  $dlpos = '10'; //$c[$rnd];
}




if($width<150)
 $width = '150';

if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
{
  $id=$_REQUEST['id'];
}
else
{
  $id = '0';  
}


if(isset($_REQUEST['host']) && $_REQUEST['host']!="")
{
  $host=$_REQUEST['host'];
  //add_host($host);
}
else
{
  $host = 'localhost';
}




?>



<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>js/jscolor.js"></script>

<?php //$mm = 2; ?>

<script type="text/javascript">
//var idno = <?php //echo $mm; ?>; // It start from id 2 

function addNewElement()
{
	// mainDiv is a variable to store the object of main area Div.
	var mainDiv = document.getElementById('more_element_area');
	// Create a new div 
	var innerDiv = document.createElement('div');
	// Set the attribute for created new div like here I am assigning Id attribure. 
	innerDiv.setAttribute('id', 'divId' + idno);
	// Create text node to insert in the created Div
	//var generatedContent = '<input type="text" name="new_element' + idno + '"	id="new_element' + idno + '" value="" />: <input type="text" size="70" name="new_element_' + idno + '"	id="new_element_' + idno + '" value="" />&nbsp;<a href="javascript:void(0)" onclick="return removeThisElement(' + idno + ')">Remove This</a>';
	
	var generatedContent = '<input type="checkbox" name="download[' + (idno-1) + ']" id="download' + idno + '" value="1" />&nbsp;<input type="text" name="title[]"	id="title' + idno + '" value="" placeholder="title" />&nbsp;<input type="text" name="artist[]"	id="artist' + idno + '" value="" placeholder="artist" />&nbsp;<input type="text" size="70" name="song[]"	id="song' + idno + '" value="" placeholder="mp3 song" />&nbsp;<input type="text" size="70" name="image[]"	id="image' + idno + '" value="" placeholder="image" />&nbsp;<a href="javascript:void(0)" onclick="return removeThisElement(' + idno + ')">Remove This</a><br><br><br>';
	
	
	// Inserting content to created Div by innerHtml
	innerDiv.innerHTML = generatedContent;
	// Appending this complete div to main div area.
	mainDiv.appendChild(innerDiv);
	// increment the id number by 1.
	idno++;
}

function removeThisElement(idnum)
{
	// mainDiv is a variable to store the object of main area Div.
	var mainDiv = document.getElementById('more_element_area');
	// get the div object with get Id to remove from main div area.
	var innerDiv = document.getElementById('divId' + idnum);
	// Removing element from main div area.
	mainDiv.removeChild(innerDiv);
 
}
</script>

<h2>Manage Playlist</h2>


<strong>HTML5 Video Player with Playlist&nbsp;<a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=html5video_add_playlist&action=update&id=0" style="background-color:#D84937; padding:5px; height:35px; color:#ffffff; font-weight:bold;">Add New</a></strong> <br /><br />



<?php if(!empty($isuccess)): ?>
        
<span style="color:green;"><?php echo $isuccess; ?></span>

<?php elseif(!empty($ierror)): ?>

<span style="color:red;"><?php echo $ierror; ?></span>
       
<?php endif ?>

<?php if($action=="preview") { ?>

<?php include("preview.php"); ?>

<?php } else { ?>

<table class="wp-list-table widefat fixed" cellspacing="0" style="margin-top:20px;">
	<thead>
	<tr>		
        <th scope="col" width="15%"><a href="#">Title</a></th>
        <th scope="col" width="5%" ><a href="#">Size</a></th>
        <th scope="col" width="20%"><a href="#">Description</a></th>
        <th scope="col" width="10%"><a href="#">Shortcode</a></th>
        <th scope="col" width="10%"><a href="#">Edit</a></th>	
        <th scope="col" width="10%"><a href="#">Delete</a></th>	
     </tr>
	</thead>

	<tfoot>
	<tr>
	    <th scope="col" width="15%"><a href="#">Title</a></th>
        <th scope="col" width="5%" ><a href="#">Size</a></th>
        <th scope="col" width="20%"><a href="#">Description</a></th>
        <th scope="col" width="10%"><a href="#">XML</a></th>
        <th scope="col" width="10%"><a href="#">Edit</a></th>	
        <th scope="col" width="10%"><a href="#">Delete</a></th>		
     </tr>
	</tfoot>

	<tbody id="the-list">
    
    <?php
		$sql		=	"SELECT * FROM $table";

		$results 	= 	$wpdb->get_results( $wpdb->prepare( $sql ) );
	?>
	<?php if( !empty( $results ) ) : ?>
    <?php foreach( $results as $result ): ?>
    <tr>
        <td><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=html5video_playlist&action=preview&id=<?php echo $result->id; ?>"><?php echo $result->title; ?></a></td>
        <td width="25%"><?php echo $result->size; ?></td>
        <td width="10%"><?php echo $result->description; ?></td>
        <td width="10%">[html5video id=<?php echo $result->id; ?>]</td>
        <td width="10%"><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=html5video_add_playlist&action=update&id=<?php echo $result->id; ?>">Update</a></td>
        <td width="10%"><a onclick="return confirm('Are you sure?')" href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=html5video_add_playlist&action=delete&id=<?php echo $result->id; ?>">Delete</a></td>
	</tr>
	<?php endforeach; ?>
	
	<?php else: ?>
    
    <td class="posts column-posts num" colspan="5"><a href="admin.php?page=html5video_add_playlist">Please add playlist</a></td>
    
	<?php endif; ?>
  	
  </tbody>
</table>   

<?php } ?>          
