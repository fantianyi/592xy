<div class="tm-featured-slide1 flexslider">
  <ul class="slides">
  <?php for ($i=1; $i <=5 ; $i++) { ?>
    <li> <a <?php echo solo_blank() ?> href="<?php echo s_opt('slide_href_'.$i.''); ?>"> <img src="<?php bloginfo('template_url'); ?>/assets/img/loading.gif" data-original="<?php echo s_opt('slide_src_'.$i.''); ?>" alt="<?php echo s_opt('slide_title_'.$i.''); ?>"> </a>
      <h2 class="flex-caption"> <?php echo s_opt('slide_title_'.$i.''); ?> </h2>
      <p class="flex-caption"> <?php echo s_opt('slide_miaoshu_'.$i.''); ?> </p>
    </li>
    <?php }	?>
  </ul>
</div>
