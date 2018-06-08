<?php $__env->startSection('breadcrumb'); ?>
	<ol class="breadcrumb">
		<li>Home</li>
		<li>Dashboard</li>
	</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">

			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-home"></i>
				Dashboard
			<span>
				Subtitle
			</span>
		</h1>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>