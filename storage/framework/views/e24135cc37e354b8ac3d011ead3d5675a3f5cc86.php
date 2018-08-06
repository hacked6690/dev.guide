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
						<div class="col-md-12 col-lg-8">

							<form action="<?php echo e(route('layout_items.update', encrypt($layout_item->id))); ?>" class="smart-form" method="post">

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
												Category <code>*</code>

												<?php if($errors->has('category_id')): ?>
													<div class="error-badge" id="for-category_id">
														<?php echo Helper::alert('danger', $errors->first('category_id')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="category_id">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $layout_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

														<?php if($layout_item->category_id ==$layout_category->id): ?>
															<option value="<?php echo e($layout_category->id); ?>" selected><?php echo e($layout_category->title); ?></option>
														<?php else: ?>
															<option value="<?php echo e($layout_category->id); ?>"><?php echo e($layout_category->title); ?></option>
														<?php endif; ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
											</label>
										</section>
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
												<input type="text" name="slug" value="<?php echo e(old('slug') ? old('slug') :$layout_item->slug); ?>" class="input-sm border-0 border-bottom-1">
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
												<input type="text" name="title" value="<?php echo e(old('title') ? old('title') :$layout_item->title); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Url

												<?php if($errors->has('url')): ?>
													<div class="error-badge" id="for-url">
														<?php echo Helper::alert('danger', $errors->first('url')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input"> <i class="icon-append glyphicon glyphicon-link"></i>
												<input type="text" name="url" value="<?php echo e(old('url') ? old('url') :$layout_item->url); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Icon

												<?php if($errors->has('icon')): ?>
													<div class="error-badge" id="for-icon">
														<?php echo Helper::alert('danger', $errors->first('icon')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="icon" value="<?php echo e(old('icon') ? old('icon') :$layout_item->icon); ?>" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Ordered

												<?php if($errors->has('ordered')): ?>
													<div class="error-badge" id="for-ordered">
														<?php echo Helper::alert('danger', $errors->first('ordered')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="ordered" value="<?php echo e(old('ordered') ? old('ordered') :$layout_item->ordered); ?>" class="input-sm border-0 border-bottom-1">
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
													class="custom-scroll border-0 border-bottom-1"><?php echo e(old('description') ? old('description') :$layout_item->description); ?></textarea>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Options
											</label>
											<label class="input">
												<input type="text" name="options" value="<?php echo e(old('options') ? old('options') :$layout_item->options); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												<?php echo $layout->label->options_note->title; ?>

											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Parent

												<?php if($errors->has('parent')): ?>
													<div class="error-badge" id="for-parent">
														<?php echo Helper::alert('danger', $errors->first('parent')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="parent">

													<?php echo Helper::empty_option(); ?>


													<?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

														<?php if($layout_item->parent ==$parent->id): ?>
															<option value="<?php echo e($parent->id); ?>" selected><?php echo e($parent->title); ?></option>
														<?php else: ?>
															<option value="<?php echo e($parent->id); ?>"><?php echo e($parent->title); ?></option>
														<?php endif; ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select><i></i>
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