

<?php get_header(); ?>
				
<?php
$page = get_query_var("paged");
if(get_field("number_of_posts")){
    $args = array("posts_per_page"=>get_field("number_of_posts"));
}
else{
    $args = array("posts_per_page"=>8);
}
if($page){
    $args["paged"] = $page;
}
if ($cat) {    
    $args["cat"] = $cat;
}

$the_query = new WP_Query( $args );
//while ( $the_query->have_posts() ) : $the_query->the_post();
//while ( have_posts() ) : the_post();


/* ·ÖÒ³ */
//$page = get_query_var("paged");
if(intval($page) > 1){
    $pre_page = ($page - 1);
    //if($wp_rewrite->using_permalinks()){								
       $pre_query = get_pagenum_link($pre_page);
    //}
    //else{
        //$pre_query = get_pagenum_link()."&page={$pre_page}";
    //}
}
else{
    $pre_query = "";
}

$maxpages = $the_query->max_num_pages;
if(intval($page) < $maxpages){
    if(!$page){
        $next_page = 2;
    }
    else{
        $next_page = ($page + 1);
    }
    //if($wp_rewrite->using_permalinks()){								
    //    $next_query = get_pagenum_link()."/page/{$next_page}/";
    //}
    //else{
    $next_query = get_pagenum_link($next_page);
    //}
}
else{
    $next_query = get_pagenum_link($maxpages);
}

?>

<div class="content">
	<div class="inner_content">	
		
<?php while ( $the_query->have_posts() ) : $the_query->the_post();//var_dump($post); ?>
<div class="archive_geo widget col_620 widget_anim">
    <a href="<?php the_permalink(); ?>"><div class="archive_content">
        <h3><?php echo the_title(); ?></h3>
        <h4><?php echo substr($post->post_date, 0, 10); ?></h4>
    </div>
    </a>
</div>
<?php endwhile;wp_reset_postdata(); ?>
			
<?php if($the_query->max_num_pages > 1): ?>
        <div class="blog_pages widget_anim">
        <div class="page_numbers">
            <ul>
                <?php
$page = get_query_var("paged");
for($i = 1 ; $i <= $maxpages ; $i++){
    $class = "";
    if($i == $page){
        $class = "cur_page";
    }
    if(!$page && $i == 1){
        $class = "cur_page";							
    }
    //if($wp_rewrite->using_permalinks()){
    //    $query = get_pagenum_link($i);
    //}
    //else{
        $query = get_pagenum_link($i);
    //}
    ?>
        <li class="widget_anim" ><a class="<?php echo $class; ?>" href="<?php echo $query; ?>"><?php echo $i; ?></a></li>
    <?php
        }
?>
</ul>
</div>
<div class="page_nav">
<a href="<?php echo $pre_query; ?>" class="widget_anim"><?php _e("PREV","um_lang"); ?></a>
<a href="<?php echo $next_query; ?>" class="widget_anim"><?php _e("NEXT","um_lang"); ?></a>
</div>
</div>
<?php endif; ?>
				
</div><!-- /inner_content-->	
</div><!-- /content-->
<?php get_footer();?>
</div><!--/wrapper-->
</body>
</html>