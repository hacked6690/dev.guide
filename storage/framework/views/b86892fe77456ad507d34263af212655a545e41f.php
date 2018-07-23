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
			<form action="<?php echo e(route('guideprice.index')); ?>" class="smart-form" method="post">
							<?php echo e(csrf_field()); ?>

								<fieldset>
								<input type="hidden" name="guide_id" value="<?php echo e(encrypt($guide_id)); ?>"/>
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
														<?php if(old('language_id') ==$language->term_id): ?>
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
														<?php if(old('province_id') ==$province->term_id): ?>
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
														<?php if(old('boolean_id') ==$boolean->term_id): ?>
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
												<input type="text" name="price" value="<?php echo e(old('price')); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											
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
							
							<?php if(Session::has('updated')): ?>
								<section class="col col-6">
									<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

								</section>
							<?php endif; ?>

							<div class="table-responsive">

								<table class="table table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th><?php echo e($layout->label->guide_id->title); ?></th>
											<th><?php echo e($layout->label->language->title); ?></th>
											<th><?php echo e($layout->label->location->title); ?></th>
											<th><?php echo e($layout->label->guide_price->title); ?></th>
											<th><?php echo e($layout->label->default->title); ?></th>
											<th><?php echo e($layout->label->fee_additional->title); ?></th>
											<th><?php echo e($layout->label->action->title); ?></th>											
										</tr>
									</thead>
									<tbody>
										<?php if(count($guideprices) ==0): ?>
											<?php echo Helper::empty_table(10); ?>

										<?php endif; ?>
									
										<?php $__currentLoopData = $guideprices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $guideprice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $user_meta=Helper::metas('user_meta',['user_id' => $guideprice->guide_id] );?>
									      	<tr>
										        <td><?php echo e(\Helper::indexed($guideprices, $key)); ?></td>
										        <td>
										        	<code>
										        		<?php echo e($guideprice->guide_id); ?>

										        	</code>
											        <a id="<?php echo e($guideprice->id); ?>" class="hyper"></a>
											        <br>

											       <?php  //{{$user_meta->fullname_en->value}} ?>
											        
											     
										        </td>
										        <td>
										        	<a href="<?php echo e($guideprice->content_parent); ?>">
										        		<?php echo e($guideprice->language->title); ?>

										        	</a>
										        </td>
										        <td>
										        	<a href="#p<?php echo e($guideprice->translate_of); ?>">
											        	<span class="font-12 txt-color-blue">
											        		<?php echo e($guideprice->province->title); ?>

											        	</span>
											        </a>
										        </td>
										        <td>
										        	<code>
										        		<?php echo e($guideprice->price); ?> <code>USD</code>
										        	</code>
										        </td>
										        <td>
										        	<div class="truncate-35" title="<?php echo e($guideprice->title); ?>">
										        		<?php echo $guideprice->default; ?>

										        	</div>
										        </td>
										        <td>	
										        	<div class="truncate-275" title="<?php echo e($guideprice->title); ?>">									        	
										        	<?php 
										        		$details=$guideprice->guideprice_detail;
										        	 ?>
										        	<table  class="table table-responsive table-hover" 
										        	style="background-color:#f0f0f5;font-size:12px">
										        		<?php 
										        			$n=1;
										        		 ?>
										        		<?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										        		<tr>
										        			<td><?php echo e($n++); ?></td>
										        			<td><?php echo e($detail->fee->title); ?></td>
										        			<td><?php echo e($detail->gp_price); ?><code>USD</code></td>
										        			<td>
										        				<form action="<?php echo e(route('guidepricedetail.destroy', encrypt($detail->id))); ?>" method="post" class="inline-block">
																	<?php echo e(method_field('delete')); ?>

																	<?php echo e(csrf_field()); ?>

																	<button type="button" class="btn btn-danger btn-xs jscfm">Delete</button>
																</form>
										        			</td>
										        		</tr>
										        		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										        
										        	</table>
										        	</div>
										        </td>
										      
										        <td>
										        	<div class="btn-action">
										        		<button onclick="mypopup(<?php echo e($guideprice->id); ?>)" 
										        			data-backdrop="static" data-keyboard="false"
										        			data-toggle="modal" data-target="#myModal"  class="detail btn btn-primary btn-xs"><?php echo e($layout->label->fee_additional->title); ?></button>
											        	<a target="_blank" href="<?php echo e(route('guideprice.edit', Helper::encodeString($guideprice->id,Helper::encryptKey()))); ?>" class="btn btn-primary btn-xs">edit</a>
											        	<form action="<?php echo e(route('guideprice.destroy', encrypt($guideprice->id))); ?>" method="post" class="inline-block">
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



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo e($layout->label->fee_additional->title); ?></h4>
        </div>
        <div class="modal-body">
          	<form id="new_term-frm" class="ajxfrm smart-form" data-validate="true" data-reload="true" method="post">
          	<input type="hidden"  name="cmd" value="guideprice">
          		<?php echo e(csrf_field()); ?>

          		<div class="row">
					<section class="col col-6 flexibled-error">
						<label class="label">
							<?php echo e($layout->label->fee_additional->title); ?> <code>*</code>
							<?php if($errors->has('fee_id')): ?>
								<div class="error-badge" id="for-fee_id">
									<?php echo Helper::alert('danger', $errors->first('fee_id')); ?>

								</div>
							<?php endif; ?>
						</label>
						<label class="select">
							<select class="input-sm border-0 border-bottom-1" name="fee_id">

								<?php echo Helper::empty_option(); ?>


								<?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(old('fee_id') ==$fee->term_id): ?>
										<option value="<?php echo e($fee->term_id); ?>" selected><?php echo e($fee->title); ?></option>
									<?php else: ?>
										<option value="<?php echo e($fee->term_id); ?>"><?php echo e($fee->title); ?></option>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select><i></i>
						</label>
					</section>
				</div>
				<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<?php echo e($layout->label->additional_price->title); ?> <code>*<?php echo e($layout->label->usd->title); ?> <code>*</code></code>

												<?php if($errors->has('price')): ?>
													<div class="error-badge" id="for-slug">
														<?php echo Helper::alert('danger', $errors->first('price')); ?>

													</div>
												<?php endif; ?>
											</label>
											<label class="input">
												<input type="text" name="price" value="<?php echo e(old('price')); ?>" class="input-sm border-0 border-bottom-1">
											</label>
											<input type="hidden"  class="guideprice_id" name="guideprice_id" />
											
										</section>
				</div>
          	
        </div>
        <div class="modal-footer">        
          <button type="submit" name="save_detail" value="true" class="bt_save btn btn-default">
				<?php echo e($layout->label->save->title); ?>

		  </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>          
        </div>
        </form>
      </div>      
    </div>
  </div>
  

<?php $__env->stopSection(); ?>

<script type="text/javascript">
	
	  function mypopup(guideprice_id) {	    
	        $(".guideprice_id").val(guideprice_id);	
	        // alert(guideprice_id);
	    }  
	

	

</script>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>