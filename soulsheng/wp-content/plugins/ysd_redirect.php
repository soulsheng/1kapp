<?php
/*
Plugin Name: 云商店访问域名设置
Plugin URI: http://www.yunshangdian.com
Description: 可以设置访问二级域名跳转到一级域名
Author:luofei614
Version: 1.0
Author URI: http://weibo.com/luofei614
*/
add_action('admin_menu','ysd_redirect_menu');
function ysd_redirect_menu(){
    if(function_exists('add_options_page'))
        add_options_page('访问域名设置','访问域名设置','administrator','ysd_redirect','ysd_redirect_display');
}

function ysd_redirect_display()
{
   if(isset($_POST['ysd_redirect']))
   {
       update_option('ysd_redirect',$_POST['ysd_redirect']);

           //更新你添加的数据库
?>
     <div id="message" class="updated">保存成功!</div>
<?php
   }

?>
  <div class="wrap">
  <?php screen_icon(); //显示图标  ?>
  <h2>访问域名设置</h2>
  <p>在这里设置需要调整到的一级域名，如果为空表示不进行跳转.</p>
  <form action="" method="post">
  <h3>
  <label>输入你的一级域名:</label>
  <input type="text" id="ysd_redirect" name="ysd_redirect" value="<?php  echo esc_attr(get_option('ysd_redirect')); ?>"  />
  </h3>
  <p>
  <input type="submit" name="submit" value="保存" />
  </p>

  </form>
  </div>
<?php
}
add_action('init','ysd_redirect');

function ysd_redirect(){
    if(defined('WP_USE_THEMES') && ($domain=get_option('ysd_redirect'))){
        if('http'!=strtolower(substr($domain, 0,4))) $domain='http://'.$domain;
        $url_info=parse_url($domain);
        if($_SERVER['HTTP_HOST']==$url_info['host']) return ;
        if(!empty($_SERVER['QUERY_STRING'])) $domain.="?".$_SERVER['QUERY_STRING'];
        header('location:'.$domain);
        exit();
    }
}