<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/homepage.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<style type="text/css">
	.img_status{
		width: 35px;
	}
	.wd-20{
		width:20px;
	}
	.wd-30{
		width:30px;
	}
	.wd-40{
		width:40px;
	}
	.wd-50{
		width:50px;
	}
	.wd-60{
		width:60px;
	}
	.wd-70{
		width:70px;
	}
	.wd-80{
		width:80px;
	}
	.wd-90{
		width:90px;
	}
	.wd-100{
		width:100px;
	}
	.wd-120{
		width:120px;
	}
	.wd-140{
		width:140px;
	}
	.wd-160{
		width:160px;
	}
	.wd-180{
		width:180px;
	}
	.bg-header{
		
	}
	.mysearch{
		width:100%;
		padding:10px;
	}
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('authorize.index')); ?>" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >

<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#c2d6d6;padding:2px;margin:0px">       
        <div class="col-lg-2 col-md-2 col-xs-12">
                <section class="flexibled-error">
                    <label class="label">
                        <?php echo e($layout->label->fullname_en->title); ?> 
                        <?php if($errors->has('fullname_en')): ?>
                            <div class="error-badge" id="for-fullname_en">
                             <?php echo Helper::alert('danger', $errors->first('fullname_en')); ?>

                             </div>
                       <?php endif; ?>
                    </label>
                    <label class="input">
                        <input type="text" value="<?php echo e($searchField->fullname_en); ?>" name="fullname_en" placeholder="Guide name">
                    </label>
                </section>
        </div>    
        <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
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
                                   <?php if($searchField->gender==$gender->term_id): ?>
                                      <option value="<?php echo e($gender->term_id); ?>" selected ><?php echo e($gender->title); ?></option>
                                   <?php else: ?>
                                      <option value="<?php echo e($gender->term_id); ?>"><?php echo e($gender->title); ?></option>
                                  <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <i></i>
                    </label>
        </section>       
        <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                <label class="label">
                       <?php echo e($layout->label->guide_type->title); ?>

                            <?php if($errors->has('guide_type_id')): ?>
                                <div class="error-badge" id="for-guide_type_id">                                                            
                                    <?php echo Helper::alert('danger', $errors->first('guide_type_id')); ?>

                                </div>
                            <?php endif; ?>
                </label>
                <label class="select">
                     <select value="<?php echo e(old('guide_type_id')); ?>" name="guide_type_id" >
                         <option value="0" selected ><?php echo e($layout->label->please_select_below->title); ?></option>
                            <?php $__currentLoopData = $guide_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($searchField->guide_type_id==$guide_type->term_id): ?>
                                    <option value="<?php echo e($guide_type->term_id); ?>" selected ><?php echo e($guide_type->title); ?></option>
                                 <?php else: ?>
                                    <option value="<?php echo e($guide_type->term_id); ?>"><?php echo e($guide_type->title); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <i></i>
               </label>
        </section> 
         <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                <label class="label">
                       <?php echo e($layout->label->nationality->title); ?>

                            <?php if($errors->has('nationality_id')): ?>
                                <div class="error-badge" id="for-nationality_id">                                                            
                                    <?php echo Helper::alert('danger', $errors->first('nationality_id')); ?>

                                </div>
                            <?php endif; ?>
                </label>
                <label class="select">
                     <select value="<?php echo e(old('nationality_id')); ?>" name="nationality_id" >
                         <option value="0" selected ><?php echo e($layout->label->please_select_below->title); ?></option>
                            <?php $__currentLoopData = $nationalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nationality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($searchField->nationality_id==$nationality->term_id): ?>
                                    <option value="<?php echo e($nationality->term_id); ?>" selected ><?php echo e($nationality->title); ?></option>
                                 <?php else: ?>
                                    <option value="<?php echo e($nationality->term_id); ?>"><?php echo e($nationality->title); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <i></i>
               </label>
        </section> 
        <section class="col col-lg-3 col-md-3 col-xs-12 flexibled-error">
                <label class="label">
                       <?php echo e($layout->label->language->title); ?>

                            <?php if($errors->has('guide_language')): ?>
                                <div class="error-badge" id="for-guide_language">                                                            
                                    <?php echo Helper::alert('danger', $errors->first('guide_language')); ?>

                                </div>
                            <?php endif; ?>
                </label>
                <label class="select">
                     <select value="<?php echo e(old('guide_language')); ?>" name="guide_language" >
                         <option value="0" selected ><?php echo e($layout->label->please_select_below->title); ?></option>
                            <?php $__currentLoopData = $guide_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($searchField->guide_language==$guide_language->term_id): ?>
                                    <option value="<?php echo e($guide_language->term_id); ?>" selected ><?php echo e($guide_language->title); ?></option>
                                 <?php else: ?>
                                    <option value="<?php echo e($guide_language->term_id); ?>"><?php echo e($guide_language->title); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <i></i>
               </label>
        </section>  
        <section class="col col-lg-1 col-md-1 col-xs-12 flexibled-error">
                <button type="submit"  class="btn-u" style="width:100%;margin-top:25px">
                    <span class="button_search"><i class="fa fa-search"></i></span>
                 </button>   
        </section>    

</div>
</form>	
<div class="myrow table table-responsive" >
		<table class="table table-responsive table-hover table-collapsed table-bordered">
			<thead>
				<tr class="bg-header">
					<th>#ID</th>
					<th>Fullname EN</th>
					<th>Gender</th>
					<th>Guide Type</th>
					<th>Nationality</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php if(count($users)==0): ?>	
				<tr>
					<td colspan="7">
						NO DATA FOUND
					</td>
				</tr>
			<?php endif; ?>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  
					$fullnameEN='' ;
					$gender='' ;
					$guide_type='';
					$nationality='';
				 ?>
					<?php $__currentLoopData = $user["user_metas"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($v["meta_key"]=='fullname_en'): ?>
							<?php 
								$fullnameEN=$v["meta_value"]
							 ?>
						<?php endif; ?>
						<?php if($v["meta_key"]=='gender'): ?>
							<?php 
								$gender=$v["meta_value"]
							 ?>
						<?php endif; ?>
						<?php if($v["meta_key"]=='guide_type_id'): ?>
							<?php 
								$guide_type_id=$v["meta_value"]
							 ?>
						<?php endif; ?>
						<?php if($v["meta_key"]=='nationality_id'): ?>
							<?php 
								$nationality=$v["meta_value"]
							 ?>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td>
								<div class="wd-30">
								<code><?php echo e($user["id"]); ?></code>
								</div>
							</td>
							
							<td>
								<div class="wd-120">
									<?php echo e($fullnameEN); ?>

								</td>
								</div>
							<td>
								<div class="wd80">
									<?php echo e(ContentTerms::getTermTitle($gender)); ?>

								</div>
							</td>
							<td>
								<div class="wd-100">
									<?php echo e(ContentTerms::getTermTitle($guide_type_id)); ?>

								</div>
							</td>
							<td>
								<div class="wd-100">
									<?php echo e(ContentTerms::getTermTitle($nationality)); ?>

								</div>
							</td>
							<td>
								<div class="wd-50">
								<img class="img img-responsive img_status" src="<?php echo e(URL::asset('assets/status')); ?>/<?php echo e($user['active']); ?>.png"/>
								</div>
							</td>
							<td >
								<div class="wd-200">
							

								<button onclick="mypopup('<?php echo e(encrypt($user['id'])); ?>','<?php echo e($user['active']); ?>')" 
										        			data-backdrop="static" data-keyboard="false"
										        			data-toggle="modal" data-target="#myModal" 
										        			 class="detail btn btn-primary btn-xs">
										        			<i class="fas fa-edit"></i> &nbsp;Authorized
								</button>

								<a target="_blank" href="<?php echo e(route('authorize.edit', encrypt($user['id']))); ?>" class="btn btn-primary btn-xs">
									<i class="fas fa-edit"></i> &nbsp;Edit
								</a>
								<form action="<?php echo e(route('guides.destroy', encrypt($user['id']))); ?>" method="post" class="inline-block">
									<?php echo e(method_field('delete')); ?>

									<?php echo e(csrf_field()); ?>

									<button type="button" class="btn btn-danger btn-xs jscfm">
										<i class="fas fa-trash-alt"></i> &nbsp;Delete
									</button>
								</form>
								</div>
							</td>
						
						</tr>
					
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<?php echo $users->appends(Input::except('page'))->links(); ?>



</div>




<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo e($layout->label->guide_authorization->title); ?></h4>
        </div>
        <div class="modal-body">
          	<form id="new_term-frm" class="ajxfrm smart-form" data-validate="true" data-reload="true" method="post">
          	<input type="hidden"  name="cmd" value="authorize">
          		<?php echo e(csrf_field()); ?>

          		<input type="hidden"  class="guide_id" name="guide_id" />
          		<div class="row">
					<section class="col col-6 flexibled-error">
						<label class="label">
							<?php echo e($layout->label->pls_guide_status->title); ?> <code>*</code>
							<?php if($errors->has('status')): ?>
								<div class="error-badge" id="for-status">
									<?php echo Helper::alert('danger', $errors->first('status')); ?>

								</div>
							<?php endif; ?>
						</label>
						<label class="select">
							<select class="input-sm border-0 border-bottom-1 status" name="status" >

								<?php echo Helper::empty_option(); ?>

								<?php echo Helper::show_status(); ?>

								
							</select><i></i>
						</label>
					</section>
				</div>
				
          	
        </div>
        <div class="modal-footer">        
          <button type="submit" name="save_detail" value="true" class="bt_save btn btn-default">
				<?php echo e($layout->label->save->title); ?>

		  </button>
                  
        </div>
        </form>
      </div>      
    </div>
  </div>


		
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		  function mypopup(guide_id,active) {	
		  	// $('.guide_id').prop('disabled', false);
	        $(".guide_id").val(guide_id);
	        // $('.status option[value="'+active+'"]').attr("disabled", true);	
	         $('.status option[value="'+active+'"]').attr("selected", true);			      
	    } 
	
	</script>
<?php $__env->stopSection(); ?>


 
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>