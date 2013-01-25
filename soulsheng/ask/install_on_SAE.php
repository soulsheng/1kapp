<?php
/**
 * Author: tomheng
 * Blog: http://blog.webfuns.net
 * Created: 2012-02-24
 * URL: http://q2achina.sinaapp.com
 * 
 * 在SAE上的安装文件
 * 
 */
if (!defined('QA_BASE_DIR'))
	define('QA_BASE_DIR', dirname(empty ($_SERVER['SCRIPT_FILENAME']) ? dirname(__FILE__) : $_SERVER['SCRIPT_FILENAME']) . '/');
require QA_BASE_DIR . 'qa-include/qa-base.php';
require_once QA_INCLUDE_DIR . 'qa-db-install.php';
$check = qa_db_check_tables();
$notice = '';
$html = '<form name="f" id="af" method="POST"><table>';
$html .= '<input type="hidden" name="action" value="doinstall"/>';
$html .= '<tr><td class="label">网站名称：</td><td><input name="site_title"/></td></tr>';
$html .= '<tr><td class="label">管理员帐号：</td><td><input name="handle"/></td></tr>';
$html .= '<tr><td class="label">管理员密码：</td><td><input name="password"type="password"/></td></tr>';
$html .= '<tr><td class="label">管理员邮箱：</td><td><input name="email" /></td></tr>';
$html .= "<tr><td></td><td><a href='javascript:check_create_admin(f);' class='btn'>开始安装</a></td></tr>";
$html .= '</table></form>';
if ($check != 'none') {
	//deny access here
	$notice = 'Question2Answer问答系统已安装';
	$html = "<a href='" . qa_path_html('admin', null, null, QA_URL_FORMAT_SAFEST) . "' class='btn'>管理中心</a>";
	$html .= "<a class='btn' href='" . qa_path_html('admin', null, null, QA_URL_FORMAT_SAFEST) . "'>" . qa_opt('site_title') . "</a>";
} else
	if (@ $_POST['action'] == 'doinstall') {
		require_once QA_INCLUDE_DIR . 'qa-db-users.php';
		require_once QA_INCLUDE_DIR . 'qa-app-users-edit.php';

		$inemail = qa_post_text('email');
		$inpassword = qa_post_text('password');
		$inhandle = qa_post_text('handle');
		if (empty ($inhandle) || empty ($inpassword)) {
			$fielderrors = $notice = '帐号和密码不能为空';
		} else {
			qa_db_install_tables();
			$fielderrors = array_merge(qa_handle_email_filter($inhandle, $inemail), qa_password_validate($inpassword));
		}

		if (empty ($fielderrors)) {

			require_once QA_INCLUDE_DIR . 'qa-app-users.php';
			
			qa_opt('site_language', 'zh'); //设置默认语文中文
			$site_url = qa_opt('site_url');
			substr($site_url, -2) == '//' && qa_opt('site_url', substr($site_url, 0, strlen($site_url)-1)); //fixed
			isset($_POST['site_title']) && strlen($_POST['site_title']) && qa_opt('site_title', $_POST['site_title']);  
			$userid = qa_create_new_user($inemail, $inpassword, $inhandle, QA_USER_LEVEL_SUPER);
			qa_set_logged_in_user($userid, $inhandle);
			qa_set_option('feedback_email', $inemail);
			
			$notice = '成功安装Question2Answer问答系统';
			$html = "<a href='" . qa_path_html('admin', null, null, QA_URL_FORMAT_SAFEST) . "' class='btn'>管理中心</a>";
			$html .= "<a class='btn'  href='" . qa_path_html('admin', null, null, QA_URL_FORMAT_SAFEST) . "'>" . qa_opt('site_title') . "</a>";
		}

	}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>欢迎使用Question2Answer问答系统</title>
<style>
body{
	background: #CFD1C4;
	margin: 0;
	padding: 0;
	text-align: center;
	color: #333;
	font: 100%/1.5 serif;
	line-height: 18px;
}
a:hover {
	color: #005580;
	text-decoration: underline;
}
a:hover, a:active {
	outline: 0;
}
a {
	color: #08C;
	text-decoration: none;
}
p{
	margin: 0.6em 0 1em;
}

input{
	-webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,.05),0 1px 0 #fff;
        -moz-box-shadow: inset 0 1px 3px rgba(0,0,0,.05),0 1px 0 #fff;
        box-shadow: inset 0 1px 3px rgba(0,0,0,.05),0 1px 0 #fff;
 }
.main{
	width:700px;
	height:432px;
	background:#fff;
	margin:20px auto;
	border-radius:6px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	padding:10px 0px;
}
.header{
	height:140px;
	margin-top:20px;
}
.content{
	height:240px;
        text-align:center;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
        width:400px;
        margin:0px auto;
}
table th, table td {
	padding: 5px 10px;
	text-align:left;
}
td.label{
	text-align:right;
}

td.btn_box{
	text-align:center;
}
table th {
	background: #fbfbfb;
}
table thead th {
	background: #f1f1f1;
}
.footer{
}
h1{
	font: 1.8em Arial, sans-serif;
	padding:0px;
	margin:20px 0px;
}
.btn{
	display: inline-block;
	margin-bottom: 0;
	line-height: 18px;
	color: #333;
	text-align: center;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	vertical-align: middle;
	background-color: whiteSmoke;
	background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
	background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: linear-gradient(top, #ffffff, #e6e6e6);
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e6e6e6', GradientType=0);
	border-color: #E6E6E6 #E6E6E6 #BFBFBF;
	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
	border: 1px solid #CCC;
	border-bottom-color: #BBB;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
	font-size: 20px;
	font-weight: normal;
	padding: 14px 24px;
	margin-right: 10px;
}
.btn:active {
	background-image: none;
	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	background-color: #E6E6E6;
	background-color: #D9D9D9 9;
	outline: 0;
}
.btn:hover {
	color: #333;
	text-decoration: none;
	background-color: #E6E6E6;
	background-position: 0 -15px;
	-webkit-transition: background-position 0.1s linear;
	-moz-transition: background-position 0.1s linear;
	-ms-transition: background-position 0.1s linear;
	-o-transition: background-position 0.1s linear;
	transition: background-position 0.1s linear;
	}
	.btn:active, .btn.active {
	background-color: #CCC 9;
}
.and{
	color:#ccc;
	padding:0px 3px;
}
.dot{
	color:#ccc;
	padding:0px 10px;
}
#msg {
	background-color: lightYellow;
	border-color: #E6DB55;
	border-width: 1px;
	border-style: solid;
	padding: 12px;
	border-radius: ;
}
</style>
<script>
		function fadeOut(elem, speed, opacity){
			speed = speed || 20;
			opacity = opacity || 0;
			var val = 100;
			(function(){
				elem.filters ? elem.style.filter = 'alpha(opacity=' + val + ')' : elem.style.opacity = val / 100;
				val -= 5;
				if (val >= opacity) {
					setTimeout(arguments.callee, speed);
				}else if (val < 0) {
					elem.style.display = 'none';
				}
			})();
		}
		var ready = function(){
        	setTimeout(function(){
                  var msg = document.getElementById('msg');
                  fadeOut(msg);	
		}, 5000);
        	
        }
        
        if (window.addEventListener){
        	window.addEventListener("load", ready, false);
        }else if (window.attachEvent){
        	window.attachEvent("onload", ready);
        }else{
        	window.onload = ready;
        }
        
        String.prototype.trim = function() { 
                return this.replace(/^s+|s+$/, ''); 
        }
		function check_create_admin(f){
        	var h = f.handle.value.trim();
                var p = f.password.value.trim();
                var e = f.email.value.trim();
                var msg = null;
                if(h.length < 1){
                	msg = '帐号不能为空';
                }else if(p.length < 6){
                	msg = '密码不能少于6个字符';
                }else if( /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(e) == false){
                	msg = '邮箱格式不正确';
                }
          	if(null == msg){
          		f.submit();
                        return true;
                }
                alert(msg);
        }
</script>
</head>
<body>
<div class='main'>
	<div class='header'>
			<img src='http://question2answer.org/images/question2answer-logo-350x40.png' class='logo' alt='Question2Answer问答系统'/>
			<h1>欢迎使用Question2Answer问答系统</h1>
	</div>
	<div class='content'>
		<?php echo $html;?>
		<?php if(isset($notice) && strlen($notice))  echo "<p id='msg'>{$notice}</p>";?>
	</div>
	<div class='footer'>
			<p>Powered By <a href='http://question2answer.org' title='官方网站'>Question2Answer</a><span class='and'>&amp;</span><a href='http://sae.sina.com.cn' title='Sina App Engine'>SAE</a><span class='dot'> • </span>
			Tweaked By <a href='http://q2achina.sinaapp.com' title='获得关于Question2Answer中文帮助'>Question2Answer中文</a>
			</p>
	</div>

</div>
</body>
</html>