<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->languages->title); ?>

				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="<?php echo e(route('languages.update', encrypt($language->id))); ?>" class="smart-form" method="post">

								<fieldset>

									<div class="row">
										<?php if(Session::has('updated')): ?>
											<section class="col col-6">
												<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
									</div>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Slug

												<?php if($errors->has('slug')): ?>
													<div class="error-badge" id="for-slug">
														<?php echo Helper::alert('danger', $errors->first('slug')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="slug" value="<?php echo e(old('slug') ? old('slug') :$language->slug); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												<?php echo $layout->label->slug_note->title; ?>

											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Title

												<?php if($errors->has('title')): ?>
													<div class="error-badge" id="for-title">
														<?php echo Helper::alert('danger', $errors->first('title')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="title" value="<?php echo e(old('title') ? old('title') :$language->title); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Priority

												<?php if($errors->has('priority')): ?>
													<div class="error-badge" id="for-priority">
														<?php echo Helper::alert('danger', $errors->first('priority')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="priority" value="<?php echo e(old('priority') ? old('priority') :$language->priority); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Set default

												<?php if($errors->has('set_default')): ?>
													<div class="error-badge" id="for-set_default">
														<?php echo Helper::alert('danger', $errors->first('set_default')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="set_default" value="<?php echo e(old('set_default') ? old('set_default') :$language->set_default); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Icon
											</label>
											<label class="input">
												<input type="text" name="icon" value="<?php echo e(old('icon') ? old('icon') :$language->icon); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Options
											</label>
											<label class="input">
												<input type="text" name="options" value="<?php echo e(old('options') ? old('options') :$language->options); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												<?php echo $layout->label->options_note->title; ?>

											</div>
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