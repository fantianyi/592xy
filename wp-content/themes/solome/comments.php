<?php
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) {
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
		?>
		<p class="nocomments"><?php _e( '这篇文章是密码保护、输入密码查看评论。', 'solo' ); ?></p>
		<?php
		return;
	}
}
$oddcomment = '';
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/comments-ajax.js"></script>
<?php if ($comments) : ?>
	<div id="comments">
		<h3><?php comments_number(__('当前尚无任何人冒泡，快来消灭0回复！','solo'), __('1 条评论','solo'), '% '.__('条评论','solo') );?></h3>
	</div>
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=solo_comment&end-callback=solo_end_comment&max_depth=23'); ?>
	</ol>
		<div class="page-nav"><?php paginate_comments_links(); ?></div>
<?php else : if ('open' == $post->comment_status) : ?>
		<div id="comments">
			<h3><?php _e('嗨、骚年、快来消灭0回复。','solo') ?></h3>
		</div>
	<?php else : ?>
		<p class="nocomments"><?php _e( '评论已关闭！', 'solo' ); ?></p>
	<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
	<div id="respond_box">
		<div id="respond">
			<div class="cancel-comment-reply">
				<?php cancel_comment_reply_link(); ?>
			</div>
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p><?php print ( __( '你必须 ' , 'solo' )); ?><a rel="nofollow" href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('登录 </a>发表评论。','solo'); ?></p>
			<?php else : ?>
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<?php if ( $user_ID ) : ?>
						<p><a rel="nofollow" href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;&nbsp;<a rel="nofollow" href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php print (__('退出','solo')); ?></a>
						<?php elseif ( '' != $comment_author ): ?>
							<div class="author"><?php printf(__('<strong>%s</strong>','solo'), $comment_author); ?> 想换名字了？
								<a rel="nofollow" href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info"><?php _e(' 点这','solo'); ?></a></div>
							<?php
							echo '
							<script type="text/javascript" charset="utf-8">';
							if (get_locale()=='zh_TW' || get_locale()=='zh_HK' || get_locale()=='zh_CN'){
								echo 'var changeMsg = "[更改]";
								var closeMsg = "[隐藏]";';
							}else{
								echo 'var changeMsg = "[Change]";
								var closeMsg = "[Hide]";';
							}
							echo '
								function toggleCommentAuthorInfo() {
									jQuery("#comment-author-info").slideToggle("slow", function(){
										if ( jQuery("#comment-author-info").css("display") == "none" ) {
											jQuery("#toggle-comment-author-info").text(changeMsg);
										} else {
											jQuery("#toggle-comment-author-info").text(closeMsg);
										}
									});
								}
								jQuery(document).ready(function(){
									jQuery("#comment-author-info").hide();
								});
							</script>';
							?>
							
						<?php endif; ?>
						<?php if ( ! $user_ID ): ?>
							<div id="comment-author-info">
								<p>
									<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
									<label for="author"><?php _e('Name','solo'); ?><?php if ($req) echo " *"; ?></label>
								</p>
								<p>
									<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
									<label for="email"><?php _e('Email','solo'); ?><?php if ($req) echo " *"; ?></label>
								</p>
								<p>
									<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
									<label for="url"><?php _e('Website','solo'); ?></label>
								</p>
							</div>
						<?php endif; ?>
						<div class="clear"></div>
							<?php wp_smilies();?>

						<p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
						<p>
                        <button class="tm-btn submit" type="submit" name="submit" id="submit" tabindex="5" title="（Ctrl+Enter）也可以发布的哟！！！"><i class="fa fa-send-o"></i> 评论</button>
                        <button class="tm-btn reset" name="reset" type="reset" id="reset" tabindex="6" title="清空已填写内容"><i class="fa fa-refresh"></i> 重置</button>
							
							<?php comment_id_fields(); ?>
						</p>
						<?php do_action('comment_form', $post->ID); ?>
					</form>
					<div class="clear"></div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>