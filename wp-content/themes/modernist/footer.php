
        <div class="footer bg_color">
				<div class="footer_top_field">
					<?php dynamic_sidebar( 'footer_sidebar_1' ); ?>					
					<br style="clear:both;">
				</div>
                <div class="foot_menu">
                    <ul>
					    <?php
					    $nav_menu = get_nav_menu_locations();
                        $foot_menu = $nav_menu["foot_menu"];
                        $menu_items = wp_get_nav_menu_items($foot_menu);
					    $this_url = curPageURL();
					    if($menu_items):
					            foreach($menu_items as $menu):
					    ?>
						    <li><a href="<?php echo $menu->url; ?>" class="<?php if($this_url == $menu->url): ?> current<?php endif; ?>"><?php echo $menu->title?></a></li>
					    <?php
					    endforeach;
					    endif;
					    ?>
				    </ul>
                </div>
				<div class="copyright">
					<?php the_field("footer_text","options"); ?>

					<?php if( get_field("footer_logo","options") ):$image = get_field("footer_logo","options"); ?>
						<img src="<?php echo $image["url"]; ?>" alt="" />
					<?php endif; ?>
				</div><!--Close Copyright-->
		</div><!--Close Footer-->
	</div><!--Close Wrapper-->
	<?php wp_footer(); ?>
</body>