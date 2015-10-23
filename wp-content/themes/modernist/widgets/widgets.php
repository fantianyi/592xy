<?php
	
	function sidebar_widgets_init(){
		register_sidebar( array(
			'name' => __('Footer Widgets'),
			'id' => 'footer_sidebar_1',
			'description' => __( 'Footer First Widget' ),
			'before_widget' => '<div id="%1$s" class="widget_container col_300 %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
	    register_sidebar(array(
            'name'          => __('Post Bottom Sidebar'),
            'id'            => 'post_bottom_sidebar',
            'before_widget' => '<div id="%1$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="widget_title"><h3 class="tm-title">',
            'after_title'   => '</h3></div>'
        ));
	    register_sidebar(array(
            'name'          => __('Header Center Sidebar'),
            'id'            => 'header_center_sidebar',
            'before_widget' => '<div id="%1$s" class="tm-search">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="widget_title">',
            'after_title'   => '</div>'
        ));
	    register_sidebar(array(
            'name'          => __('Header Right Sidebar'),
            'id'            => 'header_right_sidebar',
            'before_widget' => '<div id="%1$s" class="widget_container %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => ''
        ));
	}

	add_action( 'widgets_init', 'sidebar_widgets_init' );
	
	include get_template_directory() . '/widgets/widget-find-us.php';
	include get_template_directory() . '/widgets/widget-blogroll.php';
	include get_template_directory() . '/widgets/widget-twitterfeed.php';
?>