<?php
/*
 * Author	Tomheng
 * Blog  	http://blog.webfuns.net     
 * Created  Feb 16, 2012
 * 
 *
 */

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

class SAE_QA_Process{
 	public function init_page(){
 		//sae_xhprof_start();
 		PAGE_CACHE_ENABLE === TRUE  && qa_preload_cache_options(); 
 		TRUE === MINIFY_CSS_JS && check_combine_compress_request();
 		return TRUE;
 	}
 	
 	//public function shutdown($reason){
 		//sae_xhprof_end();
 	//}
 	
}

