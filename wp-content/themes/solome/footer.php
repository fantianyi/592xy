<?php if ( wp_is_mobile() ){ echo s_opt('adm_02_s') ? '<div class="propaganda">'.s_opt('adm_02').'</div>' : '';}?>
<div style="background: url('<?php echo s_opt('foot_bgpic')?>') repeat; background-size: 100% 100%;">
<div id="tm-page-footer">
    <div class="tm-sidebar-footer">
        <div class="tm-wrap">
            <div class="tm-sidebar-footer-inner">
                <div class="tm-column tm6">
                    <aside class="widget footer_text">
                        <div class="textwidget"> 
                          <span class="footer-title"><?php bloginfo('name'); ?></span>
                            <p><?php echo s_opt('foot_text');?></p>
                        </div>
                    </aside>
                    <?php if(is_home()){?>
                    <aside class="widget widget_bookmarks">
                        <div class="bookmarks">
                            <ul>
                                <li class="link_title">友情链接：</li>
                                <?php wp_list_bookmarks( 'title_li=&categorize=0'); ?>
                            </ul>
                        </div>
                    </aside>
                    <?php }else {if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('widget_footer') ) : endif;} ?>
                </div>
                <div class="tm-column tm2">
                    <aside class="widget tm-list-style1">
                        <h2 class="tm-title"><?php echo s_opt('foot_nav_title')?></h2>
                        <?php if(has_nav_menu( 'footnav')){ wp_nav_menu( array( 'theme_location'=>'footnav', 'container' => '', ) ); } ?>
                    </aside>
                </div>
                <div class="tm-column tm4">
                    <aside class="widget widget_text">
                        <h3 class="tm-title">订阅本站，获取最新资讯</h3>
                        <div class="textwidget">
                            <form action="http://list.qq.com/cgi-bin/qf_compose_send" method="post" class="newsletter"> <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                <input type="hidden" name="t" value="qf_booked_feedback">
                                <input type="hidden" name="id" value="<?php s_opt('foot_maillistid');?>">
                                <input type="email" id="to" name="to" class="tm-input required" placeholder="输入你的邮箱订阅本站..." />
                                <button class="tm-button" type="submit" role="button">订阅</button>
                            </form>
                        </div>
                    </aside>
                    <aside class="widget widget_text">
                        <div class="textwidget">
                            <div class="payments">
                                <a href="http://www.slmwp.com/go/qun.html" target="_blank" title="加入水冷眸&主题交流反馈群"><img alt="img" src="<?php bloginfo('template_url'); ?>/assets/img/ico_group.png"></a>
                                <a href="http://www.slmwp.com/go/aliyun.html" target="_blank" title="水冷眸博客基于阿里云构建"><img alt="img" src="<?php bloginfo('template_url'); ?>/assets/img/ico_aliyun.png"></a>
                                <a href="http://www.slmwp.com/go/qcloud.html" target="_blank" title="部分资源采用七牛云存储进行加速"><img alt="img" src="<?php bloginfo('template_url'); ?>/assets/img/ico_qiniu.png"></a>
                                <a id="pinganVerify"></a>
                                <script type="text/javascript" src="http://apply.trustutn.org/show?type=2&sn=788150507013195893641"></script>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="tm-wrap tm-table">
        <div class="copyright">
            <p>Copyright &copy;
                <?php echo date( 'Y'); ?>
                <a href="<?php bloginfo('url'); ?>">
                    <?php bloginfo( 'name'); ?>
                </a>All rights reserved. <?php echo s_opt('foot_copy')?></p>
        </div>
        <div class="tm-other">	<span><?php echo s_opt('solo_icp')?> </span>
            <span><?php echo s_opt('trackcode')?> </span>
            <span>Theme BY <a href="http://www.slmwp.com" target="_blank">水冷眸</a></span>
        </div>
    </div>
</footer>
</div>

<a href="#" id="tm-gotop"> <i class="fa fa-chevron-up"></i> </a>
<?php wp_footer(); ?>
<script>
<?php if ( is_single() || is_page()) { ?>
$('#shang-main-p').jBox('Tooltip', {
    content: '<img src="<?php echo s_opt('pay_img')?>" />',
    closeOnMouseleave: true
});
$('#share-main-s').jBox('Tooltip', {
    content: '<div class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a><a href="#" class="bds_mail" data-cmd="mail" title="分享到邮件分享"></a><a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a></div>',
    closeOnMouseleave: true
});<?php } ?>
$('a.tm-icon-weixin').jBox('Tooltip', {
	title: '<center>关注&quot;<?php echo s_opt( 'social_wechat')?>&quot;微信</center>',
    content: '<img src="<?php echo s_opt('social_wechat_qr')?>" />',
    closeOnMouseleave: true
});
new jBox('Image');
$('.tm-social-icons > a').jBox('Tooltip', {closeOnMouseleave: true});
$('.payments > a').jBox('Tooltip', {closeOnMouseleave: true});
<?php if(s_opt('sideroll_s')){?>
jQuery(document).ready(function(a){var c=<?php echo s_opt('sideroll_n_1')?>,d=<?php echo s_opt('sideroll_n_2')?>;(e=a(".page-sidebar").width(),f=a(".page-sidebar aside"),g=f.length,g>=(c>0)&&g>=(d>0)&&a(window).scroll(function(){var b=document.documentElement.scrollTop+document.body.scrollTop;b>f.eq(g-1).offset().top+f.eq(g-1).height()?0==a(".roller").length?(f.parent().append('<div class="roller"></div>'),f.eq(c-1).clone().appendTo(".roller"),c!==d&&f.eq(d-1).clone().appendTo(".roller"),a(".roller").css({position:"fixed",top:62,zIndex:0,width:360}),a(".roller").width(e)):a(".roller").fadeIn(300):a(".roller").fadeOut(300)}))});<?php }?>
</script>
<?php if ( wp_is_mobile() ){ echo s_opt('adm_03_s') ? ''.s_opt('adm_03_s').'' : '';}else {echo s_opt('ads_06_s') ? ''.s_opt('ads_06').'' : '';} ?>
</body>
</html>