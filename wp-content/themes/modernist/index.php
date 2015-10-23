<?php get_header();global $post;setup_postdata($post); ?>
		<div class="content">
			<div class="inner_content">
			
				<div class="blog_page widget">
					<div class="xy_index">
						<h3><?php the_title(); ?></h3>
                        <div id="tinymce"><?php the_content(); ?></div>
					</div>
                    <?php dynamic_sidebar('post_bottom_sidebar'); ?>
				</div>

                <?php if ('open' == $post->comment_status) : ?>				<div class="comments_widget widget widget_anim">					<div class="add_comment">						<h3 class="widget_title"><?php _e("Add Comment","um_lang"); ?></h3>						<br/>					<?php comment_form(array("comment_notes_before"=>"",						'title_reply'=>'Leave a Comment',"comment_notes_after"=>""),$post->ID); ?>							</div>										<?php comments_template(); ?>				</div><!--Close Comments-->				<?php endif; ?>				<div style="clear:both;" />

			</div><!--Close Inner Content-->	
		</div><!--Close Content-->
		<?php get_footer(); ?>
	</div><!--Close Wrapper-->
</body>
</html>