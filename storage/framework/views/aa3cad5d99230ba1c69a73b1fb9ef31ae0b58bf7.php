<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->layout_items->title); ?>

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
											<th title="Parent">pr</th>
											<th>Category</th>
											<th>Slug</th>
											<th>Title</th>
											<th>Url</th>
											<th>Icon</th>
											<th>Trslted</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										<?php if(count($layout_items) ==0): ?>
											<?php echo Helper::empty_table(10); ?>

										<?php endif; ?>

										<?php $__currentLoopData = $layout_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $layout_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      	<tr>
										        <td><?php echo e(\Helper::indexed($layout_items, $key)); ?></td>
										        <td>
										        	<?php if($layout_item->parent !=''): ?>
										        		<code><?php echo e($layout_item->parent); ?></code>
										        	<?php endif; ?>
										        </td>
										        <td>
										        	<span class="font-11">
										        		<?php echo e($layout_item->layout_category); ?>

										        	</span>
										        </td>
										        <td>
										        	<code><?php echo e($layout_item->slug); ?></code>
										        </td>
										        <td><?php echo $layout_item->title; ?></td>
										        <td>
										        	<span class="font-12">
										        		<?php echo e($layout_item->url); ?>

										        	</span>
										        </td>
										        <td><?php echo $layout_item->icon; ?></td>
										        <td>
										        	<?php if($layout_item->translated !=''): ?>
										        		<code><?php echo e($layout_item->translated); ?></code>
										        	<?php endif; ?>
										        </td>
										        <td>
										        	<div class="btn-action">
											        	<a href="<?php echo e(route('layout_item_translates.create', encrypt($layout_item->id))); ?>" class="btn btn-default btn-xs">trsl</a>
											        	<a href="<?php echo e(route('layout_items.edit', encrypt($layout_item->id))); ?>" class="btn btn-primary btn-xs">edt</a>
											        	<form action="<?php echo e(route('layout_items.destroy', encrypt($layout_item->id))); ?>" method="post" class="inline-block">
															<?php echo e(method_field('delete')); ?>

															<?php echo e(csrf_field()); ?>

															<button type="button" class="btn btn-danger btn-xs jscfm">Del</button>
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

								<?php echo \Helper::paginator(['route' => 'layout_items'], ['items' => $layout_items], ['display' => $display]); ?>


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