<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->content_terms->title); ?>

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
											<th>Id</th>
											<th>Parent</th>
											<th>Taxonomy</th>
											<th>Slug</th>
											<th>Title</th>
											<th>Term group</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										<?php if(count($content_terms) ==0): ?>
											<?php echo Helper::empty_table(7); ?>

										<?php endif; ?>

										<?php $__currentLoopData = $content_terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $content_term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      	<tr>
										        <td><?php echo e(\Helper::indexed($content_terms, $key)); ?></td>
										        <td>
										        	<code>
										        		<?php echo e($content_term->term_id); ?>

										        	</code>
											        <a id="p<?php echo e($content_term->term_id); ?>" class="hyper"></a>
										        </td>
										        <td>
										        	<a href="#p<?php echo e($content_term->parent); ?>">
										        		<?php echo e($content_term->parent); ?>

										        	</a>
										        </td>
										        <td>
										        	<span class="font-12 txt-color-blue">
										        		<?php echo e($content_term->taxonomy); ?>

										        	</span>
										        </td>
										        <td>
										        	<code>
										        		<?php echo e($content_term->slug); ?>

										        	</code>
										        </td>
										        <td>
										        	<div class="truncate-475" title="<?php echo e($content_term->title); ?>">
										        		<?php echo $content_term->title; ?>

										        	</div>
										        </td>
										        <td><?php echo e($content_term->term_group); ?></td>
										        <td>
										        	<div class="btn-action">
											        	<a href="<?php echo e(route('content_terms.edit', encrypt($content_term->term_id))); ?>" class="btn btn-primary btn-xs">edit</a>
											        	<form action="<?php echo e(route('content_terms.destroy', encrypt($content_term->term_id))); ?>" method="post" class="inline-block">
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

								<?php echo \Helper::paginator(['route' => 'content_terms'], ['items' => $content_terms], ['display' => $display]); ?>


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