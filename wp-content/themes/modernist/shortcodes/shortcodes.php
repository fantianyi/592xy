<?php
/*Heading1 Quotes*/
function umbrella_heading1_shortcode($atts, $content){
	return '<h1>'.$content.'</h1>';
}

add_shortcode('h1', 'umbrella_heading1_shortcode');

add_action('init', 'heading1_btn');
function heading1_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
}
/*Heading1 Quotes*/

/*Heading2 Quotes*/
function umbrella_heading2_shortcode($atts, $content){
	return '<h2>'.$content.'</h2>';
}

add_shortcode('h2', 'umbrella_heading2_shortcode');

add_action('init', 'heading2_btn');
function heading2_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Heading2 Quotes*/

/*Heading3 Quotes*/
function umbrella_heading3_shortcode($atts, $content){
	return '<h3>'.$content.'</h3>';
}

add_shortcode('h3', 'umbrella_heading3_shortcode');

add_action('init', 'heading3_btn');
function heading3_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Heading3 Quotes*/

/*Heading4 Quotes*/
function umbrella_heading4_shortcode($atts, $content){
	return '<h4>'.$content.'</h4>';
}

add_shortcode('h4', 'umbrella_heading4_shortcode');

add_action('init', 'heading4_btn');
function heading4_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Heading4 Quotes*/

/*Heading5 Quotes*/
function umbrella_heading5_shortcode($atts, $content){
	return '<h5>'.$content.'</h5>';
}

add_shortcode('h5', 'umbrella_heading5_shortcode');

add_action('init', 'heading5_btn');
function heading5_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Heading5 Quotes*/


/*Buttons*/
function umbrella_button_shortcode($atts, $content){
	extract(shortcode_atts( array('type' => '','href' => ''), $atts)); 
	return '<a href="'.$href.'" class="button '.$type.'">'.$content.'<span></span></a>';
}

add_shortcode('button', 'umbrella_button_shortcode');

add_action('init', 'button_btn');
function button_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Buttons*/

/*Dropcap*/
function umbrella_dropcap_shortcode($atts, $content){
	return '<p class="dropcap">'.strip_tags($content).'</p>';
}

add_shortcode('dropcap', 'umbrella_dropcap_shortcode');

add_action('init', 'dropcap_btn');
function dropcap_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Dropcap*/

/*Blockqquote*/
function umbrella_blockquote_shortcode($atts, $content){
	return '<p class="blockquote">'.strip_tags($content).'</p>';
}

add_shortcode('blockquote', 'umbrella_blockquote_shortcode');

add_action('init', 'blockquote_btn');
function blockquote_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Blockqquote*/

/*Alerts*/
function umbrella_alerts_shortcode($atts, $content){
	extract(shortcode_atts( array('type' => ''), $atts));
	
	if($type == "info"){	
		return '<p class="info_message"><strong>Info</strong>'.strip_tags($content).'</p>';
	}
	else if($type == "yes"){	
		return '<p class="yes_message"><strong>Yes</strong>'.strip_tags($content).'</p>';
	}
	else if($type == "error"){	
		return '<p class="error_message"><strong>Error</strong>'.strip_tags($content).'</p>';
	}
	else if($type == "info2"){	
		return '<p class="info2_message"><strong>Info</strong>'.strip_tags($content).'</p>';
	}
}

add_shortcode('alert', 'umbrella_alerts_shortcode');

add_action('init', 'alert_btn');
function alert_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
} 
/*Alerts*/

/*Tabs*/
function umbrella_tabitem_shortcode($atts, $content){
	extract(shortcode_atts( array('title' => ''), $atts));
	return '<div class="tab_content" data-title="'.$title.'">'.$content.'</div>';
}
add_shortcode('tab', 'umbrella_tabitem_shortcode');

function umbrella_tabgroup_shortcode($atts, $content){
	$content = do_shortcode($content);
	return '<div class="tabs widget">
	<div class="tab_buttons">
		<ul>
		</ul>
	</div><br style="clear:both;">
	<div class="tabs_content">
		'.$content.'
		<br style="clear:both;">
	</div>
</div>';
}
add_shortcode('tabgroup', 'umbrella_tabgroup_shortcode');

add_action('init', 'tab_btn');
function tab_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
}
/*Tabs*/

/*Accordion*/
function umbrella_accordion_shortcode($atts, $content){
	extract(shortcode_atts( array('title' => ''), $atts));
	return '
		<li>
			<h4><a href="#">'.$title.' <span></span></a></h4>
			<div>
				<p>
					'.$content.'
				</p>
			</div>
		</li>';
}
add_shortcode('accordion', 'umbrella_accordion_shortcode');

function umbrella_accordiongroup_shortcode($atts, $content){
	$content = do_shortcode($content);
	return '<div class="accordion" style="margin-bottom:20px;"><ul>'.$content.'</ul></div>';
}
add_shortcode('accordiongroup', 'umbrella_accordiongroup_shortcode');

add_action('init', 'accordion_btn');
function accordion_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
}
/*Accordion*/

/*List*/
function umbrella_listitem_shortcode($atts, $content){
	return '<li><p>'.$content.'</p></li>';
}
add_shortcode('listitem', 'umbrella_listitem_shortcode');

function umbrella_list_shortcode($atts, $content){
	extract(shortcode_atts( array('type' => ''), $atts));
	$content = do_shortcode($content);
	if($type == "ordered_list"){
		return '<ol class="'.$type.'">'.$content.'</ol>';
	}
	else{
		return '<ul class="'.$type.'">'.$content.'</ul>';
	}
}
add_shortcode('list', 'umbrella_list_shortcode');

add_action('init', 'list_btn');
function list_btn() {	 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}	 
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_plugin' );
		add_filter( 'mce_buttons_3', 'register_button' );
	}	 
}
/*List*/

function register_button( $buttons ) {
	array_push( $buttons, "|", "heading1" );
	array_push( $buttons, "|", "heading2" );
	array_push( $buttons, "|", "heading3" );
	array_push( $buttons, "|", "heading4" );
	array_push( $buttons, "|", "heading5" );
	array_push( $buttons, "|", "buttons" );
	array_push( $buttons, "|", "blockquote" );
	array_push( $buttons, "|", "dropcap" );
	array_push( $buttons, "|", "alert" );
	array_push( $buttons, "|", "tabgroup" );
	array_push( $buttons, "|", "accordion" );
	array_push( $buttons, "|", "list" );
	return $buttons;
}

function add_plugin( $plugin_array ) {
	$plugin_array['heading1'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['heading2'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['heading3'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['heading4'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['heading5'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['buttons'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['blockquote'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['dropcap'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['alert'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['tabgroup'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['accordion'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	$plugin_array['list'] = get_template_directory_uri() . '/shortcodes/tiny_mce_buttons.js';
	return $plugin_array;
}
?>