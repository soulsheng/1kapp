<?php
/*
	Theme URI: http://q2achina.sinaapp.com/sae_q2a_theme
	Theme Version: v1.0
	Theme Date: 2011-02-22
	Theme Author: Tomheng
	Theme Author URI: http://blog.webfuns.net
	Theme License: GPLv2
	Theme Update Check URI: http://q2achina.sinaapp.com/check/sae_q2a_theme
*/

/*
 * 默认主题
 * @author Tomheng
 * @date  2012-2-22
 */

class qa_html_theme extends qa_html_theme_base{
	
	/**
	 * 使用HTML5 DOCTYPE
	 * @see 2/qa-include/qa_html_theme_base::doctype()
	 */
	public function doctype(){
		$this->output('<!DOCTYPE HTML>');
	}
	
	public function css_name(){
			return str_replace(QA_BASE_DIR, '', QA_THEME_DIR).qa_get_site_theme().'/qa-styles.css';
	}
	
	/**
	 *合并压缩CSS 
	 */
	public function head_css(){
		$css_srcs = $this->css_name();
		if (isset($this->content['css_src'])){
			foreach ($this->content['css_src'] as $css_src){
				$css_srcs .= ','.$css_src;
			}
		}
		$src = qa_opt('site_url').$css_srcs.','.CSS_VERSION;
		$this->output('<LINK REL="stylesheet" TYPE="text/css" HREF="'.$src.'"/>');					
		if (!empty($this->content['notices']))
			$this->output(
				'<STYLE><!--',
				'.qa-body-js-on .qa-notice {display:none;}',
				'//--></STYLE>'
		);	
	}
	
	public function head_script(){
		@$this->content['body_footer'] .= "\n<!-- Tweaked by Question2Answer中文 - http://q2achina.sinaapp.com/ -->\n";
		if(FALSE === MINIFY_CSS_JS){
			return parent::head_script();
		}
		$cb_src = '';
		foreach ($this->content['script'] as $k => $v){
			if(0 == preg_match('/src\=[\'\"]?(https?\:\/\/.+\.js)/i', $v, $match)){
				continue;
			}
			$src = str_replace(qa_opt('site_url'), '', $match[1]);
			$cb_src .= (empty($cb_src) ? '' : ',').$src;
			unset($this->content['script'][$k]);
		}
		if(!empty($cb_src)){
			$cb_url = qa_opt('site_url').'cb/'.$cb_src.','.JS_VERSION;
			array_unshift($this->content['script'], "<script src='{$cb_url}'></script>");
		}
		$this->content['body_footer'] .= implode("\n", $this->content['script']);
	}
	
	public function attribution(){
		// Hi there. I'd really appreciate you displaying this link on your Q2A site. Thank you - Gideon
				
		$this->output(
			'<DIV CLASS="qa-attribution">',
			'Powered by <A HREF="http://www.question2answer.org/">Question2Answer</A>',
			'&nbsp;<span class="dim">&amp;</span>&nbsp;',
			'<a href="http://question2answer.webfuns.net">中文</a>',
				'</DIV>'
		);
	}
}