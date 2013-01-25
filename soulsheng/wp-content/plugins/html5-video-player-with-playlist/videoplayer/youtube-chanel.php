<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HTML5 VIDEO PLAYER</title>
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"></script>
<?php $theme = isset($_REQUEST['theme'])? $_REQUEST['theme'] : 'smoothness'; 
      $isvertical = isset($_REQUEST['playlistmod'])? $_REQUEST['playlistmod'] : 'true';?>
<link rel="stylesheet" href="jquery-ui/<?php echo $theme;?>/jquery-ui-1.8.18.custom.css">
<script type="text/javascript" src="player-compressed.js"></script>
<link rel="stylesheet" href="player.css">
<script type="text/javascript" src="template-compressed.js"></script>
<script type="text/javascript">
      $(function() {
        $("#html5player").html5player({
          width: '700px',
          height: '<?php echo $isvertical=='false' ? '600px' : '400px';?>',
		  vertical: <?php echo $isvertical;?>,
		  autoNext:true,
		  shuffle:false,
		  loop:false,
		  scrollMode: "", //"auto"
		  logo: "" // logo.png
        });
      });
    </script>
</head>
<body>
<form action="" method="post">
  <select name="theme" style="width:150px;">
    <?php

if ($handle = opendir('jquery-ui')) { 
     /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
	    if(is_dir($entry)) continue;
		$selected = $theme==$entry ? "selected" : "";
        echo '<option value="'.$entry.'" '.$selected.'>'.ucwords(str_replace("-"," ",$entry)).'</option>';
    }
    closedir($handle);
}
?>
  </select>
  <input name="Change Theme" type="submit" value="Change Theme">
</form>
<video id="html5player" src="http://www.youtube.com/watch?v=dTAAsCNK7RA"></video>
</body>
</html>
