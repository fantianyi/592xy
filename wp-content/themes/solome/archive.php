<?php get_header();?>
<div id="tm-page-body">
<div id="tm-blog" class="tm-container tm-wrap tm-blog-style-list tm-sidebar-right">
    <div class="page-content">
      <div class="tm-content page-content-inner">
        <?php 
		echo s_opt('ads_01_s') ? '<div class="propaganda">'.s_opt('ads_01').'</div>' : '';
		while ( have_posts() ) : the_post(); get_template_part( 'loop' ); endwhile; wp_reset_query();
		echo s_opt('ads_02_s') ? '<div class="propaganda">'.s_opt('ads_02').'</div>' : '' ?>
      </div>
<?php pagination($query_string); ?>
</div>
    <?php get_sidebar()?>
  </div>
        </div>
<?php get_footer();?>