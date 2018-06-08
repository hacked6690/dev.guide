<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title><?php echo e($layout->system->system_title->title); ?></title>
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		<?php echo $__env->make('layouts.frontend.partials.required_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</head>

	<body class="smart-style-0">
		<?php echo $__env->make('layouts.frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	

		<!-- #MAIN PANEL -->
		<div id="main" role="main">

			<!-- #MAIN CONTENT -->

				<!-- col -->
				<?php echo $__env->yieldContent("content"); ?>

			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		
		<!-- loaded switcher style-->
		<?php echo $__env->make('layouts.frontend.partials.style_switcher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!-- loaded footer page-->
		<?php echo $__env->make('layouts.frontend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<?php echo $__env->make('layouts.frontend.partials.jquery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!-- laoded basic script -->
		<?php echo $__env->make('layouts.frontend.partials.required_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</body>

</html>