<?php
/*
Template Name: 网址导航
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo trim(wp_title('',false)); ?><?php if(wp_title('', false)){echo '_'; } ?><?php bloginfo('name'); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/base.css" />
<?php wp_head(); ?>
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
<ul>
<form action="http://www.baidu.com/baidu" target="_blank">
<table bgcolor="#FFFFFF"><tr><td>
<input name=tn type=hidden value=baidu>
<a href="http://www.baidu.com/"><img src="http://img.baidu.com/img/logo-80px.gif" alt="Baidu" align="bottom" border="0"></a>
<input type=text name=word size=30>
<input type="submit" value="百度搜索">
</td></tr></table>
</form>
</ul>
</div>
<div id="hot">
<?php wp_nav_menu( array( 'theme_location' => 'nav001' ) ); ?>
</div>
<div id="content">
<div id="cate">
<b class="rc-tp"><b></b></b>
<div class="box">
	<?php if ( ! dynamic_sidebar( 'sidebar-lefttop' ) ) : ?>
	<?php endif; ?>
	<?php if ( ! dynamic_sidebar( 'sidebar-leftbottom' ) ) : ?>
	<?php endif; ?>
</div>	
<b class="rc-bt"><b></b></b>
</div>
<div id="main">
<div id="bm">
<ul class="clearfix"><li>名站导航</li></ul></div>
<div id="bb">
<div class="box">
    <div id="fm">
        <ul id="fmsite" class="clearfix">
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </ul>
    </div>
    <div id="qs-result" style="display:none;"></div>
</div>
</div>
<div id="hot2">
            <?php wp_nav_menu( array( 'theme_location' => 'nav002' ) ); ?> 
</div>
<div id="ls">
<b class="rc-tp"><b></b></b>
    <div class="box">
		<dl id="local" style="visibility:hidden;height: 20px;  line-height: 20px;">
        </dl>
	<?php if ( ! dynamic_sidebar( 'sidebar-main' ) ) : ?>
	<?php endif; ?>
	</div>
<b class="rc-bt"><b></b></b>
</div>
</div>
</div>
<div id="meta">
<b class="rc-tp"><b></b></b>
    <div class="box">
		<?php if ( ! dynamic_sidebar( 'sidebar-bottom' ) ) : ?>
		<?php endif; ?>
    </div>
</div>
    <div id="footer">
		<?php if ( ! dynamic_sidebar( 'sidebar-footer' ) ) : ?>
		<?php endif; ?>
    </div>
</div>
</body>
</html>