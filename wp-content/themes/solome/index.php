<?php get_header();?>
<div id="tm-page-body">
    <div id="tm-blog" class="tm-container tm-wrap tm-blog-style-list tm-sidebar-right">
        <div class="page-content">
            <?php if (s_opt( 'slide_s')) {include( 'modules/silder.php');}?>
            <?php if (s_opt( 'solo_top_s')) {include( 'modules/sign.php');}?>
            <div class="tm-content page-content-inner">
                <?php if( $paged && $paged>1 ){ printf('
                <div class="header-line-center-bottom">
                    <h2 class="tm-title">最新发布  <span>第'.$paged.'页</span></h2>
                </div>'); }else{ printf('
                <div class="header-line-center-bottom">
                    <h2 class="tm-title">最新发布  </h2>
                </div>'); }
				echo s_opt('ads_01_s') ? '<div class="propaganda">'.s_opt('ads_01').'</div>' : '';
				 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; $args = array( 'caller_get_posts' => 1, 'paged' => $paged ); query_posts($args); while ( have_posts() ) : the_post(); get_template_part( 'loop' ); endwhile; wp_reset_query();
                echo s_opt('ads_02_s') ? '<div class="propaganda">'.s_opt('ads_02').'</div>' : ''?></div>
            <?php pagination($query_string); ?>
        </div>
        <?php get_sidebar()?>
    </div>
</div>
<?php get_footer();?>