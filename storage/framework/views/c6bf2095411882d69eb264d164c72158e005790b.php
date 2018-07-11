<?php $__env->startSection('style'); ?>

			
	
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/homepage.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		.glyphicon {  margin-bottom: 10px;margin-right: 10px;}
		small {
		display: block;
		line-height: 1.428571429;
		color: #999;
		}
		.detail img{
			width: 100%;
			height: 220px;
		}
		.first_td{
			border-bottom: 1px solid green;
			width:40%;
		}
	</style>
	<!--Custom Calendar CSS-->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assets/admin/css/smartadmin-production-plugins.min.css')); ?>">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assets/admin/css/mycalendar.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div id="content" class="mycontent">
		<!-- <div class="row mycarousel" style="width:80%;margin:10px auto">
				<?php //include('frontend.home.slide') ?>
		</div> -->
		<div class="row" style="width:80%;margin:10px auto">
			
			<div class="col-lg-12 col-md-12 detail ">
				<?php 
					$events=$list_bookings;
				
					//dd($user_login);
					//echo json_encode($events,JSON_NUMERIC_CHECK);
				 ?>
				<?php echo $__env->make('frontend.guides.inc_detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div><!-- END MAIN CONTENT -->


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>