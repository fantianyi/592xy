<?php

function optionsframework_option_name() {
    // 从样式表获取主题名称
    $themename = wp_get_theme();
    $themename = preg_replace("/\W/", "_", strtolower($themename));
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
}
function optionsframework_options() {
    // 将所有分类（categories）加入数组
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }
    $options = array();
    $options[] = array(
        'name' => __('全站设置', 'Solome') ,
        'type' => 'heading'
    );
    $options[] = array(
        'name' => __('全站logo设置', 'Solome') ,
        'desc' => __('顶部导航logo，最宽不超过350px,最高不超过60px', 'Solome') ,
        'id' => 'logo_src',
        "std" => 'http://cdn.slmwp.com/slmwp/img/logo_w.png',
        'type' => 'upload'
    );
	$options[] = array(
        'name' => __('脚部背景图片', 'Solome') ,
		'desc' => __('脚部背景图片，自动百分百拉伸填充，所以不要使用太过看重比例的背景图。', 'Solome') ,
        'id' => 'foot_bgpic',
        "std" => '' . get_bloginfo('template_directory') . '/assets/img/footer-bg.jpg',
        'type' => 'upload'
    );
	$options[] = array(
        'name' => __('付款二维码图片', 'Solome') ,
        'desc' => __('付款二维码图片，大小自己看着办！', 'Solome') ,
        'id' => 'pay_img',
        "std" => 'http://cdn.slmwp.com/slmwp/alipay-qrcode-250.png',
        'type' => 'upload'
    );
    $options[] = array(
        'name' => __('脚部邮箱订阅ID', 'Solome') ,
        'desc' => __('基于QQ邮箱订阅的邮箱订阅，获取ID的方法见水冷眸博客', 'Solome') ,
		'desc' => sprintf(__('基于QQ邮箱订阅的邮箱订阅，获取ID的方法<a href="%1$s"  target="_blank">点此进行查看</a>。', 'Solome') , 'http://www.slmwp.com/qqmail-lists-id.html') ,
        'id' => 'foot_maillistid',
        'type' => 'text',
    );
	$options[] = array(
		'name' => __( '建站日期', 'theme-textdomain' ),
		'desc' => __( '填写你的建站日期，请注意格式', 'theme-textdomain' ),
		'id' => 'solo_jzdate',
		'std' => '2015-03-06',
		'class' => 'mini',
		'type' => 'text'
	);
    $options[] = array(
        'name' => __('ICP备案号', 'Solome') ,
        'desc' => __('请填写你的ICP备案号，不填写清留空', 'Solome') ,
        'id' => 'solo_icp',
        'type' => 'text',
    );
    $options[] = array(
		'name' => __( 'SEO-关键字设置', 'theme-textdomain' ),
		'desc' => __( '输入您的网站关键词，建议不超过10个，每个以英文(,)号分隔。', 'theme-textdomain' ),
		'id' => 'seo_keywords',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => __( 'SEO-描述设置', 'theme-textdomain' ),
		'desc' => __( '输入您的网站描述，建议不超过150个字符。.', 'theme-textdomain' ),
		'id' => 'seo_description',
		'type' => 'textarea'
	);
    $options[] = array(
        'name' => '网站底部信息',
        'desc' => '位于网站底部，可以放置网站地图等各类内容',
        'id' => 'foot_copy',
        'std' => '基于 <a href="https://cn.wordpress.org/" target="_blank" rel="nofollow">WordPress</a> & <a href="http://www.slmwp.pw/go/aliyun.html" target="_blank" rel="nofollow"  title="运行在阿里云">阿里云</a>构建',
        'type' => 'textarea'
    );
	$options[] = array(
        'name' => '网站底部文本',
        'desc' => '位于网站底部，可以写一段话，一段声明等，',
        'id' => 'foot_text',
        'std' => '《Solome主题》为水冷眸制作的第三款，同时也是Solo系列的第一款主题。关于Solo系列详细介绍，<a>请查看此文章。</a>',
        'type' => 'textarea'
    );
	
    /*分隔	*/
    $options[] = array(
        'name' => '基本设置',
        'type' => 'heading'
    );
	$options[] = array(
        'name' => __('文章信息小部件', 'Solome') ,
        'desc' => __(' 是否显示作者？默认开启', 'Solome') ,
        'id' => 'solo_author_s',
        'std' => true,
        'type' => 'checkbox'
    );
	$options[] = array(
        'desc' => __(' 是否显示分类？默认开启', 'Solome') ,
        'id' => 'solo_cat_s',
        'std' => true,
        'type' => 'checkbox'
    );
	$options[] = array(
        'desc' => __(' 是否显示评论数？默认开启', 'Solome') ,
        'id' => 'solo_comm_s',
        'std' => true,
        'type' => 'checkbox'
    );
    
    $options[] = array(
        'name' => __('文章页', 'Solome') ,
        'desc' => __(' 是否开启点赞、打赏、百度分享部件？默认开启', 'Solome') ,
        'id' => 'solo_share',
        'std' => true,
        'type' => 'checkbox'
    );
	$options[] = array(
        'desc' => __(' 是否开启版权声明？默认开启', 'Solome') ,
        'id' => 'solo_copyright_s',
        'std' => true,
        'type' => 'checkbox'
    );
	$options[] = array(
        'desc' => __('版权声明提示文字', 'Solome') ,
        'id' => 'solo_copyright_title',
        'std' => __('如无特殊说明，文章均为本站原创，转载请注明出处', 'Solome') ,
        'type' => 'text'
    );
	$options[] = array(
        'name' => __('新窗口打开文章', 'Solome') ,
        'desc' => __('顾名思义，开启之后点击链接在新窗口打开，只在列表及博客模式的首页起作用', 'Solome') ,
        'id' => 'target_blank',
        'std' => false,
        'type' => 'checkbox'
    );
    $options[] = array(
        'name' => __('相关文章', 'Solome') ,
        'id' => 'solo_related_s',
        'type' => 'checkbox',
        'std' => true,
        'desc' => __('开启', 'Solome')
    );
    $options[] = array(
        'desc' => __('相关文章标题', 'Solome') ,
        'id' => 'solo_related_title',
        'std' => __('相关推荐', 'Solome') ,
        'type' => 'text'
    );
    $options[] = array(
        'desc' => __('相关文章显示数量', 'Solome') ,
        'id' => 'solo_related_n',
        'std' => 4,
        'class' => 'mini',
        'type' => 'text'
    );
	
	$options[] = array(
        'name' => __('其它设置', 'Solome') ,
        'type' => 'heading'
    );
	$options[] = array(
        'name' => __('首页置顶模块', 'Solome') ,
        'id' => 'solo_top_s',
        'type' => 'checkbox',
        'std' => true,
        'desc' => __('开启', 'Solome')
    );
    $options[] = array(
        'name' => __('首页置顶模块大图设置', 'Solome') ,
		'desc' => __('置顶模块首图标题', 'Solome') ,
        'id' => 'solo_top_title',
        'std' => __('公告', 'Solome') ,
        'type' => 'text'
    );
	$options[] = array(
        'id' => 'slide_top_url',
        'desc' => __('链接', 'Solome') ,
        'std' => 'http://www.slmwp.com/play-lm',
        'type' => 'text'
        );
    $options[] = array(
        'id' => 'slide_top_img',
        'desc' => __('尺寸370*370。', 'Solome') ,
        'std' => 'http://cdn.slmwp.com/slmwp/img/playlmxuanchuan.jpg',
        'type' => 'upload'
    );
	$options[] = array(
        'name' => __('底部导航标题', 'Solome') ,
        'id' => 'foot_nav_title',
        'std' => '原创主题',
        'class' => 'mini',
        'type' => 'text'
    );
	$options[] = array(
        'name' => __('侧栏滚动', 'Solome') ,
        'id' => 'sideroll_s',
        'std' => true,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'id' => 'sideroll_n_1',
        'std' => '1',
        'class' => 'mini',
        'type' => 'text'
    );
    $options[] = array(
        'id' => 'sideroll_n_2',
        'std' => '2',
        'class' => 'mini',
        'desc' => __('设置随动模块，直接输入数字', 'Solome') ,
        'type' => 'text'
    );
    
    $options[] = array(
        'name' => __('首页幻灯', 'Solome') ,
        'type' => 'heading'
    );
    $options[] = array(
        'id' => 'slide_s',
        'std' => true,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    for ($i = 1; $i <= 5; $i++) {
        $options[] = array(
            'name' => __('幻灯', 'Solome') . $i,
            'id' => 'slide_title_' . $i,
            'desc' => '标题',
            'std' => 'Solome主题 - 水冷眸',
            'type' => 'text'
        );
        $options[] = array(
            'id' => 'slide_href_' . $i,
            'desc' => __('链接', 'Solome') ,
            'std' => 'http://www.slmwp.com/play-lm',
            'type' => 'text'
        );
        $options[] = array(
        		'id' => 'slide_miaoshu_' . $i,
        		'desc' => __('描述', 'Solome') ,
        		'std' => '《Play-LM》多用途高级主题发布',
        		'type' => 'textarea'
        );
        $options[] = array(
            'id' => 'slide_blank_' . $i,
            'std' => true,
            'desc' => __('新窗口打开', 'Solome') ,
            'type' => 'checkbox'
        );
        $options[] = array(
            'id' => 'slide_src_' . $i,
            'desc' => __('尺寸自己看着办，自适应图片大小，但是希望你能保持各个图片高度一样。', 'Solome') ,
            'std' => get_template_directory_uri() .'/assets/img/slide.jpg',
            'type' => 'upload'
        );
    }
    $options[] = array('name' => __('社交', 'Solome'), 'type' => 'heading');
    $options[] = array('name' => __('新浪微博', 'Solome'), 'id' => 'social_weibo_s', 'std' => true, 'desc' => ' 显示', 'type' => 'checkbox');
    $options[] = array('desc' => '直接填写链接', 'id' => 'social_weibo', 'std' => 'http://weibo.com/u/2329174242', 'type' => 'text');
    

    
    $options[] = array('name' => __('腾讯微博', 'Solome'), 'id' => 'social_tqq_s', 'std' => true, 'desc' => ' 显示', 'type' => 'checkbox');
    $options[] = array('desc' => '直接填写链接', 'id' => 'social_tqq', 'std' => 'http://t.qq.com/hytta8', 'type' => 'text');
    


    $options[] = array('name' => __('腾讯QQ', 'Solome'), 'id' => 'social_qq_s', 'std' => true, 'desc' => ' 显示', 'type' => 'checkbox');
    $options[] = array('desc' => '这是一个临时会话的链接，直接填写QQ号码，（请注意查看自己QQ是否允许临时会话）', 'id' => 'social_qq', 'std' => '123456789', 'type' => 'text');
    
    $options[] = array('name' => __('邮箱链接', 'Solome'), 'id' => 'social_mail_s', 'std'=>false, 'desc' => ' 显示', 'type' => 'checkbox');
    $options[] = array('desc' => '直接填写邮箱地址即可，如：123456@qq.com（投稿管理员接收邮箱也是这个）', 'id' => 'social_mail', 'std' => '', 'type' => 'text');
	$options[] = array('name' => __('QQ群链接', 'Solome'), 'id' => 'social_qun_s', 'std'=>false, 'desc' => ' 显示', 'type' => 'checkbox');
	$options[] = array('desc' => '群名称或者其它标题名称', 'id' => 'social_qun_tit', 'std' => '', 'type' => 'text');
    $options[] = array('desc' => '直接填写加群链接地址即可，如何获取加群链接请点此', 'id' => 'social_qun', 'std' => '', 'type' => 'text');
    	
    $options[] = array('name' => __('微信帐号', 'Solome'), 'id' => 'social_wechat_s', 'std' => true, 'desc' => ' 显示', 'type' => 'checkbox');
    $options[] = array('desc' => '直接填写链接', 'id' => 'social_wechat', 'std' => '水冷眸', 'type' => 'text');
    
    $options[] = array('id' => 'social_wechat_qr', 'std' => 'http://cdn.slmwp.com/slmwp/img/slm_qrcode.jpg', 'desc' => __('微信二维码，建议图片尺寸：', 'Solome') . '230x230px', 'type' => 'upload');
    $options[] = array('name' => __('RSS订阅', 'Solome'), 'id' => 'social_feed_s', 'std'=>true, 'desc' => ' 显示', 'type' => 'checkbox');
    $options[] = array( 'id' => 'social_feed', 'std' => get_feed_link(), 'type' => 'text');
    
    $options[] = array(
        'name' => __('广告位', 'Solome') ,
        'type' => 'heading'
    );
    $options[] = array(
        'name' => __('文章页正文结尾文字广告', 'Solome') ,
        'id' => 'post_footer_s',
        'std' => true,
        'desc' => ' 显示',
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => '标题',
        'id' => 'post_footer_title',
        'std' => '《Play-LM》多用途高级主题发布',
        'type' => 'text'
    );
    $options[] = array(
        'desc' => '链接（直接填写地址，别忘了http://）',
        'id' => 'post_footer_link',
        'std' => '',
        'type' => 'text'
    );
    $options[] = array(
        'id' => 'post_footer_blank',
        'type' => 'checkbox',
        'std'=>false,
        'desc' => __('开启', 'Solome') . ' (' . __('新窗口打开链接，如果链接没填写请不要开启', 'Solome') . ')'
    );
	$options[] = array(
        'name' => __('全站导航下广告', 'Solome') ,
        'id' => 'ads_head_s',
        'std' => false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于全站导航下，给力的展现位置！高宽无限制，默认居中', 'Solome') ,
        'id' => 'ads_head',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('全站页脚前广告，', 'Solome') ,
        'id' => 'ads_foot_s',
        'std' => false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于全站页脚前，给力的展现位置！高宽无限制，默认居中', 'Solome') ,
        'id' => 'ads_foot',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('AD1-列表前', 'Solome') ,
        'id' => 'ads_01_s',
        'std' => false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于（首页、各类归档页、分类页）的列表循环顶部，最大宽度880px，默认居中', 'Solome') ,
        'id' => 'ads_01',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('AD2-列表后', 'Solome') ,
        'id' => 'ads_02_s',
        'std' => false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于（首页、各类归档页、分类页）的列表循环底部，最大宽度880px，默认居中', 'Solome') ,
        'id' => 'ads_02',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('AD3-文章页正文前', 'Solome') ,
        'id' => 'ads_03_s',
        'std' => false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于（页面、文章）的正文开始前，最大宽度880px，默认居中', 'Solome') ,
        'id' => 'ads_03',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('AD4-文章页作者信息后', 'Solome') ,
        'id' => 'ads_04_s',
        'std'=>false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于（页面、文章）的作者信息后，最大宽度880px，默认居中', 'Solome') ,
        'id' => 'ads_04',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('AD5-文章页评论后', 'Solome') ,
        'id' => 'ads_05_s',
        'std'=>false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('位于（页面、文章）的评论后，最大宽度880px，默认居中', 'Solome') ,
        'id' => 'ads_05',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('AD6-全站漂浮广告', 'Solome') ,
        'id' => 'ads_06_s',
        'std'=>false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('此广告位放置于底部文件，全站加载，可放置漂浮、弹窗、图+等广告，可以添加多个广告代码', 'Solome') ,
        'id' => 'ads_06',
        'type' => 'textarea'
    );
	$options[] = array(
        'name' => __('PHONE-AD1 手机模式', 'Solome') ,
        'id' => 'adm_01_s',
        'std'=>false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('手机模式下展示的广告，此广告位于导航下', 'Solome') ,
        'id' => 'adm_01',
        'type' => 'textarea'
    );
	$options[] = array(
        'name' => __('PHONE-AD2 手机模式', 'Solome') ,
        'id' => 'adm_02_s',
        'std'=>false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('手机模式下展示的广告，此广告位于页脚前', 'Solome') ,
        'id' => 'adm_02',
        'type' => 'textarea'
    );
	$options[] = array(
        'name' => __('PHONE-AD3 手机模式', 'Solome') ,
        'id' => 'adm_03_s',
        'std'=>false,
        'desc' => __('开启', 'Solome') ,
        'type' => 'checkbox'
    );
    $options[] = array(
        'desc' => __('手机模式下展示的广告，全站加载，可放置漂浮、弹窗、图+等广告，可以添加多个广告代码', 'Solome') ,
        'id' => 'adm_03',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('自定义代码', 'Solome') ,
        'type' => 'heading'
    );
    $options[] = array(
        'name' => __('自定义CSS样式', 'Solome') ,
        'desc' => __('位于&lt;/head&gt;之前，直接写样式代码，不需要添加&lt;style&gt;标签', 'Solome') ,
        'id' => 'csscode',
        'std' => '',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('自定义头部代码', 'Solome') ,
        'desc' => __('位于&lt;/head&gt;之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、添加&lt;/meta&gt;信息验证网站所有权、全站头部JS等需要提前加载的代码', 'Solome') ,
        'id' => 'headcode',
        'std' => '',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('自定义底部代码', 'Solome') ,
        'desc' => __('位于&lt;/body&gt;之前，这部分代码是在主要内容加载完毕加载，通常是JS代码', 'Solome') ,
        'id' => 'footcode',
        'std' => '',
        'type' => 'textarea'
    );
    $options[] = array(
        'name' => __('网站统计代码', 'Solome') ,
        'desc' => __('位于底部，用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ、51la，国内站点推荐使用百度统计，国外站点推荐使用Google analytics', 'Solome') ,
        'id' => 'trackcode',
        'std' => '',
        'type' => 'textarea'
    );
    return $options;
}?>