<?php $__env->startSection('style'); ?>

	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/homepage.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		.glyphicon { margin-right:5px;}
		.section-box h2 { margin-top:0px;}
		.section-box h2 a { font-size:15px; }
		.glyphicon-heart { color:#e74c3c;}
		.glyphicon-comment { color:#27ae60;}
		.separator { padding-right:5px;padding-left:5px; }
		.section-box hr {margin-top: 0;margin-bottom: 5px;border: 0;border-top: 1px solid rgb(199, 199, 199);}	
		.price{
			color:#0896ff;
		}
		.perday{
			color:#93a1a1;
		}
		.mycontent .guideprofile{
			/*height:140px;
			width: 140px;*/
			width:80%;
			min-height: 130px;
			max-height: 130px;
		}
		.table-footer .sky-form{
			border:0px;
		}
		.pagination{
			margin:0px;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>





	<div id="content" class="mycontent">
		<div class="row mycarousel" style="width:90%;margin:10px auto">
				<?php echo $__env->make('frontend.home.slide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<div class="row" style="width:90%;margin:10px auto">
			<div class="col-lg-3 col-md-3" style="padding-left:0px">
				<?php echo $__env->make('frontend.home.leftsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			<div class="col-lg-9 col-md-9">
				<?php echo $__env->make('frontend.guides.inc_listing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div><!-- END MAIN CONTENT -->
	

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>