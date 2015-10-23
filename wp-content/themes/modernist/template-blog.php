<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
		<div class="content">
			<div class="inner_content">
				<div class="blog_posts_page">
				
					<?php
					$page = get_query_var("paged");
					if(get_field("number_of_posts")){
						$args = array("posts_per_page"=>get_field("number_of_posts"));
					}
					else{
						$args = array("posts_per_page"=>8);
					}
					if($page){
						$args["paged"] = $page;
					}
					$the_query = new WP_Query( $args );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					
					$categories = wp_get_post_terms($post->ID,"category");
					if($categories)
						$categories = $categories[0]->name;
						
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog' );
					$image = $image[0];
						
					?>
					<div class="blog_post_page widget_anim">
						<?php if($image): ?>
						<img class="blog_post_preview" src="<?php echo $image; ?>"/>
						<?php endif; ?>
						<div class="blog_title">
							<h3><?php echo $categories; ?></h3>
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						</div>
						<div class="blog_post_content">
							<p class="blog_category">Architecture</p>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p>
							<?php
								$content = excerpt(strip_tags($post->post_content),16,"...");
								echo $content;
							?>
							</p>
							<a class="read_more" href="<?php the_permalink(); ?>"><?php _e("read full article","um_lang"); ?> <span></span></a>
						</div>
					</div><!--Close Blog Post-->
					<?php endwhile;wp_reset_postdata(); ?>
	
				</div>
				
				<?php if($the_query->max_num_pages > 1): ?>
				<div class="blog_pages widget_anim">
					<div class="page_numbers">
						<ul>
							<?php
							$maxpages = $the_query->max_num_pages;
							$page = get_query_var("paged");
							for($i = 1 ; $i <= $maxpages ; $i++){
							$class = "";
							if($i == $page){
								$class = "cur_page";
							}
							if(!$page && $i == 1){
								$class = "cur_page";							
							}
							if($wp_rewrite->using_permalinks()){
								$query = "page/{$i}/";
							}
							else{
								$query = "&paged={$i}";
							}
							?>
								<li class="widget_anim" ><a class="<?php echo $class; ?>" href="<?php the_permalink();echo $query; ?>"><?php echo $i; ?></a></li>
							<?php
							}
							?>
						</ul>
					</div>
					<div class="page_nav">
						<?php
							$page = get_query_var("paged");
							if(intval($page) > 1){
								$page = ($page - 1);
								if($wp_rewrite->using_permalinks()){								
								$query = "page/{$page}/";
								}
								else{
									$query = "&paged={$page}";
								}
							}
							else{
								$query = "";
							}
						?>
						<a href="<?php the_permalink();echo $query; ?>" class="widget_anim"><?php _e("PREV","um_lang"); ?></a>
						<?php
							$page = get_query_var("paged");
							$maxpages = $the_query->max_num_pages;
							if(intval($page) < $maxpages){
								if(!$page){
									$page = 2;
								}
								else{
									$page = ($page + 1);
								}
								if($wp_rewrite->using_permalinks()){								
								$query = "page/{$page}/";
								}
								else{
									$query = "&paged={$page}";
								}
							}
							else{
								$query = "&paged={$page}";
							}
						?>
						<a href="<?php the_permalink();echo $query; ?>" class="widget_anim"><?php _e("NEXT","um_lang"); ?></a>
					</div>
				</div>
				<?php endif; ?>
				
			</div><!--Close Inner Content-->
		</div><!--Close Content-->
		<?php get_footer(); ?>
	</div><!--Close Wrapper-->
</body>
</html>