<?php

global $wpdb;
$table		=	$wpdb->prefix."html5video_playlist";


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
						
$isuccess	=	"Playlist deleted successfully ";						
						
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
	
	var generatedContent = '<input type="checkbox" name="download[' + (idno-1) + ']" id="download' + idno + '" value="1" />&nbsp;<input type="text" name="title[]"	id="title' + idno + '" value="" placeholder="title" />&nbsp;<input type="text" name="artist[]"	id="artist' + idno + '" value="" placeholder="artist" />&nbsp;<input type="text" size="70" name="song[]"	id="song' + idno + '" value="" placeholder="video" />&nbsp;<input type="text" size="70" name="image[]"	id="image' + idno + '" value="" placeholder="image" />&nbsp;<a href="javascript:void(0)" onclick="return removeThisElement(' + idno + ')">Remove This</a><br><br><br>';
	
	
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


<?php if(!empty($isuccess)): ?>
        
<span style="color:green;"><?php echo $isuccess; ?></span>

<?php elseif(!empty($ierror)): ?>

<span style="color:red;"><?php echo $ierror; ?></span>
       
<?php endif ?>


<?php if($action=='update'): ?>

<?php include("formplus.php"); ?>

<?php else:?>

<?php include("formplus.php"); ?>

<?php endif ?>
                
