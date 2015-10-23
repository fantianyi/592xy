<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title><?php echo $s?>的搜索结果 - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) {    echo ' -第';   echo get_query_var('page');   echo '页';   }?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_author() ) {?><title><?php wp_title('');?>发表的所有文章 - <?php bloginfo('name'); ?></title><?php }?>
<?php if ( is_404() ) {?><title>404错误，页面不存在 - <?php bloginfo('name'); ?></title><?php }?>
<?php if ( is_single() || is_page()) { ?>
<meta name="description" content="<?php echo get_post_meta($post->ID, 'description_value', true);?>" />
<meta name="keywords" content="<?php echo get_post_meta($post->ID, 'keywords_value', true);?>" />
<?php } ?>
<?php if ( is_tag() ) { ?>
<meta name="description" content="<?php echo single_tag_title(); ?>" />
<?php } ?>
<?php if ( is_home() || is_404() ) { ?>
<meta name="description" content="<?php echo s_opt('seo_description'); ?>" />
<meta name="keywords" content="<?php echo s_opt('seo_keywords'); ?>" />
<?php if ( is_category()  ) {    
    $categories = get_the_category();  
    $term_id = $categories[0]->term_id;    
?> 
<meta name="description" content="<?php echo get_option('cat-description-'.$term_id); ?>" />
<meta name="keywords" content="<?php echo get_option('cat-keywords-'.$term_id);?>" />
<?php }} ?>
