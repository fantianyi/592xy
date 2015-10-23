<?php
include_once('functions-s.php');
include_once('modules/s-widget.php');
include_once('modules/class-seo.php');
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
//SMTP邮箱设置
function mail_smtp( $phpmailer ){
$phpmailer->From = "slmwp.com";//请将slmwp.com替换成你的发件人地址
$phpmailer->FromName = "水冷眸博客";//请将‘水冷眸博客’替换成你的发件人昵称
$phpmailer->Host = "smtp.exmail.qq.com";//SMTP服务器地址，默认填了QQ的SMTP服务器地址，如果你的不是QQ邮箱，请自行替换
$phpmailer->Port = "25";//SMTP邮件发送端口, 常用端口有：25、465、587, 具体联系邮件服务商
$phpmailer->SMTPSecure = "";//SMTP加密方式(SSL/TLS)没有为空即可，具体联系邮件服务商, 以免设置错误, 无法正常发送邮件
$phpmailer->Username = "slmwp.com";//请将slmwp.com替换成你的邮箱帐号
$phpmailer->Password = "slmwp.com";//请将slmwp.com替换成你的密码
$phpmailer->IsSMTP();
$phpmailer->SMTPAuth = true;//启用SMTPAuth服务
}
add_action('phpmailer_init','mail_smtp');

//改用SSL镜像
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');
//正文内链添加nofollow
add_filter('the_content','go_url',999);
function go_url($content){
	preg_match_all('/href="(.*?)"/',$content,$matches);
	if($matches){
		foreach($matches[1] as $val){
			if( strpos($val,home_url())===false&&strpos($val,"javascript:void(0)")===false )
				$content=str_replace("href=\"$val\"", "rel=\"nofollow\" target=\"_blank\" href=\"".$val. "\"",$content);
		}
	}
	return $content;
}

//所有设置已完成，如果往后的代码非您手工添加，很可能是因为您的其它主题有恶意代码。


?>