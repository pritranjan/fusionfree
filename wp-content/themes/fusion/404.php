<?php
get_header('main');
?>
<!-- Error  Section start -->
<div class="error-wrap ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="error-content">
					<img src="<?php echo MK_ASSETS_DIR_URL?>images/404.jpg" alt="Iamge">
					<h2>Oops! Page Not Found</h2>
					<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
					<a href="<?php echo home_url();?>" class="btn style1">Back To Home</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Error  Section end -->
<?php
// the_content();
get_footer('main');
?>