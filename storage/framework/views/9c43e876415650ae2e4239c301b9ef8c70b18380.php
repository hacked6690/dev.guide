<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->create_content_term->title); ?>

				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="<?php echo e(route('content_terms.index')); ?>" class="smart-form" method="post">

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
												Taxonomy <code>*</code>

												<?php if($errors->has('taxonomy')): ?>
													<div class="error-badge" id="for-taxonomy">
														<?php echo Helper::alert('danger', $errors->first('taxonomy')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="taxonomy">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $taxonomies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxonomy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

														<?php if(old('taxonomy') ==$taxonomy->taxonomy): ?>
															<option value="<?php echo e($taxonomy->taxonomy); ?>" selected><?php echo e($taxonomy->taxonomy); ?></option>
														<?php else: ?>
															<option value="<?php echo e($taxonomy->taxonomy); ?>"><?php echo e($taxonomy->taxonomy); ?></option>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<span class="txt-color-blue">
													Don't has taxonomy!
												</span>

												<?php if($errors->has('new_taxonomy')): ?>
													<div class="error-badge" id="for-new_taxonomy">
														<?php echo Helper::alert('danger', $errors->first('new_taxonomy')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="toggle txt-color-red">
												<input name="onoff" class="onoff" data-target="new_taxonomy" type="checkbox" <?php echo old('onoff') ? 'checked' :''; ?>>
												<i data-swchon-text="ON" data-swchoff-text="OFF"></i> Create one →
											</label>
										</section>
									</div>
									<div class="row onoff_input <?php echo old('onoff') ? '' :'hidden'; ?>">
										<section class="col col-6 flexibled-error">
											<label class="input">
												<input type="text" <?php echo old('onoff') ? 'name="new_taxonomy"' :'tmp-name="new_taxonomy"'; ?>

													value="<?php echo e(old('new_taxonomy')); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error atoslug-upper">
											<label class="label">
												Slug <botton class="btn btn-xs btn-primary atoslug" data-target="slug" data-slugof="term">auto</botton>

												<?php if($errors->has('slug')): ?>
													<div class="error-badge" id="for-slug">
														<?php echo Helper::alert('danger', $errors->first('slug')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="slug" value="<?php echo e(old('slug')); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												<?php echo $layout->label->slug_note->title; ?>

											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-8 flexibled-error">
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
										<section class="col col-6 flexibled-error">
											<label class="label">
												Term group

												<?php if($errors->has('term_group')): ?>
													<div class="error-badge" id="for-term_group">
														<?php echo Helper::alert('danger', $errors->first('term_group')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="term_group" value="<?php echo e(old('term_group')); ?>"
													class="input-sm border-0 border-bottom-1" placeholder="#number only">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Parent <code>#Optional</code>

												<?php if($errors->has('parent')): ?>
													<div class="error-badge" id="for-parent">
														<?php echo Helper::alert('danger', $errors->first('parent')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="parent">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

														<?php if(old('parent') ==$term->term_id): ?>
															<option value="<?php echo e($term->term_id); ?>" selected><?php echo e($term->title); ?></option>
														<?php else: ?>
															<option value="<?php echo e($term->term_id); ?>"><?php echo e($term->title); ?></option>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Description
											</label>
											<label class="textarea">
												<textarea name="description" rows="3"
													class="custom-scroll border-0 border-bottom-1"><?php echo e(old('description')); ?></textarea>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6" data-last="0">
											<label class="input">
												<a href="javascript:;" class="btn btn-link font-bold txt-color-red" id="new_meta">
													<i class="glyphicon glyphicon-share-alt"></i>
													Add meta
												</a>
											</label>
										</section>
									</div>

								</fieldset>

								<footer>
									<?php echo e(csrf_field()); ?>

									<button type="submit" class="btn btn-primary">
										<?php echo e($layout->label->save->title); ?>

									</button>
									<button type="submit" name="sane" value="true" class="btn btn-default">
										<?php echo e($layout->label->sane->title); ?>

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