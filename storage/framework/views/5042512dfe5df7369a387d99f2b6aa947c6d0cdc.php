<?php 
use  App\Model\Backend\Bookings;
use Illuminate\Support\Facades\Input;
 ?>


<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assets/admin/css/smartadmin-production-plugins.min.css')); ?>">
	<style type="text/css">
		@font-face {
		    font-family: writehand;
		    src: url("<?php echo e(asset('assets/admin/fonts/writehand.ttf')); ?>");
		}
		@font-face {
		    font-family: preyveng;
		    src: url("<?php echo e(asset('assets/admin/fonts/preyveng.ttf')); ?>");
		}
		.booking_table{
			font-family: 'preyveng';
		}
	</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="content">
	
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><?php echo e($layout->label->all_events->title); ?></a></li>
   
  </ul>

  <div class="tab-content booking_table">
    <div id="home" class="tab-pane fade in active">
    	<form method="get" action="/booking_history">
    	<div class="row" style="margin:10px">	
				    <div class="col-sm-4 col-md-2">
				    	<?php echo e(Helper::monthDropdown($filter->month)); ?>

				    </div>
				    <div class="col-sm-4 col-md-2">
				    	<?php echo e(Helper::yearDropdown($filter->year)); ?>

				    </div>
				    <div class="col-sm-3 col-md-3">				        
				        <div class="input-group">
				            <input type="text" value="<?php echo e($filter->search); ?>" class="form-control" placeholder="Search by title" name="search" >
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>
				    </div>	
			
    	</div>
    	<div class="row">
      		<table class="table table-responsive table-hover table-collapse table-bordered">
	      		<tr>
	      			<th>Event ID</th>
	      			<th>Title</th>
	      			<th>Description</th>
	      			<th>Start </th>
	      			<th> End</th>
	      			<th>Action</th>
	      		</tr>
	      		<?php if(count($listings)<=0): ?>
	      			<?php echo Helper::empty_table(6); ?>

	      		<?php endif; ?>
		      		<?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		      		
		      		<?php 
		      			   $enddate = date_create($lb->end); // For today/now, don't pass an arg.
			                $enddate->modify("-1 day");
			               $enddate=$enddate->format("Y-m-d");
		      		 ?>
	      			<tr>
	      				<td><?php echo e($lb->id); ?></td>
	      				<td><?php echo e($lb->title); ?></td>
	      				<td><?php echo e($lb->description); ?></td>
	      				<td><?php echo e($lb->start); ?></td>
	      				<td><?php echo e($enddate); ?></td>
	      				<td>
	      					<a href="/calendardetail/<?php echo e(encrypt($lb->id)); ?>" target="_blank" class="btn btn-primary btn-xs">
	      						 <i class="fas fa-print"></i> View
	      					</a>
	      				</td>
	      			</tr>
	      		
		      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    
      		</table>
      	</div>     
      	<div class="row" >      	
      		<div class="col-lg-2">   
      			<?php echo e(Helper::filterDisplay($display)); ?>		
      		</div>
      		<div class="col-lg-6"></div>
      		<div class="col-lg-4">
      			<?php echo e($listings->appends(Input::except('page'))->links()); ?>

      		</div>
      	</div>
      	</form>
      	
    </div>
   
   
  </div>

</div>

<?php $__env->stopSection(); ?>


		





 
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>