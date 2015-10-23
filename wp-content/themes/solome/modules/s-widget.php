<?php 
/*
	Solome Widget 
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2015 水冷眸博客 - http://www.slmwp.com
	
		@package Solome
		@version 1.0
*/ 
if (function_exists('register_sidebar')){
	register_sidebar(array(
		'name'          => '全站侧栏',
		'id'            => 'widget_sitesidebar',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3 class="tm-title">',
		'after_title'   => '</h3></div>'
	));
	register_sidebar(array(
		'name'          => '首页侧栏',
		'id'            => 'widget_sidebar',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3 class="tm-title">',
		'after_title'   => '</h3></div>'
	));
	register_sidebar(array(
		'name'          => '分类/标签/搜索页侧栏',
		'id'            => 'widget_othersidebar',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3 class="tm-title">',
		'after_title'   => '</h3></div>'
	));
	register_sidebar(array(
		'name'          => '文章页/页面侧栏',
		'id'            => 'widget_postsidebar',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3 class="tm-title">',
		'after_title'   => '</h3></div>'
	));
	register_sidebar(array(
		'name'          => '页脚小工具',
		'id'            => 'widget_footer',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3 class="tm-title">',
		'after_title'   => '</h3></div>'
	));

}
//屏蔽多余默认小工具
function unregister_rss_widget(){
unregister_widget('WP_Widget_RSS');
unregister_widget('WP_Widget_Tag_Cloud');
unregister_widget('WP_Widget_Links');
}
add_action('widgets_init','unregister_rss_widget');
/*Solome-广告*/ 
add_action( 'widgets_init', 'plm_banners' );

function plm_banners() {
	register_widget( 'plm_banner' );
}

class plm_banner extends WP_Widget {
	function plm_banner() {
		$widget_ops = array( 'classname' => 'plm_banner', 'description' => '显示一个广告(包括富媒体)，或者是其它的html代码' );
		$this->WP_Widget( 'plm_banner', 'Solome-广告', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];

		echo $before_widget;
		echo '<div class="adhtml">'.$code.'</div>';
		echo $after_widget;
	}

	function form($instance) {
?>

<p>
  <label> 标题：
    <input id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 代码：
    <textarea id="<?php echo $this -> get_field_id('code'); ?>" name="<?php echo $this -> get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
  </label>
</p>
<?php
}
}





/*Solome-最新评论*/
add_action( 'widgets_init', 'solo_comments' );
function solo_comments() {
register_widget( 'solo_comment' );
}

class solo_comment extends WP_Widget {
function solo_comment() {
$widget_ops = array( 'classname' => 'solo_comment', 'description' => '显示网友最新评论（头像+名称+评论）' );
$this->WP_Widget( 'solo_comment', 'Solome-最新评论', $widget_ops, $control_ops );
}
function widget( $args, $instance ) {
extract( $args );

$title = apply_filters('widget_name', $instance['title']);
$limit = $instance['limit'];
$outer = $instance['outer'];
$outpost = $instance['outpost'];

$mo='';

echo $before_widget;
echo $before_title.$mo.$title.$after_title;
echo '<div class="new_comment tm-list-style2"><ul>';
echo mod_newcomments( $limit,$outpost,$outer );
echo '</ul></div>';
echo $after_widget;
}

function form($instance) {
?>
		<p>
			<label>
				标题：
				<input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input class="widefat" id="<?php echo $this -> get_field_id('limit'); ?>" name="<?php echo $this -> get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某用户ID：
				<input class="widefat" id="<?php echo $this -> get_field_id('outer'); ?>" name="<?php echo $this -> get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某文章ID：
				<input class="widefat" id="<?php echo $this -> get_field_id('outpost'); ?>" name="<?php echo $this -> get_field_name('outpost'); ?>" type="text" value="<?php echo $instance['outpost']; ?>" />
			</label>
		</p>

<?php
}
}

function mod_newcomments( $limit,$outpost,$outer ){
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='".$outpost."' AND user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
$comments = $wpdb->get_results($sql);
foreach ( $comments as $comment ) {
$output = convert_smilies($output);
$output .= '
<li>
    <span class="thumb">'.get_avatar( $comment, 56,"",$comment->comment_author).'</span>
	<span class="eye"><strong>'.strip_tags($comment->comment_author).'</strong>在《'.$comment->post_title . '》上发表评论：</span>
    <a href="'. get_permalink($comment->ID) .'#comment-' . $comment->comment_ID . '" title="《'.$comment->post_title . '》上的评论">'. strip_tags($comment->com_excerpt).'</a>
    </li>';
}

echo $output;
};


	/*Solome-友情链接*/

	class plmbookmark extends WP_Widget {

	function __construct(){
	parent::__construct(false,'Solome-友情链接',array( 'description' => 'PlayLM-双栏显示友情链接' ,'classname' => 'widget_links'));
	}

	function widget($args,$instance){
	extract($args);
	?>
		<?php echo $before_widget; ?>
        <?php
			if ($instance['title'])
				echo $before_title . $instance['title'] . $after_title;
 ?>
		<?php
		global $wpdb;
		$limit = $instance['links_num'];
		$orderby = $instance['links_orderby'];
		if ($orderby == 'rand') {$bookmarks = $wpdb -> get_results("SELECT * FROM $wpdb->links ORDER BY RAND() LIMIT $limit");
		} else {$bookmarks = $wpdb -> get_results("SELECT * FROM $wpdb->links ORDER BY $orderby DESC LIMIT $limit");
		}
		$i = 0;
		echo '<ul>';
		foreach ($bookmarks as $bookmark) {
			$r = fmod($i, 2);
			$i++;
			if ($r == 0) {
				echo '<li class="one-half"><a href="' . $bookmark -> link_url . '" title="' . $bookmark -> link_name . '" target="_blank">' . $bookmark -> link_name . '</a></li>';
			} else {
				echo '<li class="one-half last"><a href="' . $bookmark -> link_url . '" title="' . $bookmark -> link_name . '" target="_blank">' . $bookmark -> link_name . '</a></li>';
			}
		}
		echo '</ul>';
		?>
		<?php echo $after_widget; ?>

	<?php }

	function update($new,$old){
	$instance = $old;
	$instance['link_num'] = strip_tags($new['link_num']);
	$instance['links_orderby'] = strip_tags($new['links_orderby']);
	return $new;
	}

	function form($instance){
	$title = esc_attr($instance['title']);
	$num = absint($instance['links_num']);
	// Default widget settings
	$defaults = array(
	// Links
	'links_orderby' 	=> 'link_id',
	);
	$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p><label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e('标题：', 'Solome'); ?><input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this -> get_field_id('links_num'); ?>"><?php _e('数量：', 'Solome'); ?></label><input class="widefat" id="<?php echo $this -> get_field_id('links_num'); ?>" name="<?php echo $this -> get_field_name('links_num'); ?>" type="text"  value="<?php echo $num; ?>" /></p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this -> get_field_id("links_orderby"); ?>"><?php _e('排序：', 'Solome'); ?></label>
			<select style="width: 100%;" id="<?php echo $this -> get_field_id("links_orderby"); ?>" name="<?php echo $this -> get_field_name("links_orderby"); ?>">
			  <option value="link_id"<?php selected($instance["links_orderby"], "link_id"); ?>>ID</option>
			  <option value="link_name"<?php selected($instance["links_orderby"], "link_name"); ?>><?php _e('名称', 'Solome'); ?></option>
			  <option value="link_rating"<?php selected($instance["links_orderby"], "link_rating"); ?>><?php _e('评分', 'Solome'); ?></option>
			  <option value="rand"<?php selected($instance["links_orderby"], "rand"); ?>><?php _e('随机', 'Solome'); ?></option>
			</select>	
		</p>
	<?php
	}
	}

	if ( ! function_exists( 'plm_register_widget_bookmarks' ) ) {

	function plm_register_widget_bookmarks() {
	register_widget( 'plmbookmark' );
	}
	}
	add_action( 'widgets_init', 'plm_register_widget_bookmarks' );
	

	/*Solome-聚合文章*/
	add_action( 'widgets_init', 'solo_postlists' );

	function solo_postlists() {
	register_widget( 'solo_postlist' );
	}

	class solo_postlist extends WP_Widget {
	function solo_postlist() {
	$widget_ops = array( 'classname' => 'solo_postlist', 'description' => '图文展示（最新文章or热门文章or随机文章）' );
	$this->WP_Widget( 'solo_postlist', 'Solome-聚合文章', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
	extract( $args );

	$title        = apply_filters('widget_name', $instance['title']);
	$limit        = $instance['limit'];
	$cat          = $instance['cat'];
	$orderby      = $instance['orderby'];


	$mo='';
	$style='';

	echo $before_widget;
	echo $before_title.$mo.$title.$after_title;
	echo '<div class="widget tm-list-style2 widget_recent_entries tab-content"><ul>';
	echo solome_posts_list( $orderby,$limit,$cat,$img );
	echo '</ul></div>';
	echo $after_widget;
	}

	function form( $instance ) {
?>

<p>
  <label> 标题：
    <input style="width:100%;" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
  </label>
</p>
<p>
  <label> 排序：
    <select id="<?php echo $this -> get_field_id('orderby'); ?>" name="<?php echo $this -> get_field_name('orderby'); ?>" style="width:100%;">
      <option value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>>评论数</option>
      <option value="date" <?php selected('date', $instance['orderby']); ?>>发布时间</option>
      <option value="rand" <?php selected('rand', $instance['orderby']); ?>>随机</option>
    </select>
  </label>
</p>
<p>
  <label> 分类限制： <a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
    <input style="width:100%;" id="<?php echo $this -> get_field_id('cat'); ?>" name="<?php echo $this -> get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
  </label>
</p>
<p>
  <label> 显示数目：
    <input style="width:100%;" id="<?php echo $this -> get_field_id('limit'); ?>" name="<?php echo $this -> get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
  </label>
</p>

<?php
}
}

function solome_posts_list($orderby,$limit,$cat,$img) {
$args = array(
'order'            => DESC,
'cat'              => $cat,
'orderby'          => $orderby,
'showposts'        => $limit,
'caller_get_posts' => 1
);
query_posts($args);
while (have_posts()) : the_post();
?>
<!--范天毅：移除 thumbnail-->
<li><a href="<?php the_permalink();?>"><span class="thumb"><?php echo '<img src="' . s_thumbnail_src() . '" style="width:60px; height:60px" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';?></span><h3><?php the_title();?></h3><span class="eye"><i class="fa fa-eye"></i><?php echo getPostViews(get_the_ID()); ?>℃</span><span class="time"><i class="fa fa-clock-o"></i><?php the_time('Y-m-d');?></span></a></li>
<?php

endwhile; wp_reset_query();
}

/*Solome-赞助站长*/

class plmdonate extends WP_Widget {
/*  Widget
/* ------------------------------------ */
function __construct(){
parent::__construct(false,'Solome-赞助工具',array( 'description' => 'Solome-支付宝赞助收款小工具，包含手机支付二维码与PC POST方式付款' ,'classname' => 'widget_solomepay'));
}

function widget($args,$instance){
extract($args);
$title = apply_filters('widget_name', $instance['title']);
$alipay_title = $instance['alipay_title'];
$amount = $instance['amount'];
$alipay_email = $instance['alipay_email'];
$alipay_qr = $instance['alipay_qr'];
$alipay_qr_img = $instance['alipay_qr_img'];
$alipay_but_img = $instance['alipay_but_img'];
	?>
		<?php echo $before_widget; ?>
        <?php
			if ($instance['title'])
				echo $before_title . $instance['title'] . $after_title;
 ?>
		<div class="donate"><?php
			if ($alipay_qr_img == 'on') {echo '<img src="' . $alipay_qr . '" title="赞助站长" alt="赞助站长" />';
			}
		?><?php
		echo '<form id="alipay-gather" action="https://shenghuo.alipay.com/send/payment/fill.htm" method="POST" target="_blank" accept-charset="GBK">
        <input name="optEmail" type="hidden" value="' . $alipay_email . '" />
        <input name="payAmount" type="hidden" value="' . $amount . '" />
        <input id="title" name="title" type="hidden" value="' . $alipay_title . '" />
        <input name="memo" type="hidden" value="" />';
		if ($alipay_but_img == 'on') {echo '<input name="pay" type="image" value="赞助支持" src="https://img.alipay.com/sys/personalprod/style/mc/btn-index.png" />';
		} else {
			echo '<button name="pay" type="submit" class="tm-btn">赞助支持</button>';
		}

		echo '</form></div>';
	?>
		<?php echo $after_widget; ?>

	<?php }

	function update($new_instance,$old_instance){
	$instance = $old_instance;
	//数据处理
	$instance['title'] = strip_tags(stripslashes($new_instance['title']));
	$instance['alipay_title'] = strip_tags(stripslashes($new_instance['alipay_title']));
	$instance['amount'] = strip_tags(stripslashes($new_instance['amount']));
	$instance['alipay_email'] = strip_tags(stripslashes($new_instance['alipay_email']));
	$instance['alipay_qr'] = strip_tags(stripslashes($new_instance['alipay_qr']));
	$instance['alipay_qr_img'] = strip_tags(stripslashes($new_instance['alipay_qr_img']));
	$instance['alipay_but_img'] = strip_tags(stripslashes($new_instance['alipay_but_img']));
	//返回
	return $instance;
	}

	function form($instance){
	$instance = wp_parse_args((array)$instance,array(
	'title'=>'捐赠资助','alipay_title'=>'支持一下','amount'=>10
	));
	$title = esc_attr($instance['title']);
	$alipay_title = esc_attr($instance['alipay_title']);
	$amount = esc_attr($instance['amount']);
	$alipay_email = esc_attr($instance['alipay_email']);
	$alipay_qr = esc_attr($instance['alipay_qr']);
	$alipay_qr_img = esc_attr($instance['alipay_qr_img']);
	$alipay_but_img = esc_attr($instance['alipay_but_img']);
		?>
		<p><label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e('标题：', 'Solome'); ?><input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this -> get_field_id('alipay_title'); ?>"><?php _e('付款说明：', 'Solome'); ?></label><input class="widefat" id="<?php echo $this -> get_field_id('alipay_title'); ?>" name="<?php echo $this -> get_field_name('alipay_title'); ?>" type="text"  value="<?php echo $alipay_title; ?>" /></p>
        <p><label for="<?php echo $this -> get_field_id('amount'); ?>"><?php _e('默认金额：', 'Solome'); ?></label><input class="widefat" id="<?php echo $this -> get_field_id('amount'); ?>" name="<?php echo $this -> get_field_name('amount'); ?>" type="text"  value="<?php echo $amount; ?>" /></p>
        <p><label for="<?php echo $this -> get_field_id('alipay_email'); ?>"><?php _e('收款账户：', 'Solome'); ?></label><input class="widefat" id="<?php echo $this -> get_field_id('alipay_email'); ?>" name="<?php echo $this -> get_field_name('alipay_email'); ?>" type="text"  value="<?php echo $alipay_email; ?>" /></p>
        <p><label for="<?php echo $this -> get_field_id('alipay_qr'); ?>"><?php _e('支付宝收款二维码：', 'Solome'); ?></label><input class="widefat" id="<?php echo $this -> get_field_id('alipay_qr'); ?>" name="<?php echo $this -> get_field_name('alipay_qr'); ?>" type="text"  value="<?php echo $alipay_qr; ?>" /></p>
               <p>
  <label>
    <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked($instance['alipay_qr_img'], 'on'); ?> id="<?php echo $this -> get_field_id('alipay_qr_img'); ?>" name="<?php echo $this -> get_field_name('alipay_qr_img'); ?>">
    是否显示支付宝收款二维码？ </label>
</p>
<p>
  <label>
    <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked($instance['alipay_but_img'], 'on'); ?> id="<?php echo $this -> get_field_id('alipay_but_img'); ?>" name="<?php echo $this -> get_field_name('alipay_but_img'); ?>">
    捐赠按钮显示为图片？ </label>
</p>
	<?php
	}
	}
	add_action('widgets_init',create_function('', 'return register_widget("plmdonate");'));
	/*Solome-站点统计*/

	class plmsitestatistic extends WP_Widget {
	/*  Widget
	/* ------------------------------------ */
	function __construct(){
	parent::__construct(false,'Solome-站点统计',array( 'description' => 'Solome-站点统计' ,'classname' => 'widget_plmsitestatistic'));
	}

	function widget($args,$instance){
	extract($args);
	?>
		<?php echo $before_widget; ?>
        <?php
			if ($instance['title'])
				echo $before_title . $instance['title'] . $after_title;
 ?>
		<ul class="one-half">
			<?php
			global $wpdb;
 ?>
			<li><?php _e('日志总数：', 'Solome'); ?><span><?php $count_posts = wp_count_posts();
				echo $published_posts = $count_posts -> publish;
 ?></span> <?php _e(' 篇', 'Solome'); ?></li>
			<li><?php _e(' 评论总数：', 'Solome'); ?><span><?php echo $wpdb -> get_var("SELECT COUNT(*) FROM $wpdb->comments"); ?></span><?php _e(' 条', 'Solome'); ?></li>
			<li><?php _e('标签数量：', 'Solome'); ?><span><?php echo $count_tags = wp_count_terms('post_tag'); ?></span><?php _e(' 个', 'Solome'); ?></li>
            </ul><ul class="one-half last">
			<li><?php _e('友链总数：', 'Solome'); ?><span><?php $link = $wpdb -> get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'");
				echo $link;
 ?></span><?php _e(' 个', 'Solome'); ?></li>
			<li><?php _e('运行天数：', 'Solome'); ?><span><?php echo floor((time() - strtotime(s_opt('solo_jzdate'))) / 86400); ?></span><?php _e(' 天', 'Solome'); ?></li>
			<li><?php _e('最后更新：', 'Solome'); ?><span><?php $last = $wpdb -> get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
				$last = date('Y-n-j', strtotime($last[0] -> MAX_m));
				echo $last;
 ?></span></li>
		</ul>
        	
		<div class="clear"></div>	
		
		
		<?php echo $after_widget; ?>

	<?php }

	function update($new_instance,$old_instance){
	return $new_instance;
	}

	function form($instance){
	$title = esc_attr($instance['title']);
		?>
		<p><label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e('标题：', 'Solome'); ?><input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
	<?php
	}
	}
	add_action('widgets_init',create_function('', 'return register_widget("plmsitestatistic");'));



/*Soleme-标签云*/
add_action( 'widgets_init', 'solome_tags' );

function solome_tags() {
register_widget( 'solome_tag' );
}

class solome_tag extends WP_Widget {
function solome_tag() {
$widget_ops = array( 'classname' => 'widget_tag_cloud', 'description' => '最常使用的标签云。' );
$this->WP_Widget( 'solome_tag', 'Soleme-标签云', $widget_ops, $control_ops );
}

function widget( $args, $instance ) {
extract( $args );

$title = apply_filters('widget_name', $instance['title']);
$count = $instance['count'];
$offset = $instance['offset'];
$more = $instance['more'];
$link = $instance['link'];

$mo='';
if( $more!='' && $link!='' ) $mo='<a href="'.$link.'">'.$more.'</a>';

echo $before_widget;
echo $before_title.$mo.$title.$after_title;
echo '<div class="tagcloud">';
$tags_list = get_tags('orderby=count&order=DESC&number='.$count.'&offset='.$offset);
if ($tags_list) {
foreach($tags_list as $tag) {
echo '<a href="'.get_tag_link($tag).'" data-toggle="tooltip" data-placement="top" title="'. $tag->count .' 个相关话题" >'. $tag->name .' ('. $tag->count .')</a>';
}
}else{
echo '暂无标签！';
}
echo '</div>';
echo $after_widget;
}

function form($instance) {
?>

<p>
  <label> 名称：
    <input id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 显示数量：
    <input id="<?php echo $this -> get_field_id('count'); ?>" name="<?php echo $this -> get_field_name('count'); ?>" type="number" value="<?php echo $instance['count']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 去除前几个：
    <input id="<?php echo $this -> get_field_id('offset'); ?>" name="<?php echo $this -> get_field_name('offset'); ?>" type="number" value="<?php echo $instance['offset']; ?>" class="widefat" />
  </label>
</p>
<?php
}
}

/*Solome-特别推荐*/
add_action( 'widgets_init', 'e_textbanners' );

function e_textbanners() {
register_widget( 'e_textbanner' );
}

class e_textbanner extends WP_Widget {
function e_textbanner() {
$widget_ops = array( 'classname' => 'e_textbanner', 'description' => '显示一个文本特别推荐，或者是一个网站告示' );
$this->WP_Widget( 'e_textbanner', 'Solome-特别推荐', $widget_ops, $control_ops );
}

function widget( $args, $instance ) {
extract( $args );

$title = apply_filters('widget_name', $instance['title']);
$content = $instance['content'];
$link = $instance['link'];
$style = $instance['style'];
$blank = $instance['blank'];

$lank = '';
if( $blank ) $lank = ' target="_blank"';

echo $before_widget;
echo '<dd><a class="'.$style.'" href="'.$link.'"'.$lank.'>';
echo '<h2>'.$title.'</h2>';
echo '<p>'.$content.'</p>';
echo '</a></dd>';
echo $after_widget;
}

function form($instance) {
?>

<p>
  <label> 标题：
    <input id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 描述：
    <textarea id="<?php echo $this -> get_field_id('content'); ?>" name="<?php echo $this -> get_field_name('content'); ?>" class="widefat" rows="3"><?php echo $instance['content']; ?></textarea>
  </label>
</p>
<p>
  <label> 链接：
    <input style="width:100%;" id="<?php echo $this -> get_field_id('link'); ?>" name="<?php echo $this -> get_field_name('link'); ?>" type="url" value="<?php echo $instance['link']; ?>" size="24" />
  </label>
</p>
<p>
  <label> 样式：
    <select id="<?php echo $this -> get_field_id('style'); ?>" name="<?php echo $this -> get_field_name('style'); ?>" style="width:100%;">
      <option value="style01" <?php selected('style01', $instance['style']); ?>>蓝色</option>
      <option value="style02" <?php selected('style02', $instance['style']); ?>>橙色</option>
      <option value="style03" <?php selected('style03', $instance['style']); ?>>绿色</option>
      <option value="style04" <?php selected('style04', $instance['style']); ?>>紫色</option>
      <option value="style05" <?php selected('style05', $instance['style']); ?>>青色</option>
    </select>
  </label>
</p>
<p>
  <label>
    <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked($instance['blank'], 'on'); ?> id="<?php echo $this -> get_field_id('blank'); ?>" name="<?php echo $this -> get_field_name('blank'); ?>">
    新打开浏览器窗口 </label>
</p>
<?php
}
}
?>
