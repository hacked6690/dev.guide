<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
	.inline-block{
		padding:0px;
		margin: 0px;
	}
	.border-0{
		border: 0px solid #bdbdbd !important;
	}
	.border-bottom-1{
		border-bottom: 1px solid #bdbdbd !important;
	}
	.ui-widget.ui-widget-content{
		width:250px;
	}
	
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div id="content" >
	<div class="wrapper">
			<form action="<?php echo e(route('travellers.update', encrypt($user->id))); ?>" id="sky-form4" class="sky-form" class="smart-form" method="post" enctype="multipart/form-data" >
				<div class="col-lg-10 col-md-10 col-md-offset-1 " style="border:1px dashed gray">
								<header class="text text-center ">
									<?php echo e($layout->label->traveller_information->title); ?>

								</header>

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
														<?php echo e($layout->label->fullname_kh->title); ?><code>*</code>
														<?php if($errors->has('fullname_kh')): ?>
															<div class="error-badge" id="for-fullname_kh">
																<?php echo Helper::alert('danger', $errors->first('fullname_kh')); ?>

															</div>
														<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" value="<?php echo e($user_meta->fullname_kh->value); ?>" name="fullname_kh" placeholder="">
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
														<?php echo e($layout->label->fullname_en->title); ?><code>*</code>
														<?php if($errors->has('fullname_en')): ?>
															<div class="error-badge" id="for-fullname_en">															
																<?php echo Helper::alert('danger', $errors->first('fullname_en')); ?>

															</div>
														<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" value="<?php echo e($user_meta->fullname_en->value); ?>" name="fullname_en" placeholder="">
											</label>
										</section>
									</div>
									<section class="flexibled-error">
										<label class="label">
														<?php echo e($layout->label->email->title); ?><code>*</code>
														<?php if($errors->has('email')): ?>
															<div class="error-badge" id="for-email">															
																<?php echo Helper::alert('danger', $errors->first('email')); ?>

															</div>
														<?php endif; ?>
										</label>
										<label class="input">
											<i class="icon-append fa fa-envelope"></i>
											<input type="email" value="<?php echo e($user->email); ?>" name="email" placeholder="">
											<b class="tooltip tooltip-bottom-right">Pls Fill your email account</b>
										</label>
									</section>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->password->title); ?><code>*</code>
																<?php if($errors->has('password')): ?>
																	<div class="error-badge" id="for-password">															
																		<?php echo Helper::alert('danger', $errors->first('password')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password" value="<?php echo e(old('password')); ?>" name="password" placeholder="Password" id="password">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->confirm_password->title); ?><code>*</code>
																<?php if($errors->has('password_confirmation')): ?>
																	<div class="error-badge" id="for-confirm_password">															
																		<?php echo Helper::alert('danger', $errors->first('password_confirmation')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password"  name="password_confirmation" placeholder="Password" id="password_confirmation">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>									
									</div>
									<section class="flexibled-error">
										<label class="label">
														<?php echo e($layout->label->address->title); ?><code>*</code>
														<?php if($errors->has('address')): ?>
															<div class="error-badge" id="for-address">															
																<?php echo Helper::alert('danger', $errors->first('address')); ?>

															</div>
														<?php endif; ?>
										</label>
										<label class="textarea">
											<i class="icon-append fa fa-comment"></i>
											<textarea  rows="4" name="address" id="address"><?php echo e($user_meta->address->value); ?></textarea>
										</label>
									</section>


									<div class="row">
											<section class="col col-6 flexibled-error">
												<label class="label">
														<?php echo e($layout->label->date_of_birth->title); ?><code>*</code>
														<?php if($errors->has('dob')): ?>
															<div class="error-badge" id="for-dob">															
																<?php echo Helper::alert('danger', $errors->first('dob')); ?>

															</div>
														<?php endif; ?>
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="<?php echo e($user_meta->dob->value); ?>" name="dob" id="dob" placeholder="">
												</label>
											</section>	
											<section class="col col-6 flexibled-error">
											 <label class="label">
						                        <?php echo e($layout->label->gender->title); ?> 
						                        <?php if($errors->has('gender')): ?>
						                            <div class="error-badge" id="for-gender">
						                             <?php echo Helper::alert('danger', $errors->first('gender')); ?>

						                             </div>
						                       <?php endif; ?>
						                    </label>
						                    <label class="select">
						                       <select value="<?php echo e(old('gender')); ?>" name="gender" >
						                           <option value="0" disabled ><?php echo e($layout->label->please_select_below->title); ?></option>
						                              <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                                   <?php if($user_meta->gender->value ==$gender->term_id): ?>
						                                      <option value="<?php echo e($gender->term_id); ?>" selected ><?php echo e($gender->title); ?></option>
						                                   <?php else: ?>
						                                      <option value="<?php echo e($gender->term_id); ?>"><?php echo e($gender->title); ?></option>
						                                  <?php endif; ?>
						                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                      </select>
						                      <i></i>
						                    </label>
										</section>										
									</div>
									<div class="row">		
										<section class="col col-lg-6 col-md-6 flexibled-error">
													<label class="label">
																<?php echo e($layout->label->telephone->title); ?><code>*</code>
																<?php if($errors->has('telephone')): ?>
																	<div class="error-badge" id="for-telephone">															
																		<?php echo Helper::alert('danger', $errors->first('telephone')); ?>

																	</div>
																<?php endif; ?>
													</label>
													<label class="input">
														<input type="text" value="<?php echo e($user_meta->telephone->value); ?>" name="telephone" placeholder="">
													</label>
										</section>	
										<section class="col col-lg-6 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->nationality->title); ?><code>*</code>
																<?php if($errors->has('nationality_id')): ?>
																	<div class="error-badge" id="for-nationality_id">															
																		<?php echo Helper::alert('danger', $errors->first('nationality_id')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e($user_meta->nationality_id->value); ?>" name="nationality_id" >
													<option value="0"  disabled>Select Below</option>
													<?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if($user_meta->nationality_id->value ==$nationality->term_id): ?>
																	<option value="<?php echo e($nationality->term_id); ?>" selected ><?php echo e($nationality->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($nationality->term_id); ?>"><?php echo e($nationality->title); ?></option>
														<?php endif; ?>														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
										</section>									
									</div>
									<div class="row">
										<?php if($user_meta->photo->value !==''): ?>										
											<img alt="NA" src="<?php echo e(Storage::url(''. $user->id .'/').$user_meta->photo->value); ?> " style="width:20%" class="img img-thumbnail img-responsive" />
										<?php else: ?>
											<img alt="NA" src="https://vollrath.com/ClientCss/images/VollrathImages/No_Image_Available.jpg " style="width:30%" class="img img-thumbnail img-responsive" />
										<?php endif; ?>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Profile

												<?php if($errors->has('photo')): ?>
													<div class="error-badge" id="for-photo">
														<?php echo Helper::alert('danger', $errors->first('photo')); ?>

													</div>
												<?php endif; ?>
											</label>
											<div class="input input-file">
												<span class="button">
													<input type="file"  name="photo" accept="image/*" onchange="this.parentNode.nextSibling.value = this.value">
														Browse
												</span><input type="text" class="border-0 border-bottom-1" placeholder="" readonly="">
											</div>
										</section>
									</div>				
									<div class="row">
										<footer>
										
											<?php echo e(method_field('put')); ?>

											<?php echo e(csrf_field()); ?>

											<button style="width:100%" type="submit"  class="btn-u btn-primary btn-lg">UPDATE</button>
										</footer>
									</div>
								</fieldset>		
					</div>
					</form><!--end form-->
							<!-- End Reg-Form -->
	
			
	</div><!--end wrapper class-->
	</div>
	<!-- END MAIN CONTENT -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	 $( function() {
			    $( "#dob" ).datepicker();
			  } );
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>