<?php
add_action('after_setup_theme', 'solo_setup');
function solo_setup() {
	//去除头部冗余代码
	remove_filter('the_content', array($GLOBALS['wp_embed'], 'autoembed'), 8);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head','adjacent_posts_rel_link_wp_head',10, 0);
	add_filter('xmlrpc_enabled', '__return_false');
	add_theme_support('custom-background');
	//隐藏admin Bar
	add_filter('show_admin_bar', 'hide_admin_bar');
	//评论回复邮件通知
	add_action('comment_post', 'comment_mail_notify');
	//默认表情添加nofollow
	add_filter('wp_tag_cloud', 'tag_cloud_nofollow');
	//评论表情改造
	add_filter('smilies_src', 'solo_smilies_src', 1, 10);
	//去除自带js
	wp_deregister_script('l10n');
	//修改默认发信地址
	add_filter('wp_mail_from', 'solo_res_from_email');
	add_filter('wp_mail_from_name', 'solo_res_from_name');
	add_action('pre_ping', 'solo_noself_ping');
	add_filter('pre_option_link_manager_enabled', '__return_true');
	//定义菜单
	if (function_exists('register_nav_menus')) {
		register_nav_menus(array('nav' => __('网站导航'), 'pagemenu' => __('页面导航'), 'topnav' => __('顶部导航'),'footnav' => __('底部菜单'), ));
	}
}
//移除菜单的多余CSS选择器
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}
//移除登陆后默认顶栏
function hide_admin_bar($flag) {
	return false;
}
//修改默认发信地址
function solo_res_from_email($email) {
	$wp_from_email = get_option('admin_email');
	return $wp_from_email;
}
function solo_res_from_name($email){
	$wp_from_name = get_option('blogname');
	return $wp_from_name;
}
//阻止站内文章Pingback 
function solo_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
//禁止加载默认jq库
if ( !is_admin() ) { // 后台不禁止
function my_init_method() {
wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
}
add_action('init', 'my_init_method');
}
// 移除前后台谷歌字体
if (!function_exists('remove_wp_open_sans')) : 
function remove_wp_open_sans() { 
wp_deregister_style( 'open-sans' ); 
wp_register_style( 'open-sans', false ); 
}
// 前台删除Google字体CSS 
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
// 后台删除Google字体CSS 
add_action('admin_enqueue_scripts', 'remove_wp_open_sans'); 
endif;
/* 移除自动保存 */
function tin_disable_autosave() {
  wp_deregister_script('autosave');
}
/* 搜索结果排除所有页面 */
function search_filter_page($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','search_filter_page');
/* 后台编辑器强化 */
function add_more_buttons($buttons){  
	$buttons[] = 'fontsizeselect';  
	$buttons[] = 'styleselect';  
	$buttons[] = 'fontselect';  
	$buttons[] = 'hr';  
	$buttons[] = 'sub';  
	$buttons[] = 'sup';  
	$buttons[] = 'cleanup';  
	$buttons[] = 'image';  
	$buttons[] = 'code';  
	$buttons[] = 'media';  
	$buttons[] = 'backcolor';  
	$buttons[] = 'visualaid';  
	return $buttons;  
}  
add_filter("mce_buttons_3", "add_more_buttons");
//取消内容转义 
remove_filter('the_content', 'wptexturize');
/* 后台编辑器文本模式添加短代码快捷输入按钮 */
function my_quicktags() {
    wp_enqueue_script('my_quicktags',get_stylesheet_directory_uri().'/assets/js/my_quicktags.js',array('quicktags'));
}
add_action('admin_print_scripts', 'my_quicktags');
//新窗口打开
function solo_blank(){
return s_opt('target_blank') ? ' target="_blank"' : '';}
/* WordPress文字标签关键词自动内链 */
$match_num_from = 1;		//一篇文章中同一個標籤少於幾次不自動鏈接
$match_num_to = 4;		//一篇文章中同一個標籤最多自動鏈接幾次
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
function solo_tag_link($content){
	global $match_num_from,$match_num_to;
		$posttags = get_the_tags();
		if ($posttags) {
			usort($posttags, "tag_sort");
			$ex_word = '';
			$case = '';
			foreach($posttags as $tag) {
				$link = get_tag_link($tag->term_id);
				$keyword = $tag->name;
				$cleankeyword = stripslashes($keyword);
				$url = "<a href=\"$link\" class=\"tooltip-trigger\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('查看更多关于 %s 的文章'))."\"";
				$url .= ' target="_blank"';
				$url .= ">".addcslashes($cleankeyword, '$')."</a>";
				$limit = rand($match_num_from,$match_num_to);
				$content = preg_replace( '|(<a[^>]+>)(.*)<pre.*?>('.$ex_word.')(.*)<\/pre>(</a[^>]*>)|U'.$case, '$1$2$4$5', $content);
				$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2$4$5', $content);
				$cleankeyword = preg_quote($cleankeyword,'\'');
				$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
				$content = preg_replace($regEx,$url,$content,$limit);
				$content = str_replace( '', stripslashes($ex_word), $content);
			}
		}
	return $content;
}
add_filter('the_content','solo_tag_link',12);
/* 高亮显示搜索关键词 */
function search_word_replace($buffer){
	if(is_search()){
		$arr=explode(' ',get_search_query());
		foreach($arr as $v){
			if($v)$buffer=preg_replace('/('.$v.')/i',"<span style='color:#f00;font-weight:bold'>$1</span>",$buffer);
		}
	}
	return $buffer;
}
/* 中文名图片上传改名 */
function tin_custom_upload_name($file){
	if(preg_match('/[一-龥]/u',$file['name'])):
	$ext=ltrim(strrchr($file['name'],'.'),'.');
	$file['name']=preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])).'_'.date('Y-m-d_H-i-s').'.'.$ext;
	endif;
	return $file;
}
add_filter('wp_handle_upload_prefilter','tin_custom_upload_name',5,1);
/*SEO设置*/
function seo_post($post_id) {
	global $post;
	$description = get_post_meta($post_id, 'description_value', true);
	$keywords = get_post_meta($post_id, 'keywords_value', true);
	if (empty($description)) {
		if (preg_match('/<p>(.*)<\/p>/iU', trim(strip_tags($post -> post_content, "<p>")), $result)) {
			$post_content = $result['1'];
		} else {
			$post_content_r = explode("\n", trim(strip_tags($post -> post_content)));
			$post_content = $post_content_r['0'];
		}
		$description = utf8Substr($post_content, 0, 220);
		update_post_meta($post_id, "description_value", $description);
	}
	if (empty($keywords)) {
		$post_type = $post -> post_type;
		if ($post_type == 'post') {
			$tax = 'post_tag';
		}
		$tags = wp_get_object_terms($post_id, $tax);
		foreach ($tags as $tag) {
			$keywords = $keywords . $tag -> name . ",";
		}
		update_post_meta($post_id, "keywords_value", $keywords);
	}
}

add_action('save_post', 'seo_post');
function deletehtml($description) {
	$description = trim($description);
	$description = strip_tags($description, "");
	return ($description);
}

add_filter('category_description', 'deletehtml');
function utf8Substr($str, $from, $len) {
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' . '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s', '$1', $str);
}

/*SEO设置结束*/
// 添加特色图像功能
add_theme_support('post-thumbnails');
set_post_thumbnail_size(260, 170, true);
// 图片宽度与高度
if (function_exists('add_theme_support'))
	add_theme_support('post-thumbnails');
function s_thumbnail_src() {
	global $post;
	if ($values = get_post_custom_values("thumb")) {
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values[0];
	} elseif (has_post_thumbnail()) {
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post -> ID), 'full');
		$post_thumbnail_src = $thumbnail_src[0];
	} else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post -> post_content, $matches);
		$post_thumbnail_src = $matches[1][0];
		if (empty($post_thumbnail_src)) {
			$random = mt_rand(1, 12);
			echo get_template_directory_uri() . '/assets/img/random/rp' . $random . '.jpg';
		}
	}
	;
	echo $post_thumbnail_src;
}

//定义缩略图—（普通）
/*function s_thumbnail($timthumb_w, $timthumb_h) {
	echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '"><img src="' . get_template_directory_uri() . '/timthumb.php?src=';
	echo s_thumbnail_src();
	echo '&h=' . $timthumb_h . '&w=' . $timthumb_w . '&zc=1" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';

	echo '</a>';
}
/* 范天毅：移除timthumb
 */
function s_thumbnail($timthumb_w, $timthumb_h) {
    echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
    echo '<img src="';
    echo s_thumbnail_src();
    echo '" style="width:' . $timthumb_w . 'px; height:' . $timthumb_h . 'px" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
    echo '</a>';
}
function h_thumbnail($timthumb_w, $timthumb_h) {
    echo '<a ' . solo_blank() . ' href="' . get_permalink() . '" title="' . get_the_title() . '">';
    echo '<h3>' . get_the_title() . '</h3>';
    echo '<img src="';
    echo s_thumbnail_src();
    echo '" style="width:' . $timthumb_w . 'px; height:' . $timthumb_h . 'px" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
    echo '</a>';
}
/* 定义摘要字数*/
function custom_excerpt_length($length) {
	return 120;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);
/* 摘要去除短代码
 /* ----------------- */
function excerpt_delete_shortcode($excerpt) {
	$r = "'\[button(.*?)+\](.*?)\[\/button]|\[toggle(.*?)+\](.*?)\[\/toggle]|\[callout(.*?)+\](.*?)\[\/callout]|\[infobg(.*?)+\](.*?)\[\/infobg]|\[tinl2v(.*?)+\](.*?)\[\/tinl2v]|\[tinr2v(.*?)+\](.*?)\[\/tinr2v]|\<pre(.*?)+\>(.*?)\<\/pre>|\[php(.*?)+\](.*?)\[\/php]|\[PHP(.*?)+\](.*?)\[\/PHP]'";
	return preg_replace($r, '', $excerpt);
}

add_filter('the_excerpt', 'excerpt_delete_shortcode', 999);

/* 替换摘要后more字样
 /* -------------------- */
function new_excerpt_more($more) {
	global $post;
	return '...<a'.solo_blank().' rel="nofollow" class="more-link" href="' . get_permalink($post -> ID) . '">Read more »</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

function add_nofollow_to_link($link) {
	return str_replace('<a', '<a rel="nofollow"', $link);
}

add_filter('the_content_more_link', 'add_nofollow_to_link', 0);

/* 去除摘要P标签包裹 */
remove_filter('the_excerpt', 'wpautop');

/* 改变正文P标签包裹优先级 */
remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 12);

/* 在文本小工具不自动添加P标签 */
add_filter('widget_text', 'shortcode_unautop');
/* 时间显示多少前*/
function timeago($ptime) {
	$ptime = strtotime($ptime);
	$etime = time() - $ptime;
	if ($etime < 1)
		return '刚刚';
	$interval = array(12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $ptime) . ')', 30 * 24 * 60 * 60 => '个月前 (' . date('m-d', $ptime) . ')', 7 * 24 * 60 * 60 => '周前 (' . date('m-d', $ptime) . ')', 24 * 60 * 60 => '天前', 60 * 60 => '小时前', 60 => '分钟前', 1 => '秒前');
	foreach ($interval as $secs => $str) {
		$d = $etime / $secs;
		if ($d >= 1) {
			$r = round($d);
			return $r . $str;
		}
	};
}
//版权信息
function solo_copyright() {
 echo '<i class="fa fa-exclamation-circle"></i>'.s_opt('solo_copyright_title').'<br>
       <i class="fa fa-bold"></i>本文标题：<a title="'.get_the_title().'" href="'.get_permalink().'" rel="nofollow">'.get_the_title().'</a><br>
	   <i class="fa fa-chain"></i>本文永久链接地址：<a title="'.get_the_title().'" href="'.get_permalink().'" rel="nofollow">'.get_permalink().'</a>';
}
/* 浏览量*/
function getPostViews($postID){
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return " 0 ";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
       $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/* 分页*/
function pagination($query_string) {
	global $posts_per_page, $paged;
	$my_query = new WP_Query($query_string . "&posts_per_page=-1");
	$total_posts = $my_query -> post_count;
	if (empty($paged))
		$paged = 1;
	$prev = $paged - 1;
	$next = $paged + 1;
	$range = 3;
	// only edit this if you want to show more page-links
	$showitems = ($range * 2) + 1;

	$pages = ceil($total_posts / $posts_per_page);
	if (1 != $pages) {
		echo "<div class='tm-paginator' style='margin:20px 0'>";

		echo($paged > 1 && $showitems < $pages) ? "<a class='prev page-numbers' href='" . get_pagenum_link($prev) . "'>上一页</a>" : "";

		for ($i = 1; $i <= $pages; $i++) {
			if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				echo($paged == $i) ? "<span class='page-numbers current'>" . $i . "</span>" : "<a class='page-numbers' href='" . get_pagenum_link($i) . "' >" . $i . "</a>";
			}
		}

		echo($paged < $pages && $showitems < $pages) ? "<a class='next page-numbers' href='" . get_pagenum_link($next) . "'>下一页</a>" : "";
		echo($paged > 2 && $paged + $range + 1 > $pages && $showitems < $pages) ? "<a class='up page-numbers' title='跳转到首页' href='" . get_pagenum_link(1) . "'>最前</a>" : "";
		echo($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) ? "<a class='down page-numbers' title='跳转到末页' href='" . get_pagenum_link($pages) . "'>最后</a>" : "";
		echo "</div>\n";
	}
}

/* 相关阅读*/
function hui_posts_related($title = '相关阅读', $limit = 8) {
	global $post;
	$exclude_id = $post -> ID;
	$posttags = get_the_tags();
	$i = 0;
	echo '<section class="tm-recent-post"><h3 class="tm-title">' . $title . '</h3><div class="tm-container tm-wrap tm-blog-style-list tm-sidebar-right"><div class="tm-featured"><ul class="tm-col-5 hot">';
	if ($posttags) {
		$tags = '';
		foreach ($posttags as $tag)
			$tags .= $tag -> name . ',';
		$args = array('post_status' => 'publish', 'tag_slug__in' => explode(',', $tags), 'post__not_in' => explode(',', $exclude_id), 'caller_get_posts' => 1, 'orderby' => 'comment_date', 'posts_per_page' => $limit);
		query_posts($args);
		while (have_posts()) { the_post();
		    
		    // 范天毅：移除timthumb
	        echo '<li>';
            h_thumbnail(180, 240);    
	        echo '</li>';

			$exclude_id .= ',' . $post -> ID;
			$i++;
		};
		wp_reset_query();
	}
	if ($i < $limit) {
		$cats = '';
		foreach (get_the_category() as $cat)
			$cats .= $cat -> cat_ID . ',';
		$args = array('category__in' => explode(',', $cats), 'post__not_in' => explode(',', $exclude_id), 'caller_get_posts' => 1, 'orderby' => 'comment_date', 'posts_per_page' => $limit - $i);
		query_posts($args);
		while (have_posts()) { the_post();
		    // 范天毅：移除timthumb
	        echo '<li>';
            h_thumbnail(180, 240);    
	        echo '</li>';
		
			$i++;
		};
		wp_reset_query();
	}
	echo '</ul></div></div><div class="clear"></div></section>';
}
/*百度收录*/
function baidu_check($url){
    global $wpdb;
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $baidu_record  = get_post_meta($post_id,'baidu_record',true);
    if( $baidu_record != 1){
        $url='http://www.baidu.com/s?wd='.$url;
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $rs=curl_exec($curl);
        curl_close($curl);
        if(!strpos($rs,'没有找到')){
            if( $baidu_record == 0){
                update_post_meta($post_id, 'baidu_record', 1);
            } else {
                add_post_meta($post_id, 'baidu_record', 1, true);
            }    
                return 1;
        } else {
            if( $baidu_record == false){
                add_post_meta($post_id, 'baidu_record', 0, true);
            }    
            return 0;
        }
    } else {
       return 1;
    }
}
function baidu_record() {
    if(baidu_check(get_permalink()) == 1) {
        echo '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd='.get_the_title().'">已收录</a>';
   } else {
        echo '<a style="color:red;" rel="external nofollow" title="点击提交，谢谢您！" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename='.get_permalink().'">未收录</a>';
   }
}
/*点赞*/
add_action('wp_ajax_nopriv_solome_like', 'solome_like');
add_action('wp_ajax_solome_like', 'solome_like');
function solome_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $bigfa_raters = get_post_meta($id,'solome_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('solome_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
        update_post_meta($id, 'solome_ding', 1);
    } 
    else {
            update_post_meta($id, 'solome_ding', ($bigfa_raters + 1));
        }
   
    echo get_post_meta($id,'solome_ding',true);
    
    } 
    
    die;
}
//baidu分享

function solome_share(){
  echo '<span class="share-s"><a id="share-main-s"><i class="fa fa-share-alt"></i> 分享</a></span>';
}


//评论列表
function solo_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$comorder =  get_option('comment_order');
	if($comorder == 'asc'){
		global $commentcount;
		if(!$commentcount) { 
			$page = get_query_var('cpage')-1;
			$cpp=get_option('comments_per_page');
			$commentcount = $cpp * $page;
		}
	}else{
		global $commentcount,$wpdb, $post;
		if(!$commentcount) {
			$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
			$cnt = count($comments);
			$page = get_query_var('cpage');
			$cpp=get_option('comments_per_page');
			if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
				$commentcount = $cnt + 1;
			} else {$commentcount = $cpp * $page + 1;}
		}
	}
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
			<?php $add_below = 'div-comment'; ?>
			<div class="comment-author vcard">
				<?php echo '<img class="avatar" src="'.get_template_directory_uri() . '/assets/img/a-load.gif" alt="avatar" data-original="' . preg_replace(array('/^.+(src=)(\"|\')/i', '/(\"|\')\sclass=(\"|\').+$/i'), array('', ''), get_avatar( $comment, '54' )) . '" />'; ?>
				<div class="floor">
					<?php
					if($comorder == 'asc'){
						if(!$parent_id = $comment->comment_parent){printf('%1$s#', ++$commentcount);}
					}else{
						if(!$parent_id = $comment->comment_parent){printf('%1$s#', --$commentcount);}
					}
					?>
				</div>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<span><?php _e('首次冒泡需要审核，请耐心等待 ...','cmp') ?></span>
				<br />
			<?php endif; ?>
			<?php comment_text(); ?>
			<div class="clear"></div>
            <span class="comment_author"><?php comment_author_link() ?></span>
			<span class="datetime">于<?php comment_date('Y-m-d') ?> <?php comment_time() ?> 评论</span>
            <span class="comm_vip"><?php if($comment->user_id=='1')echo'<img src="'.get_bloginfo('template_directory').'/assets/img/master.png" title="博主">'; echo get_author_class($comment->comment_author_email,$comment->user_id);?></span>
			<span class="reply"><?php edit_comment_link(__('编辑','cmp'),'&nbsp;&nbsp;',''); ?><?php comment_reply_link(array_merge( $args, array('reply_text' => __('回复','cmp'), 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
		</div>
		<?php
	}
	function solo_end_comment() {echo '</li>';}
//获取访客VIP样式  
function get_author_class($comment_author_email,$user_id){  
global $wpdb;  
$author_count = count($wpdb->get_results(  
"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));  
$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) return;  
if($author_count>=1 && $author_count<3)  
echo '<a class="vip1" title="评论达人 LV.1"></a>';  
else if($author_count>=3 && $author_count<5)   
echo '<a class="vip2" title="评论达人 LV.2"></a>';  
else if($author_count>=5 && $author_count<10)  
echo '<a class="vip3" title="评论达人 LV.3"></a>';   
else if($author_count>=10 && $author_count<20)   
echo '<a class="vip4" title="评论达人 LV.4"></a>';   
else if($author_count>=20 &&$author_count<50)   
echo '<a class="vip5" title="评论达人 LV.5"></a>';   
else if($author_count>=50 && $author_count<100)   
echo '<a class="vip6" title="评论达人 LV.6"></a>';   
else if($author_count>=100)   
echo '<a class="vip7" title="评论达人 LV.7"></a>';   
}
//评论添加表情
function wp_smilies() {
	global $wpsmiliestrans;
	if ( !get_option('use_smilies') or (empty($wpsmiliestrans))) return;
	$smilies = array_unique($wpsmiliestrans);
	$link='';
	foreach ($smilies as $key => $smile) {
		$file = get_template_directory_uri() . '/assets/img/smilies/'.$smile;
		$value = " ".$key." ";
		$img = "<img src=\"{$file}\" alt=\"{$smile}\" />";
		$imglink = htmlspecialchars($img);
		$link .= "<a href=\"#commentform\" title=\"{$smile}\" onclick=\"document.getElementById('comment').value += '{$value}'\">{$img}</a>&nbsp;";
	}
	echo '<div id="smilelink">'.$link.'</div>';
}
    //图片添加alt属性
    function image_alt( $imgalt ){
            global $post;
            $title = $post->post_title;
            $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
            if(preg_match_all("/$imgUrl/siU",$imgalt,$matches,PREG_SET_ORDER)){
                    if( !empty($matches) ){
                            for ($i=0; $i < count($matches); $i++){
                                    $tag = $url = $matches[$i][0];
                                    $judge = '/alt=/';
                                    preg_match($judge,$tag,$match,PREG_OFFSET_CAPTURE);
                                    if( count($match) < 1 )
                                    $altURL = ' alt="'.$title.'" ';
                                    $url = rtrim($url,'>');
                                    $url .= $altURL.'>';
                                    $imgalt = str_replace($tag,$url,$imgalt);
                            }
                    }
            }
            return $imgalt;
    }
    add_filter( 'the_content','image_alt'); 
	
if(get_option('upload_path')=='wp-content/uploads' || get_option('upload_path')==null) {
	update_option('upload_path',WP_CONTENT_DIR.'/uploads');
}

function disable_emoji9s_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
//修改评论表情调用路径
function solo_smilies_src ($img_src, $img, $siteurl){
	return get_template_directory_uri() . '/assets/img/smilies/'.$img;
}
//返回当前主题下img\smilies\下表情图片路径
function custom_smilie9s_src( $old, $img ) {
    return get_template_directory_uri() . '/assets/img/smilies/'.$img;
}

function init_smilie9s(){
	global $wpsmiliestrans;
	//默认表情文本与表情图片的对应关系(可自定义修改)
	$wpsmiliestrans=array(':mrgreen:'=>'icon_mrgreen.gif',':neutral:'=>'icon_neutral.gif',':twisted:'=>'icon_twisted.gif',':arrow:'=>'icon_arrow.gif',':shock:'=>'icon_eek.gif',':smile:'=>'icon_smile.gif',':???:'=>'icon_confused.gif',':cool:'=>'icon_cool.gif',':evil:'=>'icon_evil.gif',':grin:'=>'icon_biggrin.gif',':idea:'=>'icon_idea.gif',':oops:'=>'icon_redface.gif',':razz:'=>'icon_razz.gif',':roll:'=>'icon_rolleyes.gif',':wink:'=>'icon_wink.gif',':cry:'=>'icon_cry.gif',':eek:'=>'icon_surprised.gif',':lol:'=>'icon_lol.gif',':mad:'=>'icon_mad.gif',':sad:'=>'icon_sad.gif','8-)'=>'icon_cool.gif','8-O'=>'icon_eek.gif',':-('=>'icon_sad.gif',':-)'=>'icon_smile.gif',':-?'=>'icon_confused.gif',':-D'=>'icon_biggrin.gif',':-P'=>'icon_razz.gif',':-o'=>'icon_surprised.gif',':-x'=>'icon_mad.gif',':-|'=>'icon_neutral.gif',';-)'=>'icon_wink.gif','8O'=>'icon_eek.gif',':('=>'icon_sad.gif',':)'=>'icon_smile.gif',':?'=>'icon_confused.gif',':D'=>'icon_biggrin.gif',':P'=>'icon_razz.gif',':o'=>'icon_surprised.gif',':x'=>'icon_mad.gif',':|'=>'icon_neutral.gif',';)'=>'icon_wink.gif',':!:'=>'icon_exclaim.gif',':?:'=>'icon_question.gif',);
	//移除WordPress4.2版本更新所带来的Emoji前后台钩子同时挂上主题自带的表情路径
	remove_action( 'wp_head' , 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts' , 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles' , 'print_emoji_styles' );
	remove_action( 'admin_print_styles' , 'print_emoji_styles' );
	remove_filter( 'the_content_feed' , 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss' , 'wp_staticize_emoji' );
	remove_filter( 'wp_mail' , 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins' , 'disable_emoji9s_tinymce' );

	add_filter( 'smilies_src' , 'custom_smilie9s_src' , 10 , 2 );
}

add_action( 'init', 'init_smilie9s', 5 );

add_filter ('the_content', 'lazyload');
function lazyload($content) {
    $loadimg_url=get_template_directory_uri() . '/assets/img/loading.gif';
    if(!is_feed()||!is_robots) {
        $content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-original=\"\$2\" src=\"$loadimg_url\"\$3>\n<noscript>\$0</noscript>",$content);
    }
    return $content;
}
//灯箱
//fancybox 自动对图片链接添加rel=fancybox属性
add_filter('the_content', 'pirobox_gall_replace');
function pirobox_gall_replace ($content){
global $post;
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
$replacement = '<a$1href=$2$3.$4$5 data-lightbox="example-set"$6>$7</a>';
$content = preg_replace($pattern, $replacement, $content);
return $content;
}

/* 邮件通知 */
 function comment_mail_notify($comment_id) {
     $comment = get_comment($comment_id);//根据id获取这条评论相关数据
     $content=$comment->comment_content;
     //对评论内容进行匹配
     $match_count=preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si',$content,$matchs);
     if($match_count>0){//如果匹配到了
         foreach($matchs[1] as $parent_id){//对每个子匹配都进行邮件发送操作
             SimPaled_send_email($parent_id,$comment);
         }
     }elseif($comment->comment_parent!='0'){//以防万一，有人故意删了@回复，还可以通过查找父级评论id来确定邮件发送对象
         $parent_id=$comment->comment_parent;
         SimPaled_send_email($parent_id,$comment);
     }else return;
 }

 function SimPaled_send_email($parent_id,$comment){//发送邮件的函数 by Qiqiboy.com
     $admin_email = get_bloginfo ('admin_email');//管理员邮箱
     $parent_comment=get_comment($parent_id);//获取被回复人（或叫父级评论）相关信息
     $author_email=$comment->comment_author_email;//评论人邮箱
     $to = trim($parent_comment->comment_author_email);//被回复人邮箱
     $spam_confirmed = $comment->comment_approved;
     if ($spam_confirmed != 'spam' && $to != $admin_email && $to != $author_email) {
         $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
         $subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';
         $message = '<div style="background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;">
             <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
             <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
             . trim(get_comment($parent_id)->comment_content) . '</p>
             <p>' . trim($comment->comment_author) . ' 给你的回复:<br />'
             . trim($comment->comment_content) . '<br /></p>
             <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id,array("type" => "all"))) . '">查看回复的完整內容</a></p>
             <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
             <p>(此邮件有系统自动发出, 请勿回复.)</p></div>';
         $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
         $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
         wp_mail( $to, $subject, $message, $headers );
     }
 }
 
//添加钮Download
function DownloadUrl($atts, $content = null) {
	extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a href="'.$href.'" class="button button-rounded button-reveal button-large button-red tright" target="_blank" rel="nofollow"><i class="fa fa-cloud-download"></i><span>'.$content.'</span></a>';
	}
add_shortcode("dl", "DownloadUrl");
//添加钮Demo
function DemoUrl($atts, $content=null) {
   extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="dl" href="'.$href.'" target="_blank" rel="nofollow"><i class="fa fa-external-link"></i>'.$content.'</a>';
}
add_shortcode('dm' , 'DemoUrl' );
//编辑器添加框架按钮
function GenerateIframe( $atts ) {
    extract( shortcode_atts( array(
        'href' => '',
        'height' => '650px',
        'width' => '700px',
    ), $atts ) );

    return '<iframe src="'.$href.'" width="'.$width.'" height="'.$height.'"> <p>您的浏览器不支持框架</p></iframe>';
}
add_shortcode('iframe', 'GenerateIframe');
/*红色提醒框*/
function toa($atts, $content=null){return '<div class="tm-alert error">'.$content.'<a class="close" href="javascript:void(0)"><i class="fa fa-times"></i></a></div>';}
add_shortcode('v_error','toa');
/*黑色提醒框*/
function toc($atts, $content=null){return '<div class="tm-alert notice">'.$content.'<a class="close" href="javascript:void(0)"><i class="fa fa-times"></i></a></div>';}
add_shortcode('v_warn','toc');
/*绿色提醒框*/
function tob($atts, $content=null){return '<div class="tm-alert info">'.$content.'<a class="close" href="javascript:void(0)"><i class="fa fa-times"></i></a></div>';}
add_shortcode('v_tips','tob');
/*蓝色提醒框*/
function tod($atts, $content=null){return '<div class="tm-alert success">'.$content.'<a class="close" href="javascript:void(0)"><i class="fa fa-times"></i></a></div>';}
add_shortcode('v_blue','tod');
/*蓝色文本框*/
function toe($atts, $content=null){return '<div class="tm-alert success">'.$content.'</div>';}
add_shortcode('v_act','toe');
/*黑色文本框*/
function tof($atts, $content=null){return '<div class="tm-alert notice">'.$content.'</div>';}
add_shortcode('v_hei','tof');
/*绿色文本框*/
function tog($atts, $content=null){return '<div class="tm-alert info">'.$content.'</div>';}
add_shortcode('v_qing','tog');
/*红色文本框*/
function toh($atts, $content=null){return '<div class="tm-alert error">'.$content.'</div>';}
add_shortcode('v_red','toh');
/*绿色按钮*/
function tow($atts, $content=null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<a class="tm-btn small" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';}
add_shortcode('gb' , 'tow' );
/*蓝色按钮*/
function tor($atts, $content=null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<a class="tm-btn blue small" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';}
add_shortcode('bb' , 'tor' );
/*黄色按钮*/
function top($atts, $content=null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<a class="tm-btn orange small" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';}
add_shortcode('yb' , 'top' );
/*黑色按钮*/
function toq($atts, $content=null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<a class="tm-btn linedark small" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';}
add_shortcode('hb' , 'toq' );
/*粉色按钮*/
function tos($atts, $content=null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<a class="tm-btn red small" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';}
add_shortcode('fb' , 'tos' );
/*浅蓝按钮*/
function tot($atts, $content=null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<a class="tm-btn lightblue small" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';}
add_shortcode('qlb' , 'tot' );
//为WordPress添加展开收缩功能
function xcollapse($atts, $content = null){extract(shortcode_atts(array("title"=>""),$atts));return '<div id="accordion"><div class="link accordion-title">点击可以展开查看历史记录 <i class="fa fa-chevron-right"></i></div>
		<div class="acc_cont" style="display:none">
			'.$content.'
		</div>
  </div>
';}
add_shortcode('collapse', 'xcollapse');
//文章主动推送到百度
if(!function_exists('Baidu_Submit') && function_exists('curl_init')) {
    function Baidu_Submit($post_ID) {
        $WEB_SITE='www.slmwp.com'; //这里换成你的首选域名
        $WEB_TOKEN='GxApI2x2SnTjte2r';  //这里换成你的网站的百度主动推送的token值
        //已成功推送的文章不再推送
        if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
        $url = get_permalink($post_ID);
        $api = 'http://data.zz.baidu.com/urls?site='.$WEB_SITE.'&token='.$WEB_TOKEN;
        $ch  = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $url,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = json_decode(curl_exec($ch),true);
        //如果推送成功则在文章新增自定义栏目Baidusubmit，值为1
        if (array_key_exists('success',$result)) {
            add_post_meta($post_ID, 'Baidusubmit', 1, true);
        }
    }
    add_action('publish_post', 'Baidu_Submit', 0);
}
//所有设置已完成，如果往后的代码非您手工添加，很可能是因为您的其它主题有恶意代码。
?>