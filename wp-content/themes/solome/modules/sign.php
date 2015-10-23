<?php if ( wp_is_mobile() ){} else {?>
<div class="tm-featured">
  <ul class="hot">
  <li> <a <?php echo solo_blank() ?> href="<?php echo s_opt('slide_top_url')?>" class="tm-modal">
      <h3><?php echo s_opt('solo_top_title')?></h3>
      <!--范天毅：移除 thumbnail-->
      <img src="<?php echo s_opt('slide_top_img')?>" style="width:369px; height:369px" alt="<?php echo s_opt('solo_top_title')?>"> </a> </li>
  <?php
$args = array(
	'posts_per_page' => 3,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);
query_posts( $args ); while ( have_posts() ) : the_post();?>
    <li> <a <?php echo solo_blank() ?> href="<?php the_permalink(); ?>">
      <h3><?php the_title(); ?></h3>
      <!--范天毅：移除 thumbnail-->
      <img src="<?php echo s_thumbnail_src(); ?>" style="width:180px; height:240px" alt="<?php the_title(); ?>"/> </a> </li>
<?php endwhile;wp_reset_query(); ?>
  </ul>
  <div class="clear"></div>
</div>
<?php }?>