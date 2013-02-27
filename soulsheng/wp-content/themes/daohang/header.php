<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo trim(wp_title('',false)); ?><?php if(wp_title('', false)){echo '_'; } ?><?php bloginfo('name'); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/base.css" />
<base target="_blank" />
</head>
<body screen_capture_injected="true">
<div style="display:none;"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></div>
<div id="wrap">
<div id="header">
        <div class="box clearfix">
			<h1 id="title"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<div id="tagline"><?php bloginfo('description'); ?></div>
        </div>
        <b class="rc-bt"><b></b></b>
</div>
<div id="search">

<div id="hot">
<?php wp_nav_menu( array( 'theme_location' => 'nav001' ) ); ?>
</div>