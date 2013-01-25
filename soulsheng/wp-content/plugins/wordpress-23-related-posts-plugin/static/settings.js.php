<script type="text/javascript">
	function wp_no_rp_onchange(){
		var wp_no_rp = document.getElementById('wp_no_rp');
		var wp_no_rp_title = document.getElementById('wp_no_rp_title');
		var wp_no_rp_text = document.getElementById('wp_no_rp_text');
		switch(wp_no_rp.value){
		case 'text':
			wp_no_rp_title.innerHTML = '<?php _e("No Related Posts Text:",'wp_related_posts'); ?>';
			wp_no_rp_text.value = '<?php _e("No Related Posts",'wp_related_posts'); ?>';
			break;
		case 'random':
			wp_no_rp_title.innerHTML = '<?php _e("Random Posts Title:",'wp_related_posts'); ?>';
			wp_no_rp_text.value = '<?php _e("Random Posts",'wp_related_posts'); ?>';
			break;
		case 'commented':
			wp_no_rp_title.innerHTML = '<?php _e("Most Commented Posts Title:",'wp_related_posts'); ?>';
			wp_no_rp_text.value = '<?php _e("Most Commented Posts",'wp_related_posts'); ?>';
			break;
		case 'popularity':
			wp_no_rp_title.innerHTML = '<?php _e("Most Popular Posts Title:",'wp_related_posts'); ?>';
			wp_no_rp_text.value = '<?php _e("Most Popular Posts",'wp_related_posts'); ?>';
			break;
		default:
			wp_no_rp_title.innerHTML = '';
		}
		if(wp_no_rp.value == '<?php echo $wp_no_rp;?>'){
			wp_no_rp_text.value = '<?php echo $wp_rp["wp_no_rp_text"];?>';
		}
	}
	function wp_rp_except_onclick(){
		var wp_rp_except = document.getElementById('wp_rp_except');
		var wp_rp_except_number_label = document.getElementById('wp_rp_except_number_label');
		if(wp_rp_except.checked){
			wp_rp_except_number_label.style.display = '';
		} else {
			wp_rp_except_number_label.style.display = 'none';
		}
	}
	function wp_rp_thumbnail_onclick(){
		var wp_rp_thumbnail = document.getElementById('wp_rp_thumbnail');
		var wp_rp_thumbnail_span = document.getElementById('wp_rp_thumbnail_span');
		if(wp_rp_thumbnail.checked){
			wp_rp_thumbnail_span.style.display = '';
		} else {
			wp_rp_thumbnail_span.style.display = 'none';
		}
	}
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34712447-1']);
  _gaq.push(['_trackPageview']);

  _gaq.push(['_trackEvent', 'wp_related_posts', 'settings_loaded_wp_version', '<?=get_bloginfo('version');?>', 0, true]);
  _gaq.push(['_trackEvent', 'wp_related_posts', 'settings_loaded_wp_language', '<?=get_bloginfo('language');?>', 0, true]);
  _gaq.push(['_trackEvent', 'wp_related_posts', 'settings_loaded_wp_plugin_version', '<?php $plugin_data = get_plugin_data(__FILE__); echo $plugin_data['Version'];?>', 0, true]);

  (function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
