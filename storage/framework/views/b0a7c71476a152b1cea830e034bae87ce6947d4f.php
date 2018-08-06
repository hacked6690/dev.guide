<?php $__env->startSection('style'); ?>
	

	<style type="text/css">
		.mycontainer{
			width: 90%;
			margin-top:20px;
			border:2px groove gray;
			/*padding-bottom: 50px;*/
		}
		.mycontainer .col-lg-6:first-child{
			border-right: 1px dashed green;
			padding-bottom: 50px;
		}
	
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div id="content">
	<div class="wrapper">
		<div class="container mycontainer" >
			<div class="col-lg-6">
				<center>
					<h1><?php echo e($layout->label->guide->title); ?></h1>
					<h3 class="text text-success"><?php echo e($layout->label->register_note->title); ?></h3>
					<a target="_blank" href="/guides/create" class="btn btn-primary"> <i class="fas fa-user"></i>  &nbsp;<?php echo e($layout->label->register_account->title); ?></a>
					<hr/>
				</center>
				<center>
				<iframe width="95%" height="480" 
					src="https://www.youtube.com/embed/3Sb9fnAuLWs" frameborder="0" allow="autoplay; 
					encrypted-media" allowfullscreen>
				</iframe>
				</center>
			</div>
			<div class="col-lg-6">
				<center>
					<h1><?php echo e($layout->label->traveller->title); ?></h1>
					<h3 class="text text-success"><?php echo e($layout->label->register_note->title); ?></h3>
					<a target="_blank" href="/travellers/create" class="btn btn-primary"> <i class="fas fa-user"></i>  &nbsp;<?php echo e($layout->label->register_account->title); ?></a>
					<hr/>
				</center>
				<center>
				<iframe width="95%" height="480" 
					src="https://www.youtube.com/embed/3Sb9fnAuLWs" frameborder="0" allow="autoplay; 
					encrypted-media" allowfullscreen>
				</iframe>
				</center>
			</div>
		</div>
	</div><!--end wrapper class-->
	</div>
	<!-- END MAIN CONTENT -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>