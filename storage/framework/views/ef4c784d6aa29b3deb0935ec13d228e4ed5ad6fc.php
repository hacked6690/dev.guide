<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->gp->title); ?>

				</h1>
			</div>

		</div>
		<div class="row">
				<?php if(Session::has('updated')): ?>
					<section>
						<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

					</section>
				<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="<?php echo e(route('guideprice.update', encrypt($guideprice->id))); ?>" class="smart-form" method="post">
							<?php echo e(csrf_field()); ?>

								<fieldset>

									<div class="row">
										<?php if(Session::has('inserted')): ?>
											<section class="col col-6">
												<?php echo Helper::alert('success', Session::get('inserted'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
										<?php if(Session::has('warning')): ?>
											<section class="col col-6">
												<?php echo Helper::alert('warning', Session::get('warning'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
									</div>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<?php echo e($layout->label->language->title); ?> <code>*</code>
												<?php if($errors->has('language_id')): ?>
													<div class="error-badge" id="for-language_id">
														<?php echo Helper::alert('danger', $errors->first('language_id')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="language_id">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if($guideprice->language_id ==$language->term_id): ?>
															<option value="<?php echo e($language->term_id); ?>" selected><?php echo e($language->title); ?></option>
														<?php else: ?>
															<option value="<?php echo e($language->term_id); ?>"><?php echo e($language->title); ?></option>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<?php echo e($layout->label->province->title); ?> <code>*</code>

												<?php if($errors->has('province_id')): ?>
													<div class="error-badge" id="for-province_id">
														<?php echo Helper::alert('danger', $errors->first('province_id')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="province_id">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if($guideprice->province_id ==$province->term_id): ?>
															<option value="<?php echo e($province->term_id); ?>" selected><?php echo e($province->title); ?></option>
														<?php else: ?>
															<option value="<?php echo e($province->term_id); ?>"><?php echo e($province->title); ?></option>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<?php echo e($layout->label->set_default->title); ?> <code>*</code>

												<?php if($errors->has('boolean_id')): ?>
													<div class="error-badge" id="for-boolean_id">
														<?php echo Helper::alert('danger', $errors->first('boolean_id')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="boolean_id">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $booleans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boolean): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if($guideprice->default ==$boolean->title): ?>
															<option value="<?php echo e($boolean->title); ?>" selected><?php echo e($boolean->title); ?></option>
														<?php else: ?>
															<option value="<?php echo e($boolean->title); ?>"><?php echo e($boolean->title); ?></option>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<?php echo e($layout->label->guide_price->title); ?> <code>*<?php echo e($layout->label->usd->title); ?> <code>*</code></code>

												<?php if($errors->has('price')): ?>
													<div class="error-badge" id="for-slug">
														<?php echo Helper::alert('danger', $errors->first('price')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="price" value="<?php echo e($guideprice->price); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											
										</section>
									</div>
									
									
									
									
									
									

								</fieldset>

								<footer>
									<?php echo e(method_field('put')); ?>

									<?php echo e(csrf_field()); ?>

									<button type="submit" class="btn btn-primary">
										<?php echo e($layout->label->save->title); ?>

									</button>									
								</footer>
							</form>

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