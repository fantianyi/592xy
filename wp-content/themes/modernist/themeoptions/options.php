<?php
// create custom plugin settings menu
add_action('admin_menu', 'umbrella_create_menu');
$prefix = "um";
function umbrella_create_menu() {
	$file_dir = get_template_directory_uri()."/themeoptions/style/";
	//add_menu_page('Umbrella', 'Umbrella', 'administrator', basename(__FILE__) , 'umbrella_settings_page',$file_dir."/umbrella-ico.png");
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	$file_dir = get_template_directory_uri()."/themeoptions/style/";
	wp_enqueue_style("functions", $file_dir."/um_style.css" , false, "1.0", "all");
	register_setting( 'umbrella-settings-group', 'new_option_name' );
	register_setting( 'umbrella-settings-group', 'some_other_option' );
	register_setting( 'umbrella-settings-group', 'option_etc' );
}

function umbrella_settings_page() {
$file_dir = get_template_directory_uri()."/themeoptions/style/";
?>
	<div class="wrap">
		
		<div class="um_menu">
			
			<ul>
				
				<li class="um_first_menu_item"><img src="<?php echo $file_dir."/umbrella_logo.png"; ?>"/></li>
				<li class="um_menu_item">
					<a href="#">
						<img src="<?php echo $file_dir."/home-ico.png"; ?>"/>
						<span>Home Info</span>
					</a>
				</li>
				
				<li class="um_menu_item">
					<a href="#">
						<img src="<?php echo $file_dir."/home-ico.png"; ?>"/>
						<span>General Info</span>
					</a>
				</li>
				
			</ul>
			
		</div>
		
		<div class="um_options">
			
			
			
			<div id="normal-sortables" class="meta-box-sortables">
			<div id="acf_76" class="postbox  acf_postbox default" style="display: block; ">
			<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Test</span></h3>
			<div class="inside">
			<input type="hidden" name="save_input" value="true"><div class="options" data-layout="default" data-show="true" style="display:none"></div><div id="acf-test" class="field field-text"><p class="label"><label for="fields[field_50944041bda9a]">Test</label></p><input type="text" value="" id="fields[field_50944041bda9a]" class="text" name="fields[field_50944041bda9a]"></div></div>
			</div>
			</div>
			
			
			
		</div>
	</div>
<?php } ?>