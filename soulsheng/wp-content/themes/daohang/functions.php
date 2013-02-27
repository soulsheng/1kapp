<?php
//隐藏admin Bar
function hide_admin_bar($flag) {
return false;
}
add_filter('show_admin_bar','hide_admin_bar');
if (function_exists('register_nav_menus')){
    register_nav_menus(	
	array(	
    'primary' => __( '名站导航', 'daohang' ),
	'nav001' => '搜索下热门',	
	'nav002' => '名站导航下热门',
	'nav003' => '底部导航一',
	'nav004' => '底部导航二',
	'nav005' => '底部导航三',
	'nav006' => '菜单六',
	'nav007' => '菜单七',
	'nav008' => '菜单八',
	'nav009' => '菜单九'
	)
	);
}
add_theme_support( 'nav-menus' );
?>
<?php
function daohang_widgets_init() {

	register_sidebar( array(
		'name' => __( '首页左侧网址区上部(多种小工具)', 'daohang' ),
		'id' => 'sidebar-lefttop',
		'description' => __( '说明：链接名称请使用四个汉字以内，否则会自动隐藏超出部分。', 'daohang' ),		
		'before_widget' => '<div id="%2$s" class="%2$s widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( '首页左侧网址区下部(链接小工具)', 'daohang' ),
		'id' => 'sidebar-leftbottom',
		'description' => __( '说明：链接名称请使用三个汉字以内。', 'daohang' ),		
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( '首页主体网址区(链接小工具)', 'daohang' ),
		'id' => 'sidebar-main',
		'description' => __( '首页主体网址区(链接小工具)', 'daohang' ),
		'before_widget' => '<div class="site">',
		'after_widget' => "</div>",
		'before_title' => '<h4><a>',
		'after_title' => '</a></h4>',
	) );

	register_sidebar( array(
		'name' => __( '首页底部网址区(链接小工具)', 'daohang' ),
		'id' => 'sidebar-bottom',
		'description' => __( '首页底部网址区(链接小工具)', 'daohang' ),
		'before_widget' => '<div class="fsite">',
		'after_widget' => "</div>",
		'before_title' => '<h4><a>',
		'after_title' => '</a></h4>',
	) );
	
	register_sidebar( array(
		'name' => __( '全站底部版权区(文本小工具)', 'daohang' ),
		'id' => 'sidebar-footer',
		'description' => __( '底部版权区，支持html代码', 'daohang' ),		
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 style="display:none;" class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'daohang_widgets_init' );
?>