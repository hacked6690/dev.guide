<?php $__env->startSection('content'); ?>

	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">					
					<?php echo e($layout->menu->profile->title); ?>

				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<ul class="nav nav-tabs">
								<li class="<?php echo e(!Session::has('password') ? 'active' :''); ?>">
									<a href="#personal" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> Personal info</a>
								</li>
								<li class="<?php echo e(Session::has('password') ? 'active' :''); ?>">
									<a href="#credential" data-toggle="tab"><i class="glyphicon glyphicon-lock"></i> Password</a>
								</li>
							</ul>

							<div class="tab-content">

								<div class="tab-pane fade in <?php echo e(!Session::has('password') ? 'active' :''); ?>" id="personal">

									<form action="<?php echo e(route('profiles.update', encrypt($user->id))); ?>" class="smart-form" method="post" enctype="multipart/form-data">

										<fieldset>

											<div class="row">
												<?php if(Session::has('updated')): ?>
													<section class="col col-6">
														<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

													</section>
												<?php endif; ?>
											</div>

											<div class="row">
												<section class="col col-4 pull-right">
													<div class="profile-alt height-0">
														<img src="<?php echo e($profile); ?>" width="112" height="112" alt=".profile" />
													</div>
													<div class="profile-note">
														<code>#Profile</code>
													</div>
												</section>
												<section class="col col-6 flexibled-error">
													<label class="label">
														Change profile ?

														<?php if($errors->has('profile')): ?>
															<div class="error-badge" id="for-profile">
																<?php echo Helper::alert('danger', $errors->first('profile')); ?>

															</div>
														<?php endif; ?>
													</label>
													<div class="input input-file">
														<span class="button">
															<input type="file" name="profile" accept="image/*" onchange="this.parentNode.nextSibling.value = this.value">
																Browse
														</span><input type="text" class="border-0 border-bottom-1" placeholder="Include some files" readonly="">
													</div>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Name

														<?php if($errors->has('name')): ?>
															<div class="error-badge" id="for-name">
																<?php echo Helper::alert('danger', $errors->first('name')); ?>

															</div>
														<?php endif; ?>
													</label>
													<label class="input">
														<input type="text" name="name" value="<?php echo e(old('name') ? old('name') :$user_meta->fullname_en->value); ?>" class="input-sm border-0 border-bottom-1">
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Phone

														<?php if($errors->has('phone')): ?>
															<div class="error-badge" id="for-phone">
																<?php echo Helper::alert('danger', $errors->first('phone')); ?>

															</div>
														<?php endif; ?>
													</label>
													<label class="input">
														<input type="text" name="phone" value="<?php echo e(old('phone') ? old('phone') :$user_meta->telephone->value); ?>" class="input-sm border-0 border-bottom-1">
													</label>
													<div class="note">
														<?php echo $layout->label->phone_note->title; ?>

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

								<div class="tab-pane fade in <?php echo e(Session::has('password') ? 'active' :''); ?>" id="credential">

									<form action="<?php echo e(route('user_passwords.update', encrypt($user->id))); ?>" class="smart-form" method="post">

										<fieldset>

											<div class="row">
											<?php if(Session::has('updated_pwd')): ?>
												<section class="col col-6">
													<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

												</section>
											<?php endif; ?>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Email <code>#not required</code>
													</label>
													<label class="input"> <i class="icon-append fa fa-envelope"></i>
														<input type="email" value="<?php echo e($user->email); ?>" class="font-18 border-0 border-bottom-1" disabled></label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Current Password

														<?php if($errors->has('curr_password')): ?>
															<div class="error-badge" id="for-curr_password">
																<?php echo Helper::alert('danger', $errors->first('curr_password')); ?>

															</div>
														<?php endif; ?>
													</label>
													<label class="input"> <i class="icon-append fa fa-code"></i>
														<input type="password" name="curr_password" value="<?php echo e(old('curr_password')); ?>" class="border-0 border-bottom-1"></label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Password

														<?php if($errors->has('password')): ?>
															<div class="error-badge" id="for-password">
																<?php echo Helper::alert('danger', $errors->first('password')); ?>

															</div>
														<?php endif; ?>
													</label>
													<label class="input"> <i class="icon-append fa fa-lock"></i>
														<input type="password" name="password" value="<?php echo e(old('password')); ?>" class="border-0 border-bottom-1"></label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Confirm password </label>
													<label class="input"> <i class="icon-append fa fa-undo"></i>
														<input type="password" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" class="border-0 border-bottom-1"></label>
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
							<!-- End div.tab-content -->

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