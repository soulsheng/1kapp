<?php 
//include_once("db.php"); 


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
  $host = 'html5.svnlabs.com';
}


?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="PHP Simple HTML DOM Parser CSS Selector">
<meta name="keywords" content="PHP Simple HTML DOM Parser CSS Selector">
<title>HTML5 Audio Player with Playlist | SVN Labs Softwares</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/ui.tabs.css" type="text/css" media="print, projection, screen">
<?php /*?><script src="js/jquery-1.4.4.min.js" type="text/javascript"></script><?php */?>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/ui.tabs.pack.js"></script>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$(function() {$('#container-1 > ul').tabs();});
	});
</script>


<script type="text/javascript" src="js/jscolor.js"></script>

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



</head>
<body>



<h1>HTML5 Audio Player with Playlist</h1>
<div id="content">
 
<br>
<br>
 
<div align="center"> 
 <?php //include("html5.php"); ?>
</div>   
<br>
   
  <h2>Quick Start</h2>
  
  <div id="container-1">
    <ul>
      <li><a href="#fragment-11"><span>Create Playlist</span></a></li>
      <li><a href="#fragment-12"><span>Customize Player</span></a></li>
      <li><a href="#fragment-13"><span>Get Player Widget</span></a></li>
      <li><a href="#fragment-14"><span>Help</span></a></li>
    </ul>
    
    <div id="fragment-11">
      <div class="code">
      <br>

      
      <?php include("formplus.php"); ?>
      
      </div>
    </div>
    
    <div id="fragment-12">
      <div class="code">
      
           
      <form name="html5frm" action="index.php?id=<?php echo $_REQUEST['id']; ?>#fragment-12" method="post">
      
      <table width="50%" border="0" cellspacing="3" cellpadding="3">
            <tr>
            
                               
            <td>Player Size:</td>
            <td><select name="size">
                    
                        <option value="small" <?php if($size=="small") { ?> selected="selected" <?php } ?>>Small Player - no playlist</option>
                        <option value="full" <?php if($size=="full") { ?> selected="selected" <?php } ?>>Full Player (Horizontal) - xml playlist</option>
                        <option value="big" <?php if($size=="big") { ?> selected="selected" <?php } ?>>Big Player (Vertical) - xml playlist</option>
                    
                    </select></td>
            
            </tr><tr>        
            
            
            <td>Title Scrolling:</td>
            <td><input type="checkbox" name="stitle"  value="1" <?php if(isset($stitle) && $stitle=='1') echo 'checked="checked"'; ?>  /></td>
            
            </tr><tr>
             
            <td>Width:</td>
            <td><input type="text" name="width"  value="<?=$width?>" style="width:30px;" />&nbsp;px</td>             
            
            
            </tr><tr>
            
            <td>Height:</td>
            <td><input type="text" name="height"  value="<?=$height?>" style="width:30px;" />&nbsp;px</td>
            
            </tr><tr>
            
            <td>Social Links:</td>
            <td><input type="checkbox" name="links"  value="1" <?php if(isset($links) && $links=='1') echo 'checked="checked"'; ?>  /></td>
            
            </tr><tr>
            
            <td>Frame Color:</td>
            <td>#&nbsp;<input class="color" name="fcolor" type="text" value="<?php echo $fcolor; ?>" /></td>
            
            </tr><tr>
            
            <td>Background Color:</td>
            <td>#&nbsp;<input class="color" name="bcolor" type="text" value="<?php echo $bcolor; ?>" /></td>
            
            
            </tr><tr>
            
            <td>Text Color:</td>
            <td>#&nbsp;<input class="color" name="tcolor1" type="text" value="<?php echo $tcolor1; ?>" />#&nbsp;<input class="color" name="tcolor2" type="text" value="<?php echo $tcolor2; ?>" /></td>
            
            
            
            </tr><tr>
            
            <td>Download Icon:</td>
            <td><input name="dlicon" type="text" value="<?php echo $dlicon; ?>" /></td>
            
            
            </tr><tr>
            
            <td>Download Icon Position:</td>
            <td><input name="dlpos" type="text" value="<?php echo $dlpos; ?>" /> (From Right)</td>
            
            
            
            
            </tr><tr>
            
            <td>&nbsp;</td>
            <td><input type="submit" name="go" value="Get widget" style="background-color:#D84937; height:35px; color:#ffffff; font-weight:bold;" /></td>
      
 
        </tr>
        </table>
        
        
        
   
   </form>
        
      </div>
    </div>
    
    <div id="fragment-13">
      <div class="code"> 
      
			<?php
            
            $url = 'http://html5.svnlabs.com/html5plus/html5.php?id='.$id.'&host='.$host.'&size='.$size.'&width='.$width.'&height='.$height.'&links='.$links.'&stitle='.$stitle.'&fcolor='.$fcolor.'&bcolor='.$bcolor.'&tcolor1='.$tcolor1.'&tcolor2='.$tcolor2.'&dlicon='.$dlicon.'&dlpos='.$dlpos;
            $uid = 'id="'.$id.'";';
            $w = 'width="'.$width.'";';
			$h = 'height="'.$height.'";';
            
            $cc = 'fcolor="'.$fcolor.'";';
			$bcc = 'bcolor="'.$bcolor.'";';
			$tcc1 = 'tcolor1="'.$tcolor1.'";';
			$tcc2 = 'tcolor2="'.$tcolor2.'";';
			$dlicon = 'dlicon="'.$dlicon.'";';
			$dlpos = 'dlpos="'.$dlpos.'";';
            $ll = 'links="'.$links.'";';
			$sl = 'stitle="'.$stitle.'";';
			$sz = 'size="'.$size.'";';
            
            
            $script = '<script type="text/javascript">'.$uid.$w.$h.$cc.$bcc.$tcc1.$tcc2.$dlicon.$dlpos.$ll.$sl.$sz.'</script><script type="text/javascript" src="http://html5.svnlabs.com/html5plus/html5.js"></script>';
            $iframe = '<iframe src="' . $url . '" frameborder="0" scrolling="no" height="'.$height.'" width="'.$width.'"></iframe>';
            
            ?>
            
            <?php //if(isset($_REQUEST['go']) && $_REQUEST['go']=="Get widget"){ ?>
            
            <table width="50%" border="0" cellspacing="3" cellpadding="3">
            <tr>
            
            
            <td><strong>JavaScript Widget</strong><br />
            <hr />
            <textarea cols="60" rows="10" onFocus="this.select();" style="border:1px dotted #343434" ><?php echo $script; ?></textarea></td>
            <td>
            
            <strong>iFrame Widget</strong><br />
            <hr />
            <textarea cols="60" rows="10" onFocus="this.select();" style="border:1px dotted #343434" ><?php echo $iframe; ?></textarea>
            
            </td>
            
            </tr>
            </table>
            
            <?php //} ?>
            <br />
                
                
      </div>
    </div>
    <div id="fragment-14">
      <div class="code">
        
        <a href="http://html5.svnlabs.com/faq/">FAQ - HTML5 MP3 Player with Playlist</a>
        
      </div>
    </div>
  </div>
   <br>
<br>

   
 
 
 
</body>
</html>
<!--$Rev: 48 $-->
