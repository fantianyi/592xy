<?php
// create custom plugin settings menu
add_action('admin_menu', 'umbrella_create_menu');

function umbrella_create_menu() {

	//create new top-level menu
	add_menu_page('umbrella Settings', 'umbrella Settings', 'administrator', basename(__FILE__) , 'umbrella_settings_page',null);

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'umbrella-settings-group', 'new_option_name' );
	register_setting( 'umbrella-settings-group', 'some_other_option' );
	register_setting( 'umbrella-settings-group', 'option_etc' );
}

function umbrella_settings_page() {
?>
	<div class="wrap">
	<h2>Your Plugin Name</h2>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	<table class="form-table">

	<tr valign="top">
	<th scope="row">New Option Name</th>
	<td><input type="text" name="new_option_name" value="<?php echo get_option('new_option_name'); ?>" /></td>
	</tr>
	 
	<tr valign="top">
	<th scope="row">Some Other Option</th>
	<td><input type="text" name="some_other_option" value="<?php echo get_option('some_other_option'); ?>" /></td>
	</tr>

	<tr valign="top">
	<th scope="row">Options, Etc.</th>
	<td><input type="text" name="option_etc" value="<?php echo get_option('option_etc'); ?>" /></td>
	</tr>

	</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="new_option_name,some_other_option,option_etc" />

	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>

	</form>
	</div>
<?php } ?>