<?php
	class umbrella_find_us extends WP_Widget{
	
		function umbrella_find_us() 
		{
			parent::WP_Widget(false, $name = 'Umbrella > Find Us');
		}
		
		function widget($args, $instance)
		{
			extract( $args );
			$title = apply_filters('widget_title', $instance['title']);
			$address = $instance['address'];
			$phone = $instance['phone'];
			$mail = $instance['mail'];
			?>
			<div class="find_us col_460 footer_col">						
				<h3><?php echo $title; ?></h3>
				<img src="<?php bloginfo("template_directory"); ?>/images/icons/footer_building.png" alt="Find Us">
				<p><strong><?php _e("Address"); ?> </strong><?php echo $address; ?></p>
				<p><strong><?php _e("Phone"); ?> </strong><?php echo $phone; ?></p>
				<p><strong><?php _e("Mail"); ?> </strong><?php echo $mail; ?></p>
			</div><!--Close Find Us-->
			<?php
		}
		
		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['address'] = strip_tags($new_instance['address']);
			$instance['phone'] = strip_tags($new_instance['phone']);
			$instance['mail'] = strip_tags($new_instance['mail']);
			return $instance;
		}
		
		function form($instance)
		{
			$title = isset($instance['title']) ? esc_attr($instance['title']) : "";
			$address = isset($instance['address']) ? esc_attr($instance['address']) : "";
			$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : "";
			$mail = isset($instance['mail']) ? esc_attr($instance['mail']) : "";
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Adress'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('mail'); ?>"><?php _e('E-Mail'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo $mail; ?>" />
			</p>
			<?php
		}
	}
	
	function umbrella_widgets_find_us() {			
		register_widget('umbrella_find_us');			
	}
	add_action('widgets_init', 'umbrella_widgets_find_us');
?>