<?php $__env->startSection('content'); ?>
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					<?php echo e($layout->menu->create_user_privilege->title); ?>

				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-12">

							<form action="<?php echo e(route('user_privileges.index')); ?>" class="smart-form custom-sf" method="post">

								<fieldset>

									<div class="row">
										<?php if(Session::has('updated')): ?>
											<section class="col col-8">
												<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
									</div>

									<div class="row">
										<section class="col col-8 flexibled-error">
											<label class="label">
												<div class="font-18">
													<i class="fa fa-bolt"></i> Privileges for role &mdash; <code><?php echo e($user_role->title); ?></code>
												</div>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-8 flexibled-error">
											<label class="label">Choose user privileges for this user role</label>
											<div class="note">
												<strong>Maxlength</strong> is automatically added via the "maxlength='#'" attribute
											</div>
										</section>
									</div>
									<div class="row">
										<?php if($errors->has('privileges')): ?>
											<section class="col col-8 flexibled-error">
												<?php echo Helper::alert('danger', $errors->first('privileges')); ?>

											</section>
										<?php endif; ?>
									</div>

								</fieldset>
								<fieldset>

									<?php $__currentLoopData = $privileges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $privilege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<div class="row">
											<section class="col col-4 flexibled-error">
												<label class="toggle">
													<input name="privileges[]" type="checkbox" class="parent-privilege"
														value="<?php echo e($privilege->id); ?>" <?php echo in_array($privilege->id, $user_privileges) ? 'checked="true"' :''; ?> />
													<i data-swchon-text="ON" data-swchoff-text="OFF"></i>
													# <span class="font-13 font-bold txt-color-blue"><?php echo e($privilege->title); ?></span>
												</label>
												<div class="ofprivilege" data-parent="<?php echo e($privilege->id); ?>">
													<button class="btn btn-xs btn-default font-9 _ js178">/Crud/</button>
												</div>
											</section>
										</div>

										<?php if(property_exists($arr_chld, $privilege->id)): ?>

											<div class="child-privileges hidden" id="chldof-<?php echo e($privilege->id); ?>">

												<?php $__currentLoopData = $arr_chld->{$privilege->id}; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chld): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<div class="row margin-bottom-0">
														<section class="col col-4 flexibled-error">
															<label class="toggle">
																<input name="privileges[]" type="checkbox"
																	value="<?php echo e($chld->id); ?>" <?php echo in_array($chld->id, $user_privileges) ? 'checked="true"' :''; ?> />
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>
																<span class="font-12">&nbsp;&nbsp; &mdash; <?php echo e($chld->title); ?></span>
															</label>
														</section>
													</div>

												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											</div>

										<?php endif; ?>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								</fieldset>

								<footer>
									<?php echo e(csrf_field()); ?>

									<input type="hidden" name="_role" value="<?php echo e(encrypt($user_role->id)); ?>">
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