<div class="page-sidebar">
    <?php if (function_exists( 'dynamic_sidebar') && dynamic_sidebar( 'widget_sitesidebar')) : endif; if (is_single() || is_page()) { if (function_exists( 'dynamic_sidebar') && dynamic_sidebar( 'widget_postsidebar')) : endif; } else if (is_home()) { if (function_exists(
    'dynamic_sidebar') && dynamic_sidebar( 'widget_sidebar')) : endif; } else { if (function_exists( 'dynamic_sidebar') && dynamic_sidebar( 'widget_othersidebar')) : endif; } ?>
</div>
