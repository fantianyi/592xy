<?php get_header();$postid = $post->ID; ?>
		<div class="content">
			<div class="inner_content">
				<div class="preject_preview widget widget_anim">
					<div class="projec_page_nav">
						<ul>
							<?php
							$prev_post;$next_post;
							$the_query = new WP_Query( array("post_type"=>"project_post") );
							while ( $the_query->have_posts() ) : $the_query->the_post();
								if($post->ID == $postid){									
									break;
								}
							$prev_post = $post;
							endwhile;
							if($the_query->have_posts()){
								$the_query->the_post();
								$next_post = $post;
							}
							wp_reset_postdata();
							?>
							<?php if(isset($prev_post)): ?>
								<li><a href="<?php echo get_permalink($prev_post->ID); ?>" class="p_prev widget_anim"><span></span><?php _e("Previous"); ?></a></li>
							<?php endif; ?>
							<?php if(isset($next_post)): ?>
								<li><a href="<?php echo get_permalink($next_post->ID); ?>" class="p_next widget_anim"><?php _e("Next","um_lang"); ?> <span></span></a></li>
							<?php endif; ?>
							<?php
							$projectpage = "";
							$the_query = new WP_Query( array("post_type"=>"page") );
							while ( $the_query->have_posts() ) : $the_query->the_post();
								$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
								if($template_name == "template-projects.php"){
									$projectpage = get_permalink($post->ID);
								}
							endwhile;wp_reset_postdata();
							?>
							<?php if($projectpage): ?>
								<li><a href="<?php echo $projectpage; ?>" class="back widget_anim"><?php _e("Back to projects","um_lang"); ?> <span></span></a></li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="project_container">
						<div class="project_img_slider">
							<ul>
								<?php
									$images = get_field("slider");
									if($images):
									foreach($images as $image):
									if($image["image"]["sizes"]["project_preview_huge"]):
									?>
										<li style="position:absolute;"><img src="<?php echo $image["image"]["sizes"]["project_preview_huge"]; ?>"/></li>
									<?php
									endif;
									endforeach;
									endif;
								?>
							</ul>
							<script>
								jQuery(".project_img_slider ul li").hide();
								jQuery(".project_img_slider ul li").eq(0).show();
							</script>
							<div class="project_slider_nav">
								<a href="#" class="pro_prev"></a>
								<a href="#" class="pro_next"></a>
							</div>
						</div>
						<div class="project_content widget_anim">
							<h3><?php the_title(); ?></h3>
							<?php
							$categories = wp_get_post_terms($postid,"projects_category");
							if(count($categories)){
								$category = $categories[0]->name;
							}
							else{
								$category = "";
							}
							?>
							<p class="project_category"><?php echo $category; ?></p>
							<?php the_content(); ?>
						</div>
						<div class="post_social_links">
							<?php
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post' );
							$image = $image[0];
							?>
							<a href="<?php the_permalink(); ?>" class="fb widget_anim"><span></span><?php _e("Share","um_lang"); ?></a>
							<a href="<?php the_permalink(); ?>" class="tw widget_anim"><span></span><?php _e("Tweet","um_lang"); ?></a>
							<a href="<?php the_permalink(); ?>" data-media="<?php echo $image; ?>" class="pin widget_anim"><span></span><?php _e("Pin it","um_lang"); ?></a>
						</div><br style="clear:both;">
					</div>
				</div>
			</div><!--Close Inner Content-->	
		</div><!--Close Content-->
		<?php get_footer(); ?>
	</div><!--Close Wrapper-->
</body>
</html>