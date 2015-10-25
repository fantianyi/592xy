<?php
$menus = get_nav_menu_locations();
$main_menu_items = wp_get_nav_menu_items($menus["main_menu"]);
$this_url = curPageURL();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" <?php language_attributes(); ?>>
<head>
    <meta property="qc:admins" content="10416642176512016367" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<title><?php bloginfo("name"); ?> : <?php the_title(); ?></title>
    <link rel="shortcut icon" href="http://www.592xy.cn/wp-content/themes/modernist/images/web/64@592xy.ico">
	<?php
		wp_enqueue_style("main", get_template_directory_uri()."/style/global.css" , false, "1.0");
		wp_enqueue_style("fonts", get_template_directory_uri()."/style/fonts/stylesheet.css" , false, "1.0");
		wp_enqueue_style("scrollpane_css", get_template_directory_uri()."/style/jquery.jscrollpane.css" , false, "1.0");
		wp_enqueue_style("editor-style", get_template_directory_uri()."/css/editor-style.css" , false, "1.0");
		wp_enqueue_style("liteaccordion", get_template_directory_uri()."/scripts/liteaccordion.css" , false, "1.0");
		if(get_field("enable_responsive","options")){
			wp_enqueue_style("responsive", get_template_directory_uri()."/style/responsive.css" , false, "1.0");
		}
		wp_enqueue_style("anim", get_template_directory_uri()."/style/anim.css" , false, "1.0");
		if(get_field("skins","options") == "Dark"){
			wp_enqueue_style("dark_skin", get_template_directory_uri()."/style/dark.css" , false, "1.0");
		}
		if ( is_singular() && get_option( 'thread_comments' ) ){
			wp_enqueue_script( 'comment-reply' );
		}
	?>
	<?php wp_enqueue_script( 'jquery' ); ?>
	<?php 
		wp_enqueue_script("umbrella_twitterfeed", get_template_directory_uri()."/scripts/jquery.twitterfeed.js" , false, "1.0"); 
		wp_enqueue_script("css3_prefix", get_template_directory_uri()."/scripts/prefixfree.min.js" , false, "1.0"); 
		wp_enqueue_script("move_js", get_template_directory_uri()."/scripts/move.js" , false, "1.0"); 
		wp_enqueue_script("jquery.scrollTo", get_template_directory_uri()."/scripts/jquery.scrollTo-1.4.3.1-min.js" , false, "1.0"); 
		wp_enqueue_script("scrollpane", get_template_directory_uri()."/scripts/jquery.jscrollpane.min.js" , false, "1.0"); 
		wp_enqueue_script("mousewheel", get_template_directory_uri()."/scripts/jquery.mousewheel.js" , false, "1.0"); 
		wp_enqueue_script("move_js", get_template_directory_uri()."/scripts/move.js" , false, "1.0"); 
		wp_enqueue_script("modernizr", get_template_directory_uri()."/scripts/modernizr.custom.02353.js" , false, "1.0"); 
		wp_enqueue_script("easing", get_template_directory_uri()."/scripts/jquery.easing.1.3.js" , false, "1.0"); 
		wp_enqueue_script("liteaccordion_script", get_template_directory_uri()."/scripts/liteaccordion.jquery.js" , false, "1.0");
		if(get_field("animation","options")){
			wp_enqueue_script("global", get_template_directory_uri()."/scripts/global.js" , false, "1.0"); 
		}
		wp_enqueue_script("script", get_template_directory_uri()."/scripts/script.js" , false, "1.0");
		wp_enqueue_script("jquery.qrcode", "http://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js" , false, "1.0");
		
		/*Supersized*/
		$template = basename(get_page_template());
		if($template == "template-home.php"){
			wp_enqueue_style("supersized", get_template_directory_uri()."/css/supersized.css" , false, "1.0");
			wp_enqueue_script("supersized2", get_template_directory_uri()."/scripts/supersized.3.2.7.js" , false, "1.0"); 
			wp_enqueue_script("supersized3", get_template_directory_uri()."/scripts/supersized.shutter.js" , false, "1.0"); 
		}
		/*Supersized*/
	?>
	<style>
	.error{
		border:1px solid #DC1430 !important;
	}
	</style>
	<?php if(get_field("google_analytics","options")): ?>
		<?php the_field("google_analytics","options"); ?>
	<?php endif; ?>
	
	<?php if(get_field("custom_css","options")): ?>
	<style>
		<?php the_field("custom_css","options"); ?>
	</style>
	<?php endif; ?>
	<?php if(get_field("custom_php","options")): ?>
		<?php eval(get_field("custom_php","options")); ?>
	<?php endif; ?>
	<?php if(get_field("animation","options")): ?>
	<style>
		.widget_anim{
			transform: scale(1.2);
			opacity:0;
		}
	</style>
	<?php endif; ?>
	
	<?php if(get_field("favicon","options")): ?>
		<link rel="icon" type="image/png" href="<?php $img = get_field("favicon","options");echo $img["url"]; ?>">
	<?php endif; ?>
	
	<?php wp_head(); ?>
	<?php include "headingoptions.php"; ?>
</head>

<div id="ajax_wrap"></div>
<div id="ajax_loader">
<div id="facebookG">
<div id="blockG_1" class="facebook_blockG">
</div>
<div id="blockG_2" class="facebook_blockG">
</div>
<div id="blockG_3" class="facebook_blockG">
</div>
</div>
</div>
<style>
div#ajax_wrap
{
	position:fixed;
	z-index:9999998;
	background:#fff;
	opacity:0.5;
	width:50000px;
	height:50000px;
	top: 0;
}
div#ajax_loader{
	position:fixed;
	left: 50%;
    top: 50%;
	z-index:9999999;
}
#facebookG{
width:64px}

.facebook_blockG{
background-color:#D9D9D9;
border:2px solid #;
float:left;
height:46px;
margin-left:3px;
width:12px;
-webkit-animation-name:bounceG;
-webkit-animation-duration:1s;
-webkit-animation-iteration-count:infinite;
-webkit-animation-direction:linear;
-webkit-transform:scale(0.7);
-moz-animation-name:bounceG;
-moz-animation-duration:1s;
-moz-animation-iteration-count:infinite;
-moz-animation-direction:linear;
-moz-transform:scale(0.7);
-o-animation-name:bounceG;
-o-animation-duration:1s;
-o-animation-iteration-count:infinite;
-o-animation-direction:linear;
-o-transform:scale(0.7);
-ms-animation-name:bounceG;
-ms-animation-duration:1s;
-ms-animation-iteration-count:infinite;
-ms-animation-direction:linear;
-ms-transform:scale(0.7);
opacity:0.1;
}

#blockG_1{
-webkit-animation-delay:0.3s;
-moz-animation-delay:0.3s;
-o-animation-delay:0.3s;
-ms-animation-delay:0.3s;
}

#blockG_2{
-webkit-animation-delay:0.4s;
-moz-animation-delay:0.4s;
-o-animation-delay:0.4s;
-ms-animation-delay:0.4s;
}

#blockG_3{
-webkit-animation-delay:0.5s;
-moz-animation-delay:0.5s;
-o-animation-delay:0.5s;
-ms-animation-delay:0.5s;
}

@-webkit-keyframes bounceG{
0%{
-webkit-transform:scale(1.2);
opacity:1}

100%{
-webkit-transform:scale(0.7);
opacity:0.1}

}

@-moz-keyframes bounceG{
0%{
-moz-transform:scale(1.2);
opacity:1}

100%{
-moz-transform:scale(0.7);
opacity:0.1}

}

@-o-keyframes bounceG{
0%{
-o-transform:scale(1.2);
opacity:1}

100%{
-o-transform:scale(0.7);
opacity:0.1}

}

@-ms-keyframes bounceG{
0%{
-ms-transform:scale(1.2);
opacity:1}

100%{
-ms-transform:scale(0.7);
opacity:0.1}

}
</style>
	
<?php 
	$background = '';
	if(is_page()){
		if($template == "template-home.php"){
			$images = get_field("background_images");
			$divs = array();
			if(count($images)){
				$display = "opacity:1;";
				foreach($images as $image){					
					$grayscale = get_field("grayscale_images","options") ? "grayscale" : "";
					$img = $image["image"]["url"];
					$tmparr = array();
					$tmparr["image"] = $img;
					array_push($divs,$tmparr);
					//$divs .= "<div class='{$grayscale} bg' style='background: url(\"{$img}\") no-repeat center center fixed;background-size: cover;{$display}'></div>";
					//$display = "opacity:0;";
				}
			}
		}else{
			$image = get_field("background_image");
			if($image){
				$background = 'style=\'background: url("'.$image['url'].'") no-repeat center center fixed;background-size: cover;\'';
			}
			else{
				$color = get_field("no_image_color","options");
				$background = "style='background:{$color}'";
			}
		}
	}else if( $post && $post->post_type == "project_post"){
		$image = get_field("projects_background","options");
		if($image["url"]){
			$background = 'style=\'background: url("'.$image['url'].'") no-repeat center center fixed;background-size: cover;\'';
		}
		else{
			$color = get_field("no_image_color","options");
			$background = "style='background:{$color}'";
		}
	}else{
		$image = get_field("posts_background","options");
		if($image["url"]){
			$background = 'style=\'background: url("'.$image['url'].'") no-repeat center center fixed;background-size: cover;\'';
		}
		else{
			$color = get_field("no_image_color","options");
			$background = "style='background:{$color}'";
		}
	}
	if(!isset($divs)){
		$divs = array(""=>"");
	}
?>
<body style="background-color:<?php the_field("background_image"); ?>" <?php body_class(); ?>>
	<?php if($template != "template-home.php"): ?>
	<div <?php echo $background; ?> class="<?php if(get_field("grayscale_images","options")){echo "grayscale"; } ?> bg"></div>
	<?php else: ?>
	<div id="backgroud">
		<script>
		var slides = <?php echo json_encode($divs); ?>;
		jQuery(document).ready(function(){				
				jQuery.supersized({
					autoplay : true,
					slide_links	:false,
					slide_interval:3000,
					transition:1,
					transition_speed:700,
					slideshow:1,
					slides : slides,
				})
		});
		</script>
		<?php if(get_field("grayscale_images","options")): ?>
		<style>
			#supersized img{
				filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+, Firefox on Android */
				filter: gray; /* IE6-9 */
				-webkit-filter: grayscale(100%); /* Chrome 19+, Safari 6+, Safari 6+ iOS */
			}
		</style>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="wrapper">
		<!--<div class="content">
			<ul class="mobile_social_media">
				<?php if(get_field("facebook_profile","options")): ?>
				<li><a href="<?php the_field("facebook_profile","options"); ?>" class="fb"></a></li>
				<?php endif; ?>
				<?php if(get_field("twitter_profile","options")): ?>
					<li><a href="<?php the_field("twitter_profile","options"); ?>" class="tw"></a></li>
				<?php endif; ?>
			</ul>
		</div><br style="clear:both;">-->
        <div class="container">
		    <div class="header bg_color">
                <div class="row clearfix">
                    <div class="col-xs-4 col-sm-2 col-lg-1">
			            <div class="logo"><a href="<?php bloginfo("wpurl"); ?>">
				            <img src="http://www.592xy.cn/wp-content/themes/modernist/images/web/100@592xy.png" />					
			            </a></div>
                    </div>			        
                    <div class="col-xs-0 col-sm-4 col-lg-7">
			            <!--<ul class="mobile_navigation dropped">
				            <a href="#" class="nav_item">Navigation <span></span></a>
				            <?php
				            $current_menu = get_nav_menu_locations();
				            $current_menu = $current_menu["main_menu"];
				            $menu_items = wp_get_nav_menu_items($current_menu);
				            $this_url = curPageURL();
				            if($menu_items):
				            foreach($menu_items as $menu):
				            ?>
					            <li><a href="<?php echo $menu->url; ?>" class="<?php if($this_url == $menu->url): ?> current<?php endif; ?>"><?php echo $menu->title; ?></a></li>
				            <?php
				            endforeach;
				            endif;
				            ?>
			            </ul>-->
                        <div id="header_center_sidebar" class="hidden-xs">     
                            <?php dynamic_sidebar('header_center_sidebar'); ?>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-lg-4">
                        <div id="header_right_sidebar">     
                            <?php dynamic_sidebar('header_right_sidebar'); ?>
                        </div>
                    </div>
                </div><!--/row-->
			    
		    </div><!--Close Header-->   
                    
            <div class="top-nav" id="js-top-nav">
    	        <div class="nav-box">
                    <ul>
<?php foreach($main_menu_items as $menu): ?>
					    <li class="li-<?php echo $menu->post_excerpt; ?>"><a href="<?php echo $menu->url; ?>" class="<?php if($this_url == $menu->url): ?> on<?php endif; ?>" title="<?php echo $menu->title; ?>"></a></li>
<?php endforeach; ?>    
                    </ul>
                </div>
            </div>
