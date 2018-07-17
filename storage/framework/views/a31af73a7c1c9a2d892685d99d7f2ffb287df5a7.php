<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->privileges->title); ?>					
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-12">

							<?php if(Session::has('deleted')): ?>
								<section>
									<?php echo Helper::alert('success', Session::get('deleted'), 'block font-15'); ?>

								</section>
							<?php endif; ?>

							<div class="table-responsive">

								<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Slug</th>
											<th>Title</th>
											<th>Parent</th>
											<th>Description</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										<?php if(count($privileges) ==0): ?>
											<?php echo Helper::empty_table(6); ?>

										<?php endif; ?>

										<?php $__currentLoopData = $privileges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $privilege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      	<tr>
										        <td><?php echo e(\Helper::indexed($privileges, $key)); ?></td>
										        <td>
										        	<code><?php echo e($privilege->slug); ?></code>
										        </td>
										        <td><?php echo e($privilege->title); ?></td>
										        <td>
										        	<?php if($privilege->parent_title !=''): ?>
										        		<span class="font-12 font-light txt-color-blue">
										        			<?php echo $privilege->parent_title; ?>

										        		</span>
										        	<?php endif; ?>
										        </td>
										        <td><?php echo e($privilege->description); ?></td>
										        <td>
										        	<div class="btn-action">
											        	<a href="<?php echo e(route('privileges.edit', encrypt($privilege->id))); ?>" class="btn btn-primary btn-xs">edit</a>
											        	<form action="<?php echo e(route('privileges.destroy', encrypt($privilege->id))); ?>" method="post" class="inline-block">
															<?php echo e(method_field('delete')); ?>

															<?php echo e(csrf_field()); ?>

															<button type="button" class="btn btn-danger btn-xs jscfm">Delete</button>
														</form>
													</div>
										        </td>
									      	</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>

							</div>
							<!-- End + div.table-responsive -->

							<div class="table-footer">

								<?php echo \Helper::paginator(['route' => 'privileges'], ['items' => $privileges], ['display' => $display]); ?>

								
							</div>

						</div>
					</div>
					<!-- End div.row +child -->

				</div>
				<!-- End .well class -->

			</div>
		</div>
		<!-- End div.row +parent -->

	</div>
	<!-- END MAIN CONTENT -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>