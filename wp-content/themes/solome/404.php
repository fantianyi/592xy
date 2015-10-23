<?php get_header();?>
<div id="tm-page-body">
			<div id="tm-template-default-fullwidth" class="tm-container">
				<div class="page-content">
					<div class="page-content-inner tm-content">
						<div class="tm-row" style="background:#eee; padding:50px 0">
							<div class="tm-wrap">
								<div class="header-line-center-bottom">
									<h1>哎呀,这个页面无法找到!</h1>
								</div>
								<div class="tm-error">
									<span>404</span>
								</div>
								<form action="<?php bloginfo('home'); ?>" method="get" style="text-align:center">
									<p>
										找不到你需要的东西吗?花一点时间,在下面进行搜索!
									</p>
									<input type="text" placeholder="搜索..." class="tm-input" style="width:30%">
									<button role="button" type="submit" class="tm-button">搜索</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--page-content-->
			</div>
			<!--tm-template-->
		</div>
<?php get_footer();?>