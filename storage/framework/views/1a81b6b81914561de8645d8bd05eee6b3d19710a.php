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
	
	.profile img{
		width: 200px;
	}
	.table > tbody > tr > td {
     vertical-align: middle;
     text-align: center;
	}
	.mycontainer{
		width:90%;
		margin:0 auto;
	}

</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content" id="content">
<div class="mycontainer">
	<form action="<?php echo e(route('travellers.index')); ?>" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >

<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#c2d6d6;padding:2px;margin:0px">       
        <div class="col-lg-3 col-md-3 col-xs-12">
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
                       <select value="<?php echo e(old('gender')); ?>" name="gender" onchange="return form.submit()" >
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
                       <?php echo e($layout->label->nationality->title); ?>

                            <?php if($errors->has('nationality_id')): ?>
                                <div class="error-badge" id="for-nationality_id">                                                            
                                    <?php echo Helper::alert('danger', $errors->first('nationality_id')); ?>

                                </div>
                            <?php endif; ?>
                </label>
                <label class="select">
                     <select value="<?php echo e(old('nationality_id')); ?>" name="nationality_id" onchange="return form.submit()" >
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
        
        
      

        <section class="col col-lg-1 col-md-1 col-xs-12 flexibled-error">
                <button type="submit"  class="btn-u btn btn-primary" style="width:100%;margin-top:30px;padding:2px">
                    <span class="button_search"><i class="fa fa-search"></i></span>
                 </button>   
        </section>    

</div>
</form>	
</div>

<div class="mycontainer  table table-responsive" >
		<table class="table table-responsive table-hover  table-bordered">
			<thead>
				<tr class="bg-header"  >
					<th style="width:10%">#<?php echo e($layout->label->id->title); ?></th>
					<th style="width:15%"><?php echo e($layout->label->fullname_en->title); ?></th>
					<th style="width:15%"><?php echo e($layout->label->fullname_kh->title); ?></th>
					<th><?php echo e($layout->label->gender->title); ?></th>
					<th><?php echo e($layout->label->telephone->title); ?></th>
					<th><?php echo e($layout->label->date_of_birth->title); ?></th>					
					<th><?php echo e($layout->label->nationality->title); ?></th>
					<th><?php echo e($layout->label->email->title); ?></th>
				
				</tr>
			</thead>
			<tbody>
			<?php if(count($users)==0): ?>	
				<tr  >
					<td colspan="8">
						<center>
							<h1 class="text text-danger"><?php echo e($layout->label->notfound->title); ?></h1>
						</center>
					</td>
				</tr>
			<?php endif; ?>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  
					$uid=$user["id"];
					$fullnameEN='' ;
					$fullnameKH='';
					$gender='' ;
					$guide_type='';
					$telephone='';
					$dob='';
					$nationality='';
					$photo='';
				 ?>
					<?php $__currentLoopData = $user["user_metas"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($v["meta_key"]=='fullname_en'): ?>
							<?php 
								$fullnameEN=$v["meta_value"]
							 ?>
						<?php endif; ?>
							<?php if($v["meta_key"]=='fullname_kh'): ?>
							<?php 
								$fullnameKH=$v["meta_value"]
							 ?>
						<?php endif; ?>
						<?php if($v["meta_key"]=='gender'): ?>
							<?php 
								$gender=$v["meta_value"]
							 ?>
						<?php endif; ?>
						<?php if($v["meta_key"]=='telephone'): ?>
							<?php 
								$telephone=$v["meta_value"]
							 ?>
						<?php endif; ?>
						<?php if($v["meta_key"]=='dob'): ?>
							<?php 
								$dob=$v["meta_value"]
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
						<?php if($v["meta_key"]=='photo'): ?>
							<?php 
								$photo=$v["meta_value"]
							 ?>
						<?php endif; ?>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						<?php 		
						$photo_path='';
                        if($photo!==''){
                           $file=Storage::url($uid.'/'. $photo);
                            if(!file_exists($file)){
                                $photo_path=Storage::url($uid.'/'. $photo);
                            }
                        }else{
                          $photo_path ='https://www.greatplacetowork.com/templates/gptw/images/no-image-available.jpg';
                        }
                         ?>

						<tr>
							<td class="profile">
								<code><?php echo e(Helper::convertNumber($user["id"])); ?></code><br>
								<img src="<?php echo e($photo_path); ?>"  class="img img-responsive img-thumbnail">
								
							</td>
							
							<td>								
									<?php echo e($fullnameEN); ?>

							</td>
							<td>								
									<?php echo e($fullnameKH); ?>

							</td>
							
							<td>
								
									<?php echo e(Helper::term_translate($gender)); ?>

						
							</td>
							<td>
								
									<?php echo e(Helper::convertNumber($telephone)); ?>

							
							</td>
							<td>
								
									<?php echo e(Helper::convertDate($dob,$format='full')); ?>

								
							</td>							
							
							<td>
								
									<?php echo e(Helper::term_translate($nationality)); ?>

							
							</td>
							<td>
								
									<?php echo e($user["email"]); ?>

								
							</td>
							
							
						
						</tr>
					
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		
		<div class="col-lg-12" >

			<div class="col-lg-2">
				   <h5>Total Records:<b> <?php echo e($totalRecords); ?></b></h5>
			</div>
			<div class="col-lg-3">
				<?php echo $users->appends(Input::except('page'))->links(); ?>

			</div>
	
		</div>

</div>













</div>








		
<?php $__env->stopSection(); ?>






 
<?php echo $__env->make('layouts.frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>