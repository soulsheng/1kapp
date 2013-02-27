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