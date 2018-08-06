<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title><?php echo e($layout->system->system_title->title); ?></title>
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"><\/script>');
			}
		</script>


		<!-- #CSS Links -->
		<?php echo $__env->make('layouts.frontend.partials.required_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
	</head>

	<body class="smart-style-0">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=1724749201072528&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



		<?php echo $__env->make('layouts.frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	

		<!-- #MAIN PANEL -->
		<div id="main" role="main" style="min-height:700px" >

			<!-- #MAIN CONTENT -->

				<!-- col -->
				<?php echo $__env->yieldContent("content"); ?>

			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		<div class="myfooter">
		<!-- loaded switcher style-->
		<?php //@include('layouts.frontend.partials.style_switcher') ?>
		<!-- loaded footer page-->
		<?php echo $__env->make('layouts.frontend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		</div>
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<?php //@include('layouts.frontend.partials.jquery') ?>
		<!-- laoded basic script -->
		<?php echo $__env->make('layouts.frontend.partials.required_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</body>

</html>