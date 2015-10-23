<?php
/*
Template Name: Project
*/
?>
<?php get_header(); ?>
		<div class="content">
			<div class="inner_content">
				<div class="projects_field widget widget_anim">
					<h3 class="widget_title"><?php the_title(); ?></h3>
					<?php
					$terms = get_terms("projects_category");
					if(count($terms)):
					?>
					<div class="projects_filter">
						<div class="filter_main_element"><a href="#"><?php _e("Filter Works","um_lang"); ?><span></span></a></div>
						<div class="filter_item"><a class="filter" href="all"><?php _e("All","um_lang"); ?></a></div>
						<?php foreach($terms as $term): ?>
							<div class="filter_item"><a class="filter" href="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<div class="project_holder widget_anim">
							<div class="projects_box">
								<?php
								$the_query = new WP_Query( array("post_type"=>"project_post") );
								while ( $the_query->have_posts() ) : $the_query->the_post();
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'project_preview_big' );
								$image = $image[0];
								$categories = wp_get_post_terms($post->ID,"projects_category");
								$category = array();
								if(count($categories)){
									foreach($categories as $categ){
										array_push($category,$categ->name);
									}
									$category = implode(",",$category);
								}
								else{
									$category = "";
								}
								$cats = array();
								foreach($categories as $cat){
									array_push($cats,$cat->term_id);
								}
								$cats = implode(",",$cats);
								?>
								<div class="project" style="overflow:hidden;" data-categories='<?php echo $cats; ?>'>
									<img src="<?php echo $image; ?>" width="100%"/>
									<div class="project_box_info">
										<p class="project_category_post"><?php echo $category; ?></p>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<p>
										<?php
											$content = excerpt(strip_tags($post->post_content),16,"...");
											echo $content;
										?>
										</p>
										<a class="read_more" href="<?php the_permalink(); ?>"><?php _e("view project","um_lang"); ?> <span></span></a>
									</div>
								</div>
								<?php
									endwhile; 
								?>

							</div>

					</div>
				</div>
			</div><!--Close Inner Content-->	
		</div><!--Close Content-->
		<?php get_footer(); ?>
	</div><!--Close Wrapper-->
</body>
</html>