<?php get_header(); ?>
<?php 
global $post;
setup_postdata( $post ); 
?>
		<div class="content">
			<div class="inner_content">			
				<?php if(strip_tags(get_the_content(),"<strong><a>")): ?>
				<div class="headline widget_anim">
					<a href="<?php the_field("home_message_banner_link"); ?>"><h1 class="title"><?php echo strip_tags(get_the_content(),"<strong><a>"); ?></h1></a>
					<script> jQuery("h1.title").prepend("<span></span>"); </script>
				</div>
				<?php endif; ?>

				<div class="home_slider">
					<div class="home_slider_nav">
						<a href="#" class="h_prev"></a>
						<a href="#" class="h_next"></a>
					</div>
					<ul>

					</ul>
					<script>
						jQuery(document).ready(function(){
							if(typeof slides !== 'undefined'){
								if(slides.length){
									for(var i = 0 ; i < slides.length ; i++){
										var image = slides[i].image;
										jQuery(".home_slider").find("ul").append("<li><img src='"+image+"' /></li>");
									}
								}else{
									jQuery(".home_slider").remove();
								}
							}else{
								jQuery(".home_slider").remove();
							}
						});
					</script>
				</div>
				
				<div class="widget_container widget_anim">
				
					<div class="last_projects widget">
						<h3 class="widget_title"><?php _e("Last Projects","um_lang"); ?></h3>
						<div class="wid_content">
							<ul>
								<?php
								$the_query = new WP_Query( array("post_type"=>"project_post","posts_per_page"=>6) );
								while ( $the_query->have_posts() ) : $the_query->the_post();
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'project_preview' );
								$image = $image[0];
								$categories = $categories = wp_get_post_terms($post->ID,"projects_category");
								$category_display = array();
								if(count($categories))
								{
									foreach($categories as $category)
									{
										array_push($category_display,$category->name);
									}
									$category_display = implode(", ", $category_display);
								}
								else
								{
									$category_display = "";
								}
								?>
								<li>
									<a href="<?php the_permalink(); ?>">
										<?php if($image): ?>
											<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
										<?php endif; ?>
										<div class="proj_info">
											<p>
												<span class="place"><?php echo $category_display; ?></span><br>
												<span class="project_name"><?php the_title(); ?></span>
											</p>
										</div>
									</a>
								</li>
								<?php
								endwhile;
								?>
							</ul>
						</div>
					</div><!--Close Last Projects-->
				</div>
				
				<div class="widget_container widget_anim" >
					<div class="services widget">
						<h3 class="widget_title"><?php _e("Services","um_lang"); ?></h3>
						<ul>
							<?php
							$the_query = new WP_Query( array("post_type"=>"service_post","posts_per_page"=>6) );
							while ( $the_query->have_posts() ) : $the_query->the_post();
							?>
								<li><a href="#"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
						</ul>
					</div><!--Close Services-->
				</div>
				
				<div class="widget_container widget_anim" >
					<div class="blog_posts widget">
						<h3 class="widget_title"><?php _e("Blog Post","um_lang"); ?></h3>
						<div class="blog_post_box">
							<?php
							$the_query = new WP_Query( array("posts_per_page"=>2) );
							while ( $the_query->have_posts() ) : $the_query->the_post();
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog' );
							$image = $image[0];
							?>
							<div class="blog_post">
								<div class="blog_img">
									<?php if($image): ?>
										<a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
									<?php endif; ?>
								</div>
								<div class="b_post_content">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<p>
									<?php
										$content = excerpt(strip_tags($post->post_content),16,"...");
										echo $content;
									?>
									</p>
								</div>
							</div>
							<?php endwhile; ?>
						</div>
					</div><!--Close Blog Post-->
				</div>
	
				<br style="clear:both;">
			</div><!--Close Inner Content-->
		</div><!--Close Content-->
		<?php get_footer(); ?>
</html>