<?php
/**
 * @package Themolio
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<base target="_blank">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title>
        <?php
            global $page, $paged, $themolio_options, $themolio_is_mobile;
            wp_title('|', true, 'right');
            bloginfo('name');
            $site_description = get_bloginfo('description', 'display');
            if ($site_description && (is_home() || is_front_page()))
                echo " | $site_description";
            if ($paged >= 2 || $page >= 2)
                echo ' | '.sprintf(__('Page %s', 'themolio'), max($paged, $page));
        ?>
    </title>
	<?php if($themolio_is_mobile): ?>
	<meta name="viewport" content="width=device-width, initial-scale=0.8" />
    <?php else: ?>
        <meta name="viewport" content="width=device-width" />
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header role="banner">
    <div class="wrapper">
    <table class="tablayout"><tr>
        <?php if(trim($themolio_options['custom_logo']) != ''): ?>
        <td class="tdleft" style="max-width:100px;max-height:130px;width:auto;padding-right:15px;">
            <a href="<?php echo home_url(); ?>"><img class="custom-logo" src="<?php echo $themolio_options['custom_logo']; ?>"/></a>
        </td>
        <?php endif; ?>
        <td class="tdleft" style="width:60%;">
            <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php if(trim(get_bloginfo('description')) != ''): ?>
            <p class="site-desc"><?php bloginfo('description'); ?></p>
            <?php endif; ?>
        </td>
        <?php if($themolio_options['show_search'] and !$themolio_is_mobile): ?>
        <td class="tdright" style="text-align:right;min-width:240px;">
            <?php get_search_form(); ?>
        </td>
        <?php endif; ?>
    </tr></table>
    </div>
</header> <!-- End of banner -->

<nav>
    <div class="wrapper">
        <?php if($themolio_is_mobile): ?>
            <?php themolio_pages_dropdown(); ?>
        <?php else: ?>
            <?php wp_nav_menu(array('theme_location' => 'primary', 'container_class' => 'main-menu clearfix')); ?>
        <?php endif; ?>
    </div>
</nav> <!-- End of dropdown menu -->

<div id="content"> <!-- Start of content -->
    <div class="wrapper"> <!-- Start of content wrapper -->