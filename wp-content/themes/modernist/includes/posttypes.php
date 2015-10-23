<?php
add_action( 'init', 'register_posts' );
	function register_posts() {
		
		register_post_type( 'project_post',
			array(
				'labels' => array(
					'name' => __( "游戏下载" ),
					'singular_name' => __( "Projects" )
				),
				'public' => true,
				'has_archive' => true,				
				'rewrite' => array('slug' => "p", 'with_front' => TRUE),
				'supports' => array('title','editor','thumbnail','page-attributes')				
			)
		);

		register_post_type( 'advice_post',
			array(
				'labels' => array(
					'name' => __( "新游推荐" ),
					'singular_name' => __( "Advices" )
				),
				'public' => true,
				'has_archive' => true,				
				'rewrite' => array('slug' => "a", 'with_front' => TRUE),
				'supports' => array('title','editor','thumbnail','page-attributes', 'comments')				
			)
		);
		
		register_post_type( 'service_post',
			array(
				'labels' => array(
					'name' => __( "Services" ),
					'singular_name' => __( "Services" )
				),
				'public' => true,
				'has_archive' => true,				
				'rewrite' => array('slug' => "s", 'with_front' => TRUE),
				'supports' => array('title','editor','thumbnail','page-attributes')					
			)
		);

		register_taxonomy('advices_category',array (
          0 => 'advice_post',
        ),array( 'hierarchical' => true, 'label' => '新游推荐分类目录','show_ui' => true,'query_var' => true,'singular_label' => '新游推荐分类目录') );
	
		register_taxonomy('projects_category',array (
		  0 => 'project_post',
		),array( 'hierarchical' => true, 'label' => '游戏下载分类目录','show_ui' => true,'query_var' => true,'singular_label' => 'Project Category') );
	
		register_taxonomy('services_category',array (
		  0 => 'service_post',
		),array( 'hierarchical' => true, 'label' => 'Services Category','show_ui' => true,'query_var' => true,'singular_label' => 'Services Category') );
		
		//global $wp_rewrite;   
		//$wp_rewrite->flush_rules(); 
	}
?>