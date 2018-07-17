<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->layout_item_translates->title); ?>

				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="<?php echo e(route('layout_item_translates.index')); ?>" class="smart-form" method="post">

								<fieldset>

									<div class="row">
										<?php if(Session::has('inserted')): ?>
											<section class="col col-6">
												<?php echo Helper::alert('success', Session::get('inserted'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
									</div>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Layout item <code>[ to be translated ]</code>

												<?php if($errors->has('item_id')): ?>
													<div class="error-badge" id="for-item_id">
														<?php echo Helper::alert('danger', $errors->first('item_id')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="hidden" name="item_id" value="<?php echo e($layout_item->id); ?>">
												<input type="text" value="<?php echo e($layout_item->title); ?>" class="input-xs font-13 border-0 border-bottom-1" readonly>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Language id

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
														<?php if(old('language_id') ==$language['id']): ?>
															<option value="<?php echo e($language['id']); ?>" selected><?php echo e($language['title']); ?></option>
														<?php else: ?>
															<option value="<?php echo e($language['id']); ?>"><?php echo e($language['title']); ?></option>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
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
												<input type="text" name="title" value="<?php echo e(old('title')); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Options
											</label>
											<label class="input">
												<input type="text" name="options" value="<?php echo e(old('options')); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												<?php echo $layout->label->options_note->title; ?>

											</div>
										</section>
									</div>

								</fieldset>

								<footer>
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