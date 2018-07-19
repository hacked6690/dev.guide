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
	<div id="content">
	<div class="wrapper">
		<div class="container" style="width:100%;padding:0px;margin:0px">
			<form action="<?php echo e(route('guides.index')); ?>" id="sky-form4" class="sky-form" class="smart-form" method="post" enctype="multipart/form-data" >
				<div class="col-lg-5 col-md-5">
								<header>
									<?php echo e($layout->label->guide_registration->title); ?>

								</header>

								<fieldset>
									<div class="row">
										<?php if(Session::has('inserted')): ?>
											<section class="col col-12">
												<?php echo Helper::alert('success', Session::get('inserted'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
									</div>
									<div class="row">
										<?php if(Session::has('info')): ?>
											<section class="col col-12">
												<?php echo Helper::alert('danger', Session::get('info'), 'block font-15'); ?>

											</section>
										<?php endif; ?>
									</div>
									
									<section class="flexibled-error">
											<label class="label">
														<?php echo e($layout->label->license_id->title); ?> <code>*</code>
														<?php if($errors->has('license_id')): ?>
															<div class="error-badge" id="for-license_id">
																<?php echo Helper::alert('danger', $errors->first('license_id')); ?>

															</div>
														<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" value="<?php echo e(old('license_id')); ?>" name="license_id" placeholder="">
											</label>
									</section>
								
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
												<input type="text" value="<?php echo e(old('fullname_kh')); ?>" name="fullname_kh" placeholder="">
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
												<input type="text" value="<?php echo e(old('fullname_en')); ?>" name="fullname_en" placeholder="">
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
											<input type="email" value="<?php echo e(old('email')); ?>" name="email" placeholder="">
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
											<textarea  rows="4" name="address" id="address"><?php echo e(old('address')); ?></textarea>
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
													<input type="text" value="<?php echo e(old('dob')); ?>" name="dob" id="dob" placeholder="">
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
						                           <option value="0" selected ><?php echo e($layout->label->please_select_below->title); ?></option>
						                              <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                                   <?php if(old('gender') ==$gender->term_id): ?>
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
										<section class="col col-lg-12 col-md-12 flexibled-error">
													<label class="label">
																<?php echo e($layout->label->telephone->title); ?><code>*</code>
																<?php if($errors->has('telephone')): ?>
																	<div class="error-badge" id="for-telephone">															
																		<?php echo Helper::alert('danger', $errors->first('telephone')); ?>

																	</div>
																<?php endif; ?>
													</label>
													<label class="input">
														<input type="text" value="<?php echo e(old('telephone')); ?>" name="telephone" placeholder="">
													</label>
										</section>					
									</div>
									<div class="row">											
											<section class="col col-lg-12 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->nationality->title); ?><code>*</code>
																<?php if($errors->has('nationality_id')): ?>
																	<div class="error-badge" id="for-nationality_id">															
																		<?php echo Helper::alert('danger', $errors->first('nationality_id')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('nationality_id')); ?>" name="nationality_id" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('nationality_id') ==$nationality->term_id): ?>
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
										<section class="col col-lg-6 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->province->title); ?><code>*</code>
																<?php if($errors->has('province_id')): ?>
																	<div class="error-badge" id="for-province_id">															
																		<?php echo Helper::alert('danger', $errors->first('province_id')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('province_id')); ?>" name="province_id" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('province_id') ==$province->term_id): ?>
																	<option value="<?php echo e($province->term_id); ?>" selected ><?php echo e($province->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($province->term_id); ?>"><?php echo e($province->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
										</section>	
										<section class="col col-lg-6 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->language->title); ?><code>*</code>
																<?php if($errors->has('language_id')): ?>
																	<div class="error-badge" id="for-language_id">															
																		<?php echo Helper::alert('danger', $errors->first('language_id')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('language_id')); ?>" name="language_id" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $guide_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('language_id') ==$guide_language->term_id): ?>
																	<option value="<?php echo e($guide_language->term_id); ?>" selected ><?php echo e($guide_language->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($guide_language->term_id); ?>"><?php echo e($guide_language->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
										</section>											
									</div>
									<div class="row">		
										<section class="col col-lg-12 col-md-12 flexibled-error">
													<label class="label">
																<?php echo e($layout->label->guide_price->title); ?><code>*</code>
																<?php if($errors->has('guide_price')): ?>
																	<div class="error-badge" id="for-guide_price">															
																		<?php echo Helper::alert('danger', $errors->first('guide_price')); ?>

																	</div>
																<?php endif; ?>
													</label>
													<label class="input">
														<input type="text" value="<?php echo e(old('guide_price')); ?>" name="guide_price" placeholder="">
													</label>
										</section>					
									</div>
									
									
								</fieldset>								
								
					</div>
					<div class="col-lg-7 col-md-7" style="border-left:1px dashed green">
						
						<fieldset>
							<div class="row">		
								<section class="col col-lg-4 col-md-4 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->generation->title); ?><code>*</code>
																<?php if($errors->has('generation')): ?>
																	<div class="error-badge" id="for-generation">															
																		<?php echo Helper::alert('danger', $errors->first('generation')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" value="<?php echo e(old('generation')); ?>" name="generation" placeholder="">
											</label>
								</section>

								<section class="col col-lg-4 col-md-4 flexibled-error">
									<label class="label">
																<?php echo e($layout->label->guide_certified->title); ?><code>*</code>
																<?php if($errors->has('guide_certified')): ?>
																	<div class="error-badge" id="for-guide_certified">															
																		<?php echo Helper::alert('danger', $errors->first('guide_certified')); ?>

																	</div>
																<?php endif; ?>
									</label>
									<label class="select">
										<select name="guide_certified">
										
											<?php if(old('guide_certified') == 'yes'): ?>
												<option value="yes" selected>Yes</option>
												<option value="no">No</option>
											<?php elseif(old('guide_certified') == 'no'): ?>
												<option value="yes" >Yes</option>
												<option value="no" selected>No</option>
											<?php else: ?>
												<option value="" selected disabled>Select Below</option>
												<option value="yes">Yes</option>
												<option value="no">No</option>
											<?php endif; ?>
											
											
										</select>
											<i></i>
									</label>
								</section>	
								<section class="col col-lg-4 col-md-4 flexibled-error">
									<label class="label">
																<?php echo e($layout->label->behavior_certified->title); ?><code>*</code>
																<?php if($errors->has('behavior_certified')): ?>
																	<div class="error-badge" id="for-behavior_certified">															
																		<?php echo Helper::alert('danger', $errors->first('behavior_certified')); ?>

																	</div>
																<?php endif; ?>
									</label>
									<label class="select">
										<select name="behavior_certified">
										
											<?php if(old('behavior_certified') == 'yes'): ?>
												<option value="yes" selected>Yes</option>
												<option value="no">No</option>
											<?php elseif(old('behavior_certified') == 'no'): ?>
												<option value="yes" >Yes</option>
												<option value="no" selected>No</option>
											<?php else: ?>
												<option value="" selected disabled>Select Below</option>
												<option value="yes">Yes</option>
												<option value="no">No</option>
											<?php endif; ?>
											
											
										</select>
											<i></i>
									</label>
								</section>									
							</div>
							<div class="row">		
								<section class="col col-lg-3 col-md-3 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->id_number->title); ?><code>*</code>
																<?php if($errors->has('id_card')): ?>
																	<div class="error-badge" id="for-id_card">															
																		<?php echo Helper::alert('danger', $errors->first('id_card')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" value="<?php echo e(old('id_card')); ?>" name="id_card" placeholder="ID Number">
											</label>
								</section>

								<section class="col col-lg-5 col-md-5 flexibled-error">

									<label class="label">
																<?php echo e($layout->label->partner_type->title); ?><code>*</code>
																<?php if($errors->has('partner_id')): ?>
																	<div class="error-badge" id="for-partner_id">															
																		<?php echo Helper::alert('danger', $errors->first('partner_id')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('partner_id')); ?>" name="partner_id" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $partner_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('partner_id') ==$partner_type->term_id): ?>
																	<option value="<?php echo e($partner_type->term_id); ?>" selected ><?php echo e($partner_type->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($partner_type->term_id); ?>"><?php echo e($partner_type->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
								</section>	
								<section class="col col-lg-4 col-md-4 flexibled-error">

									<label class="label">
																<?php echo e($layout->label->cv_provided->title); ?><code>*</code>
																<?php if($errors->has('cv_provided')): ?>
																	<div class="error-badge" id="for-cv_provided">															
																		<?php echo Helper::alert('danger', $errors->first('cv_provided')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('cv_provided')); ?>" name="cv_provided" >
													
													<?php if(old('cv_provided') == 'yes'): ?>
														<option value="yes" selected>Yes</option>
														<option value="no">No</option>
													<?php elseif(old('cv_provided') == 'no'): ?>
														<option value="yes" >Yes</option>
														<option value="no" selected>No</option>
													<?php else: ?>
														<option value="" selected disabled>Select Below</option>
														<option value="yes">Yes</option>
														<option value="no">No</option>
													<?php endif; ?>
												</select>
												<i></i>
											</label>
								</section>									
							</div>
							
							<div class="row">		
								<section class="col col-lg-6 col-md-6 flexibled-error">

											<label class="label">
																<?php echo e($layout->label->domicile_certified->title); ?><code>*</code>
																<?php if($errors->has('domicile_certified')): ?>
																	<div class="error-badge" id="for-domicile_certified">															
																		<?php echo Helper::alert('danger', $errors->first('domicile_certified')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('domicile_certified')); ?>" name="domicile_certified" >
													
													<?php if(old('domicile_certified') == 'yes'): ?>
														<option value="yes" selected>Yes</option>
														<option value="no">No</option>
													<?php elseif(old('domicile_certified') == 'no'): ?>
														<option value="yes" >Yes</option>
														<option value="no" selected>No</option>
													<?php else: ?>
														<option value="" selected disabled>Select Below</option>
														<option value="yes">Yes</option>
														<option value="no">No</option>
													<?php endif; ?>
												</select>
												<i></i>
											</label>
								</section>					
								<section class="col col-lg-6 col-md-6 flexibled-error">

											<label class="label">
																Re<?php echo e($layout->label->renewal_type->title); ?><code>*</code>
																<?php if($errors->has('new_renew')): ?>
																	<div class="error-badge" id="for-new_renew">															
																		<?php echo Helper::alert('danger', $errors->first('new_renew')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('new_renew')); ?>" name="new_renew" >
													
													<?php if(old('new_renew') == 'new'): ?>
														<option value="new" selected>New</option>
														<option value="renewal\">Renewal</option>
													<?php elseif(old('new_renew') == 'renewal'): ?>
														<option value="new" >New</option>
														<option value="renewal" selected>Renewal</option>
													<?php else: ?>
														<option value="" selected disabled>Select Below</option>
														<option value="new">New</option>
														<option value="renewal">Renewal</option>
													<?php endif; ?>
												</select>
												<i></i>
											</label>
								</section>										
							</div>
							<div class="row">		
								<section class="col col-lg-8 col-md-8 flexibled-error">

									<label class="label">
																<?php echo e($layout->label->guide_type->title); ?><code>*</code>
																<?php if($errors->has('guide_type_id')): ?>
																	<div class="error-badge" id="for-guide_type_id">															
																		<?php echo Helper::alert('danger', $errors->first('guide_type_id')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('guide_type_id')); ?>" name="guide_type_id" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $guide_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('guide_type_id') ==$guide_type->term_id): ?>
																	<option value="<?php echo e($guide_type->term_id); ?>" selected ><?php echo e($guide_type->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($guide_type->term_id); ?>"><?php echo e($guide_type->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
								</section>																
							</div>
							<div class="row">
											<section class="col col-4 flexibled-error">
												<label class="label">
																<?php echo e($layout->label->issued_date->title); ?><code>*</code>
																<?php if($errors->has('issued_date')): ?>
																	<div class="error-badge" id="for-issued_date">															
																		<?php echo Helper::alert('danger', $errors->first('issued_date')); ?>

																	</div>
																<?php endif; ?>
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="<?php echo e(old('issued_date')); ?>" name="issued_date" id="issued_date"  placeholder="Issued Date">
												</label>
											</section>	
											<section class="col col-4 flexibled-error">
												<label class="label">
																<?php echo e($layout->label->expired_date->title); ?><code>*</code>
																<?php if($errors->has('expired_date')): ?>
																	<div class="error-badge" id="for-expired_date">															
																		<?php echo Helper::alert('danger', $errors->first('expired_date')); ?>

																	</div>
																<?php endif; ?>
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="<?php echo e(old('expired_date')); ?>"  name="expired_date" id="expired_date" placeholder="Expired Date">
												</label>
											</section>	
											<section class="col col-4 flexibled-error">
												<label class="label">
																<?php echo e($layout->label->service_date->title); ?><code>*</code>
																<?php if($errors->has('date_in_service')): ?>
																	<div class="error-badge" id="for-date_in_service">															
																		<?php echo Helper::alert('danger', $errors->first('date_in_service')); ?>

																	</div>
																<?php endif; ?>
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="<?php echo e(old('date_in_service')); ?>"  name="date_in_service" id="date_in_service"  placeholder="Service Date">
												</label>
											</section>								
							</div>
							<!-- Add block language -->
							<!-- <div class="block_language">
								<div class="row language_item">	
									<div class="col-lg-12 col-md-12">
										<div  style="border-top:1px dashed green;height:10px"></div>
									</div>
							        <section class="col col-lg-5 col-md-5 flexibled-error">
											<label class="label">
											
																<?php echo e($layout->label->language->title); ?><code>*</code>
																<?php if($errors->has('guide_language1')): ?>
																	<div class="error-badge" id="for-guide_language">															
																		<?php echo Helper::alert('danger', $errors->first('guide_language1')); ?>

																	</div>
																<?php endif; ?>
											
											</label>
											<label class="select">
												<select value="<?php echo e(old('guide_language1')); ?>" id="guide_language1" class="guide_language" name="guide_language1" >
													<option value="" selected disabled>Select Below</option>
													<?php $__currentLoopData = $guide_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('guide_language') ==$guide_language->term_id): ?>
																	<option value="<?php echo e($guide_language->term_id); ?>" selected ><?php echo e($guide_language->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($guide_language->term_id); ?>"><?php echo e($guide_language->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
									</section>				 
									<section class="col col-lg-4 col-md-4 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->proficiency->title); ?><code>*</code>
																<?php if($errors->has('proficiency')): ?>
																	<div class="error-badge" id="for-proficiency">															
																		<?php echo Helper::alert('danger', $errors->first('proficiency')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('proficiency')); ?>" name="proficiency" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $proficiencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proficiency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('proficiency') ==$proficiency->term_id): ?>
																	<option value="<?php echo e($proficiency->term_id); ?>" selected ><?php echo e($proficiency->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($proficiency->term_id); ?>"><?php echo e($proficiency->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
									</section>
									<section class="col col-lg-3 col-md-3 flexibled-error">
												<label class="label">
																<?php echo e($layout->label->price_usd->title); ?><code>*</code>
																<?php if($errors->has('guide_price')): ?>
																	<div class="error-badge" id="for-guide_price">															
																		<?php echo Helper::alert('danger', $errors->first('guide_price')); ?>

																	</div>
																<?php endif; ?>
												</label>
												<label class="input">
													<input type="text" value="<?php echo e(old('price_description')); ?>" class="guide_price" id="guide_price" name="guide_price" placeholder="">
												</label>
									</section>									
									<section class="col col-lg-12 col-md-12 margin_bottom">
												<label class="label">
																<?php echo e($layout->label->description->title); ?>:<code>*</code>
																<?php if($errors->has('guide_price')): ?>
																	<div class="error-badge" id="for-price_description">															
																		<?php echo Helper::alert('danger', $errors->first('price_description')); ?>

																	</div>
																<?php endif; ?>
												</label>
												<label class="input">
													<input type="text" value="<?php echo e(old('price_description')); ?>" class="price" id="price_description" name="price_description[]" placeholder="">
												</label>
									</section>							
								</div>
								<div class="row">
									<section class="col">
										<button type="button"  id="add_language"  class="add_language btn btn-primary">
											<i class=" fa fa-plus-circle" aria-hidden="true"></i>&nbsp;<?php echo e($layout->label->add_language->title); ?>

									</section>
								</div>
								
							</div> -->
							<!--end block language-->
							<hr/>
							<!-- Add Block Location -->
							<!-- <div class="block_location">
								<div class="row location_item">	
									<div class="col-lg-12 col-md-12">
										<div  style="border-top:1px dashed green;height:10px"></div>
									</div>
							       <section class="col col-lg-5 col-md-5 flexibled-error">
											<label class="label">
																<?php echo e($layout->label->province->title); ?><code>*</code>
																<?php if($errors->has('province')): ?>
																	<div class="error-badge" id="for-province">															
																		<?php echo Helper::alert('danger', $errors->first('province')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="select">
												<select value="<?php echo e(old('province')); ?>" name="province" >
													<option value="0" selected disabled>Select Below</option>
													<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if(old('province') ==$province->term_id): ?>
																	<option value="<?php echo e($province->term_id); ?>" selected ><?php echo e($province->title); ?></option>
														<?php else: ?>
																	<option value="<?php echo e($province->term_id); ?>"><?php echo e($province->title); ?></option>
														<?php endif; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<i></i>
											</label>
									</section>
									<section class="col col-lg-4 col-md-4 flexibled-error">
										<label class="label">
																<?php echo e($layout->label->location->title); ?><code>*</code>
																<?php if($errors->has('location')): ?>
																	<div class="error-badge" id="for-location">															
																		<?php echo Helper::alert('danger', $errors->first('location')); ?>

																	</div>
																<?php endif; ?>
										</label>
										<label class="select">
											<select name="location" class="location form-control" id="location">
												
											</select>
												<i></i>
										</label>
									</section>
									<section class="col col-lg-3 col-md-3">
												<label class="label">
																<?php echo e($layout->label->price_usd->title); ?><code>*</code>
																<?php if($errors->has('location_price')): ?>
																	<div class="error-badge" id="for-location_price">															
																		<?php echo Helper::alert('danger', $errors->first('location_price')); ?>

																	</div>
																<?php endif; ?>
												</label>
												<label class="input">
													<input type="text" value="<?php echo e(old('location_price')); ?>" class="price" id="location_price" name="location_price" placeholder="">
												</label>
									</section>								
														
								</div>
								<div class="row">
									<section class="col">
										<button type="button"  id="add_location"  class="add_location btn btn-primary">
											<i class=" fa fa-plus-circle" aria-hidden="true"></i>&nbsp;<?php echo e($layout->label->add_location->title); ?>

										</button>
									</section>
								</div>
							</div> -->
							<!--end block location-->
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
										<section class="col col-lg-12">
											<label class="label">
																
																<?php if($errors->has('agree')): ?>
																	<div class="error-badge" id="for-agree">															
																		<?php echo Helper::alert('danger', $errors->first('agree')); ?>

																	</div>
																<?php endif; ?>
											</label>
											<label class="checkbox">
												<?php if(old('agree')!==''): ?>
													<input type="checkbox"  name="agree" id="agree"><i></i><?php echo e($layout->label->i_agree_term->title); ?>

												<?php else: ?>
													<input type="checkbox" value="<?php echo e(old('agree')); ?>" name="agree" id="agree"><i></i><?php echo e($layout->label->i_agree_term->title); ?>

												<?php endif; ?>
												
											</label>
										</section>
										<footer>
											<?php echo e(csrf_field()); ?>

											<button type="submit"  class="btn-u btn btn-primary">Submit</button>
										</footer>
							</div>


						</fieldset>
					</div>
					</form><!--end form-->
							<!-- End Reg-Form -->
		</div>
			
	</div><!--end wrapper class-->
	</div>
	<!-- END MAIN CONTENT -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
            var c = 1;
            $('.add_language').on('click', function() {            	
               /* var last_ele=$(".language_item:last");
                c++;
                  var new_ele=last_ele.clone(true);
                 last_ele.after(new_ele);*/
                 
                var orginalDiv = $('.language_item:last');
				var clonedDiv = orginalDiv.clone();
				c++;
				clonedDiv.find('.guide_language').attr('name','guide_language'+c);
				clonedDiv.appendTo('.language_item');



               
                
            });















            $('.add_location').on('click', function() {            	
                c++;
                 // alert(c);
                 var last_ele=$(".location_item:last");
                 var new_ele=last_ele.clone(true);
                 last_ele.after(new_ele);
                
            });
            $( function() {
			    $( "#dob" ).datepicker();
			    $( "#issued_date" ).datepicker();
			    $( "#expired_date" ).datepicker();
			    $( "#date_in_service" ).datepicker();
			  } );

        </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>