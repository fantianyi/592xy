<div class="comments">
<h3 class="widget_title"><?php _e("Comments","um_lang"); ?></h3>
	<div class="comments_field">
		<?php
		$args = array ('type' => 'comment', 'callback' => 'theme_comment');
		wp_list_comments( $args );	
		?>
	</div>
</div>
