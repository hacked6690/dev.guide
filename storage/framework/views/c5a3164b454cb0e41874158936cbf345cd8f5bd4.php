<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<style type="text/css">
		
		</style>
		<title><?php echo e($layout->system->system_title->title); ?></title>
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo e(asset('assets/admin/js/libs/jquery-2.1.1.min.js')); ?>"><\/script>');
			}
		</script>
		
		<?php
		/*if (Request::is('calendarsbooking'))
		{
		   
		}else{
			$str='
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
				';
			echo $str;
		}*/

		?>
		<!-- #CSS Links -->
		<?php echo $__env->make('layouts.admin.partials.required_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php if(Session::has('locale') AND Session::get('locale') =='kh'): ?>
			<?php echo $__env->make('layouts.admin.partials.kh_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>

		<?php echo $__env->make('layouts.admin.partials.script_label', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</head>

	<body class="smart-style-0">
		
		<!-- #HEADER -->
		<?php echo $__env->make('layouts.admin.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- #NAVIGATION -->
		<?php echo $__env->make('layouts.admin.partials.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- #MAIN PANEL -->
		<div id="main" role="main">

			<!-- #MAIN CONTENT -->

				<!-- col -->
				<?php echo $__env->yieldContent("content"); ?>

			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		<!-- #PLUGINS -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<?php //@include('layouts.admin.partials.jquery') ?>

		<!-- laoded basic script -->
		<?php echo $__env->make('layouts.admin.partials.required_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</body>

</html>

