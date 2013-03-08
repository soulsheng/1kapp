<?php
/*
Plugin Name: Ludou Custom User Register
Plugin URI: http://www.ludou.org/wordpress-ludou-custom-user-register.html
Description: 修改默认的后台用户注册表单，用户可以自行输入密码，不必用Email接收密码，跳过Email验证。用户可自行选择注册的身份角色。带有验证码功能，防止恶意注册。
Version: 2.1.1
Author: Ludou
Author URI: http://www.ludou.org
*/

if (!isset($_SESSION)) {
 	session_start();
	session_regenerate_id(TRUE);
}

/**
 * 后台注册模块，添加注册表单,修改新用户通知。
 */
if ( !function_exists('wp_new_user_notification') ) :
/**
 * Notify the blog admin of a new user, normally via email.
 *
 * @since 2.0
 *
 * @param int $user_id User ID
 * @param string $plaintext_pass Optional. The user's plaintext password
 */
function wp_new_user_notification($user_id, $plaintext_pass = '', $flag='') {
	if(func_num_args() > 1 && $flag !== 1)
		return;

	$user = new WP_User($user_id);

	$user_login = stripslashes($user->user_login);
	$user_email = stripslashes($user->user_email);

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

	@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);
	
	if ( empty($plaintext_pass) )
		return;

	// 你可以在此修改发送给用户的注册通知Email
	$message  = sprintf(__('Username: %s'), $user_login) . "\r\n";
	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
	$message .= '登陆网址: ' . wp_login_url() . "\r\n";

	// sprintf(__('[%s] Your username and password'), $blogname) 为邮件标题
	wp_mail($user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);
}
endif;

/* 修改注册表单 */
function ludou_show_password_field() {
	define('LCR_PLUGIN_URL', plugin_dir_url( __FILE__ ));
?>
<style type="text/css">
<!--
#user_role {
  padding: 2px;
  -moz-border-radius: 4px 4px 4px 4px;
  border-style: solid;
  border-width: 1px;
  line-height: 15px;
}

#user_role option {
	padding: 2px;
}
-->
</style>
<p>
	<label for="user_nick">昵称<br/>
		<input id="user_nick" class="input" type="text" tabindex="20" size="25" value="<?php echo $_POST['user_nick']; ?>" name="user_nick" />
	</label>
</p>
<p>
	<label for="user_pwd1">密码(至少6位)<br/>
		<input id="user_pwd1" class="input" type="password" tabindex="21" size="25" value="<?php echo $_POST['user_pass']; ?>" name="user_pass" />
	</label>
</p>
<p>
	<label for="user_pwd2">重复密码<br/>
		<input id="user_pwd2" class="input" type="password" tabindex="22" size="25" value="<?php echo $_POST['user_pass2']; ?>" name="user_pass2" />
	</label>
</p>
<p style="margin:0 0 10px;">
	<label>用户身份:
		<select name="user_role" tabindex="23" id="user_role">
			<option value="subscriber" <?php if($_POST['user_role'] == 'subscriber') echo 'selected="selected"';?>>订阅者</option>
			<option value="contributor" <?php if($_POST['user_role'] == 'contributor') echo 'selected="selected"';?>>投稿者</option>
		</select>
	</label>
	<br />
</p>
<p>
	<label for="CAPTCHA">验证码:<br />
		<input id="CAPTCHA" style="width:110px;*float:left;" class="input" type="text" tabindex="24" size="10" value="" name="captcha_code" />
		看不清？<a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='<?php echo constant("LCR_PLUGIN_URL"); ?>/captcha/captcha.php?'+Math.random();document.getElementById('CAPTCHA').focus();return false;">点击更换</a>
	</label>
</p>
<p>
	<label>
	<img id="captcha_img" src="<?php echo constant("LCR_PLUGIN_URL"); ?>/captcha/captcha.php" title="看不清?点击更换" alt="看不清?点击更换" onclick="document.getElementById('captcha_img').src='<?php echo constant("LCR_PLUGIN_URL"); ?>/captcha/captcha.php?'+Math.random();document.getElementById('CAPTCHA').focus();return false;" />
	</label>
</p>
<?php
}

/* 处理表单提交的数据 */
function ludou_check_fields($login, $email, $errors) {
	if(empty($_POST['captcha_code'])
		|| empty($_SESSION['ludou_lcr_secretword'])
		|| (trim(strtolower($_POST['captcha_code'])) != $_SESSION['ludou_lcr_secretword'])
		) {
		$errors->add('captcha_spam', "<strong>错误</strong>：验证码不正确");
	}
	unset($_SESSION['ludou_lcr_secretword']);
	
	if (!isset($_POST['user_nick']) || trim($_POST['user_nick']) == '')
	  $errors->add('user_nick', "<strong>错误</strong>：昵称必须填写");
	  
	if(strlen($_POST['user_pass']) < 6)
		$errors->add('password_length', "<strong>错误</strong>：密码长度至少6位");
	elseif($_POST['user_pass'] != $_POST['user_pass2'])
		$errors->add('password_error', "<strong>错误</strong>：两次输入的密码必须一致");

	if($_POST['user_role'] != 'contributor' && $_POST['user_role'] != 'subscriber')
		$errors->add('role_error', "<strong>错误</strong>：不存在的用户身份");
}

/* 保存表单提交的数据 */
function ludou_register_extra_fields($user_id, $password="", $meta=array()) {
	$userdata = array();
	$userdata['ID'] = $user_id;
	$userdata['user_pass'] = $_POST['user_pass'];
	$userdata['role'] = $_POST['user_role'];
	$userdata['nickname'] = str_replace(array('<','>','&','"','\'','#','^','*','_','+','$','?','!'), '', $_POST['user_nick']);

	wp_new_user_notification( $user_id, $_POST['user_pass'], 1 );
	wp_update_user($userdata);
}

function remove_default_password_nag() {
	global $user_ID;
	delete_user_setting('default_password_nag', $user_ID);
	update_user_option($user_ID, 'default_password_nag', false, true);
}

add_action('admin_init', 'remove_default_password_nag');
add_action('register_form','ludou_show_password_field');
add_action('register_post','ludou_check_fields',10,3);
add_action('user_register', 'ludou_register_extra_fields');

?>