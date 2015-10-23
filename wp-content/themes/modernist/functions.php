<?php
add_editor_style('/css/editor-style.css');

//flush_rewrite_rules(); 'thumbnail'--s80, 'medium', 'large', 'full'
add_image_size( "featured_image", 179 , 98 , false );
add_image_size( "project_preview", 130 , 96 , true );
add_image_size( "project_preview_big", 304 , 188 , false );
add_image_size( "blog", 298 , 187 , false );
add_image_size( "post", 597 , 364 , false );
add_image_size( "project_preview_huge", 796 , 364 , false );
//add_image_size( "s150", 150 , 150 , false );
add_image_size( "Rect0618-300", 300 , 185 , true );
add_image_size( "Rect0618-600", 600 , 371 , true );
add_image_size( "Rect1333-600", 600 , 800 , false );
//add_image_size( "vr185", 185 , 300 , false );
	
include "acf/acf.php";
include "includes/customfields.php";
include "includes/posttypes.php";
include "includes/googlefonts.php";
include "themeoptions/options.php";
include "shortcodes/shortcodes.php";
include "widgets/widgets.php";
	
if ( ! isset( $content_width ) ) { $content_width = 900; }
	
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
	
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
	load_theme_textdomain('um_lang', get_template_directory() . '/lang');
}
	
if(function_exists("register_options_page"))
{
	if(current_user_can('edit_theme_options')){
	$ico_dir = get_template_directory_uri()."/images/icons/small_icons/";
	register_options_page('Main',$ico_dir."umbrella_icon (42).png");
	register_options_page('Footer',$ico_dir."umbrella_icon (42).png");
	register_options_page('Background',$ico_dir."umbrella_icon (42).png");
	register_options_page('Branding',$ico_dir."umbrella_icon (42).png");
	}
}
	
/*Flush Rules On Activation*/
function my_rewrite_flush() {
	global $wp_rewrite;   
	$wp_rewrite->flush_rules(); 
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );
/*Flush Rules On Activation*/
	
/*Add Menu Support*/
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
		'main_menu' => __('Main Menu', 'um_lang'),
		'head_menu' => __('Head Menu', 'um_lang'),
		'foot_menu' => __('Foot Menu', 'um_lang')
		)
	);
}
/*Add Menu Support*/
	
/*Generate Custom Exerpt*/
function excerpt($text, $words=12, $end='...',$limit=120) {
$text = strip_tags($text);
$split = explode(' ',$text);


if (count($split)>$words) {
    $text = join(' ',array_slice($split,0,$words));
}
return mb_substr($text,0,$limit - count($end)).$end;
}
/*Generate Custom Exerpt*/
	
/*Get current url*/
function curPageURL() {
	$pageURL = 'http';
	if(isset($_SERVER["HTTPS"]))
	{
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
/*Get current url*/
	
add_action( 'admin_menu', 'my_remove_menu_pages' );

function my_remove_menu_pages() {
	global $wp_admin_bar;
	remove_menu_page('edit.php?post_type=acf');
}
	
function hex2rgb( $colour ) {
    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
	return "rgba({$r},{$g},{$b},0.95)";
}
	
/*Comment Function*/
function theme_comment($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
	global $post;
	?>
	<div class="comment" id="comment-<?php echo $comment->comment_ID; ?>">
		<div class="user_img">
			<?php echo get_avatar( $comment, 512 ); ?>
		</div>
		<div class="comment_content">
			<h3 class="name"><?php comment_author(); ?></h3>
			<p class="com_date"><?php comment_date( 'd F Y, h:i A', $comment->comment_ID ); ?></p>
			<div class="com_cont"><?php comment_text( $comment->comment_ID  ); ?> </div>
			<a href="<?php echo comment_reply_link(array(),$comment->comment_ID); ?>" class="button button_01"><?php _e("Reply"); ?></a><div style="clear:both;"></div>
		</div>
		<div class="reply_form" data-parent="<?php echo $comment->comment_ID;//echo $comment->comment_parent; ?>">
			<?php comment_form(array('title_reply'=>'Leave a Reply',"comment_notes_after"=>""),$post->ID); ?>
		</div><br style="clear:both;">
	</div>
	<?php
}
/*Comment Function*/


function filter_comment_fields($fields) {
    if(isset($fields['url']))
        unset($fields['url']);
    if(isset($fields['email']))
        unset($fields['email']);
    return $fields;
}
function filter_comment_defaults($fields) {
    if(isset($fields['logged_in_as']))
        unset($fields['logged_in_as']);
    if(isset($fields['email']))
        unset($fields['email']);
    return $fields;
}  
//add_filter('comment_form_default_fields', 'filter_comment_fields');
//add_filter('comment_form_defaults', 'filter_comment_defaults');

//修改搜索结果的链接
function redirect_search() {
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url("/search/").urlencode(get_query_var('s')));
        exit();
    }
}
add_action('template_redirect', 'redirect_search' );

?>