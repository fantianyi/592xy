<?php
/*
Template Name: Advices
*/
?>
<?php get_header();global $post;setup_postdata($post); ?>
		<div class="content">
			<div class="inner_content">
				<!--<div class="partners_field">-->
                    <?php
					$the_query = new WP_Query( array("post_type"=>"advice_post") );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Rect0618-300' );
					    $image = $image[0];
					    $content = excerpt($post->post_content,16,"......", 65);
							
						?>
						<div class="advice widget widget_anim">
							<div class="partner_content">
								<div class="Rect0618-300 thumbnail advice_thumbnail">
									<img src="<?php echo $image; ?>"/>
								</div>
								<h4><?php echo the_title(); ?></h4>
								<p><?php echo $content; ?></p>
								<a href="<?php the_permalink(); ?>" class="widget_anim"><?php _e("read full article","um_lang"); ?> <span></span></a>
							</div>
						</div>
						<?php
							endwhile;
						?>
						
				<!--</div>-->
			</div><!--Close Inner Content-->	
		</div><!--Close Content-->
		<?php get_footer(); ?>
	</div><!--Close Wrapper-->
</body>
</html>