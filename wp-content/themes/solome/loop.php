<article class="setanimate visible">
    <div class="tm-content-inner tm-animate slide-from-bottom">
        <h1> <a class="solotitle" href="<?php the_permalink() ?>" <?php echo solo_blank() ?>><?php the_title(); ?> <?php if (is_sticky()) { ?><img src="<?php bloginfo('template_url'); ?>/assets/img/sticky.gif" class="sticky"/><?php } ?></a> </h1>
        <div class="entry-thumbnail">
            <?php s_thumbnail(180,240);?>
        </div>
        <div class="entry-container">
            <div class="meta"> <span><i class="fa fa-clock-o"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></span>
                <?php if (s_opt( 'solo_author_s')){?><span><a <?php echo solo_blank() ?> href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" rel="nofollow"><i class="fa fa-user"></i> <?php echo get_the_author() ?></a></span><?php }?>
                <?php if (s_opt( 'solo_cat_s')){?><span><i class="fa fa-folder-open-o"></i><?php the_category(', ') ?></span><?php }?>
                <?php if (s_opt( 'solo_comm_s')){?><span><i class="fa fa-comments-o"></i><?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?></span><?php }?> 
                <span><i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?>℃</span>
            </div>
            <p><?php the_excerpt(); ?></p>
            <?php the_tags("<div class=\"tags\"> <i class=\"fa fa-tags\"></i><ul><li>","</li><li>","</li></ul></div>"); ?></div>
    </div>
</article>