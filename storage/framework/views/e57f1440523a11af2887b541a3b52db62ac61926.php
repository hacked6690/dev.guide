<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->user_accounts->title); ?>

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
											<th>Role as</th>
											<th>Name</th>
											<th>Email</th>
											<th>#tel</th>
											<th>Created at</th>
											<th>Updated at</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										<?php if(count($users) ==0): ?>
											<?php echo Helper::empty_table(8); ?>

										<?php endif; ?>

										<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>										
											
									      	<tr>
									      		<?php 
												$user_meta = \Helper::metas('user_meta', ['user_id' => $user->id]);
												 ?>
										        <td><?php echo e(\Helper::indexed($user_accounts, $key)); ?></td>
										        <td>
										        	<code><?php echo e($user->role->title); ?></code>
										        </td>
										        <td><?php echo e(isset($user_meta->name->value)?$user_meta->name->value:"..."); ?></td>
										        <td><?php echo $user->email; ?></td>
										        <td><?php echo e(isset($user_meta->phone->value)?$user_meta->phone->value:"..."); ?></td>
										        <td><?php echo e($user->created_at); ?></td>
										        <td><?php echo e($user->updated_at); ?></td>
										        <td>
										        	<div class="btn-action">
											        	<a href="<?php echo e(route('user_accounts.edit', encrypt($user->id))); ?>" class="btn btn-primary btn-xs">edit</a>
											        	<form action="<?php echo e(route('user_accounts.destroy', encrypt($user->id))); ?>" method="post" class="inline-block">
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
								
								<?php echo \Helper::paginator(['route' => 'user_accounts'], ['items' => $user_accounts], ['display' => $display]); ?>


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