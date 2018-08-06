<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/homepage.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<style type="text/css">
	.img_status{
		width: 35px;
	}
	.wd-20{
		width:20px;
	}
	.wd-30{
		width:30px;
	}
	.wd-40{
		width:40px;
	}
	.wd-50{
		width:50px;
	}
	.wd-60{
		width:60px;
	}
	.wd-70{
		width:70px;
	}
	.wd-80{
		width:80px;
	}
	.wd-90{
		width:90px;
	}
	.wd-100{
		width:100px;
	}
	.wd-120{
		width:120px;
	}
	.wd-140{
		width:140px;
	}
	.wd-160{
		width:160px;
	}
	.wd-180{
		width:180px;
	}
	.bg-header{
		
	}
	.mysearch{
		width:100%;
		padding:10px;
	}
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="table table-responsive">
	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Message</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($c->fullname_en); ?></td>
					<td><?php echo e($c->email); ?></td>
					<td><?php echo e($c->telephone); ?></td>
					<td><?php echo e($c->message); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<div class="col-lg-12">
				<?php echo $contacts->appends(Input::except('page'))->links(); ?>

	</div>
</div>




		
<?php $__env->stopSection(); ?>






 
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>