<?php get_header();?>
<div id="tm-page-body">
  <div id="tm-single-blog" class="tm-container tm-wrap tm-sidebar-right">
    <div class="page-content">
      <?php while (have_posts()) : the_post();setPostViews(get_the_ID());?>
      <div class="page-content-inner">
        <div class="entry-header">
          <h2><?php the_title(); ?></h2>
          <div class="meta"> 
            <span><i class="fa fa-clock-o"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></span> 
            <?php if (s_opt('solo_comm_s')){?><span><i class="fa fa-comments-o"></i><?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?></span><?php }?> 
            <span><i class="fa fa-paw"></i><?php baidu_record(); ?></span> 
            <span><i class="fa fa-eye"></i><?php echo getPostViews(get_the_ID()); ?>℃</span> 
            <?php edit_post_link('<span class="editor"><i class="fa fa-edit"></i> 编辑</span>', '  ', '  '); ?>
            </div>
        </div>
        <?php echo s_opt('ads_03_s') ? '<div class="propaganda">'.s_opt('ads_02').'</div>' : '';?>
        <div class="entry-container">
          <div class="entry-content">
            <?php the_content();?>
          </div>
          
          <?php if( s_opt('solo_copyright_s') ){?><section id="z_s_s"><div class="social-main"><span class="like"><a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['solome_ding_'.$post->ID])) echo ' done';?>"><i class="fa fa-thumbs-up"></i>赞<i class="count"><?php if( get_post_meta($post->ID,'solome_ding',true) ){ echo get_post_meta($post->ID,'solome_ding',true); } else { echo '0'; }?></i></a></span><span class="shang-p"><a href="#pay_shang" id="shang-main-p">赏</a></span><?php solome_share(); ?><div class="clear"></div></div></section><?php }?>
         <?php if( s_opt('solo_author_s') ){ if ( wp_is_mobile() ){} else {?>
          <section class="about-author tm-style3">
            <div class="about-author-conteainer">
              <div class="avatar"> <?php echo get_avatar( get_the_author_email(), 100 ); ?> </div>
              <div class="author">
			  <span class="name"><?php the_author_posts_link(); ?></span>
              <span class="identity">博主</span>
              </div>
              <div class="description">
                <p><?php if(get_the_author_meta("description") != ""){the_author_meta("description");}else{echo "这货来去如风，什么鬼都没留下！！！";}?></p>
                 <?php echo '<span class="social-networks"><a href="'.s_opt('social_weibo').'" target="_blank" class="tm-btn red small" title="关注新浪微博"><i class="fa fa-weibo"></i> 新浪微博</a><a href="'.s_opt('social_tqq').'" target="_blank" class="tm-btn blue small" title="关注腾讯微博"><i class="fa fa-weibo"></i> 腾讯微博</a><a target="_blank" href="'.s_opt('social_qun').'" class="tm-btn orange small" title="'.s_opt('social_qun_tit').'"><i class="fa fa-users"></i> QQ交流群</a></span>';?>
              </div>
            </div>
          </section>
          <?php }}?>
          <?php echo s_opt('ads_04_s') ? '<div class="propaganda">'.s_opt('ads_04').'</div>' : '';?>
          <?php endwhile; ?>
          <?php comments_template('', true); ?>
          <?php echo s_opt('ads_05_s') ? '<div class="propaganda">'.s_opt('ads_05').'</div>' : '';?>
        </div>
      </div>
    </div>
    <?php get_sidebar()?>
  </div>
</div>
<?php get_footer();?>
