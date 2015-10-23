<?php
/*
Template Name: Contact
*/
?>
<?php
	if(isset($_POST["u_name"]) && isset($_POST["u_email"]) && isset($_POST["u_message"])){
		header("HTTP/1.0 200 OK");
		$name = $_POST["u_name"];
		$email = $_POST["u_email"];
		$message = $_POST["u_message"];
		$tel = $_POST["u_tel"];
		if($name != '' && $email != '' & $message != ''){
		
			$to = get_field("receiving_emails");
			$from = $email;
			$message = $message."
			
			Phone Number : {$tel}
			";
			$headers[] = "From: {$name} <{$email}>";
			$subject = get_bloginfo("name").__(" : Contact Form");
			wp_mail( $to, $subject, $message, $headers );
		}
		die;
	}
?>
<?php get_header(); ?>
		<div class="content">
			<div class="inner_content">
			
				<div class="widget_container col_620 widget_anim">
					<div class="contact widget">
						<h3 class="widget_title"><?php _e("Contact Form","um_lang"); ?></h3>
						<div class="space"></div>
						<?php if(get_field("contact_form_text")): ?>
						<p><?php the_field("contact_form_text"); ?></p>
						<?php endif; ?>
						<form action="<?php the_permalink(); ?>" method="post" class="contact_form">
							<div class="contact_form_info">
								<p class="widget_anim">
									<strong class="label"><span><?php _e("Name","um_lang"); ?></span></strong>
									<input type="text" name="name" id="name" /></input>
								</p>
								<p class="widget_anim">
									<strong class="label"><span><?php _e("Email","um_lang"); ?></span></strong>
									<input type="text" name="email" id="email" />
								</p>
								<p class="widget_anim">
									<strong class="label"><span><?php _e("Mob","um_lang"); ?></span></strong>
									<input type="text" id="mob" name="mob"/>
								</p>
							</div>
							<div class="message">
								<p>
									<textarea name="message" id="message" placeholder="your message goes here..."></textarea>
								</p>
							</div><br style="clear:both;">
							<?php if(get_field("contact_form_bottom_text")): ?>
							<p class="info_text"><?php the_field("contact_form_bottom_text"); ?></p>
							<?php endif; ?>
							<div class="form_buttons">
								<a class="reset" href="#"><?php _e("Reset","um_lang"); ?></a>
								<input type="submit" name="send" id="send" value="<?php _e("Send message","um_lang"); ?>">
							</div>
						</form>
						<div class="message_success" style="display:none">
							<p></p><p></p><p></p>
							<p><?php the_field("success_message"); ?></p>
						</div>
						<div style="clear:both"></div>
					</div>
				</div>
				
				<?php if(get_field("google_map_latitude") && get_field("google_map_longitude")): ?>
				<div class="widget_container col_300 widget_anim">
					<div class="map widget">
						<iframe class="grayscale" width="300" height="334" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;t=m&amp;ll=<?php echo get_field("google_map_latitude").",".get_field("google_map_longitude"); ?>&amp;spn=23.265075,26.103516&amp;z=4&amp;output=embed"></iframe>
						<a href="#" onclick="event.preventDefault();alert('Latitude : <?php the_field("google_map_latitude"); ?>\nLongitude : <?php the_field("google_map_longitude"); ?>');"><?php _e("get gps cordinates","um_lang"); ?></a>
					</div>
				</div>
				<?php endif; ?>
				
				<div class="widget_container col_300 widget_anim">
					<div class="contact_info widget">
						<h3 class="widget_title"><?php _e("Contact Info","um_lang"); ?></h3>
						<p><?php the_field("contact_info_test"); ?></p>
						<ul class="contact_info_list">
						
							<?php if(get_field("address")): ?>
							<li class="widget_anim">
								<span class="info_location"></span>
								<h3><?php _e("ADDRESS","um_lang"); ?></h3>
								<p><?php the_field("address"); ?></p>
							</li>
							<?php endif; ?>
							
							<?php if(get_field("phone_numbers")): ?>
							<li class="widget_anim">
								<span class="info_number"></span>
								<h3><?php _e("PHONE NUMBERS","um_lang"); ?></h3>
								<p><?php the_field("phone_numbers"); ?></p>
							</li>
							<?php endif; ?>
							
							<?php if(get_field("email_addresses")): ?>
							<li class="widget_anim">
								<span class="info_email"></span>
								<h3><?php _e("EMAIL ADDRESS","um_lang"); ?></h3>
								<p><?php the_field("email_addresses"); ?></p>
							</li>
							<?php endif; ?>
							
						</ul>
					</div>
				</div>
				<br style="clear:both;">
			</div><!--Close Inner Content-->
		</div><!--Close Content-->
		<?php get_footer(); ?>
	</div><!--Close Wrapper-->
</body>
</html>