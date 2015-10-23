<!DOCTYPE html>
<html lang="zh">

<head>
    <meta property="qc:admins" content="10416642176512016367" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="solome by_slmwp - slmwp.com" />
    <?php include( 'modules/seo.php'); ?>
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/img/favicon.ico">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/font-awesome/font-awesome.css" />
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/solome.js"></script>
    <!--[if IE]>
		<script src="<?php bloginfo('template_url'); ?>/assets/js/html5shiv.js"></script>
		<![endif]-->
    <script>
        $(function() {
            $("img").lazyload({
                effect: "fadeIn"
            });
        });
    </script>
<style><?php echo s_opt('csscode')?></style>
<?php echo s_opt('headcode')?>
<?php wp_head();?>
</head>

<body>
    <header>
        <div id="tm-header-top">
            <div class="tm-wrap tm-table">
                <div class="tm-logo">
                    <a href="<?php bloginfo('url'); ?>" class="tm-logo-simple">
                        <img alt="<?php bloginfo('name'); ?>" src="<?php echo s_opt( 'logo_src'); ?>">
                    </a>
                </div>
                <nav class="tm-top-nav">
                    <?php if(has_nav_menu( 'topnav')){ wp_nav_menu( array( 'theme_location'=>'topnav', 'container' => '', ) ); } ?></nav>
                <div class="tm-search">
                    <form action="<?php bloginfo('home'); ?>" method="get">
                        <input type="text" autocomplete="off" placeholder="搜索..." name="s" id='s' class="tm-input">
                        <button role="button" type="submit" class="tm-button"><i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div id="tm-header-nav" class="tm-menu-style1 tm-sticky-menu">
            <div class="tm-wrap tm-table">
                <nav class="tm-nav">
                    <?php if(has_nav_menu( 'nav')){ wp_nav_menu( array( 'theme_location'=>'nav', 'container' => '', 'menu_class' => 'tm-menu tm-menu-simple', ) ); }else{ echo "
                    <ul class='tm-menu tm-menu-simple'>
                        <li><a href='".get_bloginfo(' url ')."/wp-admin/nav-menus.php'>还没有设置导航菜单，请到后台 外观->菜单 设置一个导航菜单</a>
                        </li>
                    </ul>"; } ?></nav>
                <div class="tm-social-icons">
                    <?php echo s_opt( 'social_qq_s') ? '<a href="http://wpa.qq.com/msgrd?v=3&uin='.s_opt( 'social_qq'). '&site=qq&menu=yes" target="_blank" class="tm-icon-qq" title="点击QQ联系"><i class="fa fa-qq"></i></a>' : '' ?>
                    <?php echo s_opt( 'social_weibo_s') ? '<a href="'.s_opt( 'social_weibo'). '" target="_blank" class="tm-icon-weibo" title="关注新浪微博"><i class="fa fa-weibo"></i></a>' : '' ?>
                    <?php echo s_opt( 'social_tqq_s') ? '<a href="'.s_opt( 'social_tqq'). '" target="_blank" class="tm-icon-tqq" title="关注腾讯微博"><i class="fa fa-pinterest-square"></i></a>' : '' ?>
                    <?php echo s_opt( 'social_wechat_s') ? '<a class="tm-icon-weixin"><i class="fa fa-weixin"></i></a>' : '' ?>
                    <?php echo s_opt( 'social_mail_s') ? '<a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email='.s_opt( 'social_mail'). '" target="_blank" class="tm-icon-email" title="点击发送邮件"><i class="fa fa-envelope-o fa-fw"></i></a>' : ''
                    ?>
                    <?php echo s_opt( 'social_qun_s') ? '<a target="_blank" href="'.s_opt( 'social_qun'). '" class="tm-icon-group" title="'.s_opt( 'social_qun_tit'). '"><i class="fa fa-users"></i></a>' : '' ?> 
                    <?php echo s_opt( 'social_feed_s') ? '<a href="'.s_opt('social_feed').'" class="tm-icon-rss" title="查看RSS"><i class="fa fa-rss"></i></a>' : '' ?>
                </div>
            </div>
        </div>
    </header>
    <?php if ( wp_is_mobile() ){ echo s_opt('adm_01_s') ? '<div class="propaganda">'.s_opt('adm_01').'</div>' : '';} ?>
