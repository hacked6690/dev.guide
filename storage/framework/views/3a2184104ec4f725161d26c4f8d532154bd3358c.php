<?php 
use App\Http\Controllers\frontend\GuidesController; 
use App\User; 
use Illuminate\Support\Facades\Storage;
?>
 <form action="<?php echo e(route('guides.index')); ?>" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >
<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#ffe699">       
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
                        <input type="text" value="<?php echo e($searchField->fullname_en); ?>" name="fullname_en" placeholder="<?php echo e($layout->label->fullname_en->title); ?>">
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





<?php if(count($users)==0): ?>   
                <tr>
                    <td colspan="7">
                        NO DATA FOUND
                    </td>
                </tr>
            <?php endif; ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php  
                    $uid=$user["id"];
                    $fullnameEN='' ;
                    $gender='' ;
                    $guide_type='';
                    $nationality='';
                    $photo='';
                    $dob='';
                 ?>
                    <?php $__currentLoopData = $user["user_metas"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $um): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                       <?php 
                        switch($um["meta_key"]){
                            case 'fullname_en' : $fullname_en = $um["meta_value"];break;
                            case 'fullname_kh' : $fullname_kh = $um["meta_value"];break;
                            case 'license_id' : $license_id = $um["meta_value"];break;
                            case 'address' : $address = $um["meta_value"];break;
                            case 'dob' : $dob = $um["meta_value"];break;
                            case 'gender' : $gender = $um["meta_value"];break;
                            case 'telephone' : $telephone = $um["meta_value"];break;
                            case 'nationality_id' : $nationality_id = $um["meta_value"];break;
                    
                            case 'generation' : $generation = $um["meta_value"];break;
                            case 'guide_certified' : $guide_certified = $um["meta_value"];break;
                            case 'behavior_certified' : $behavior_certified = $um["meta_value"];break;
                            case 'id_card' : $id_card = $um["meta_value"];break;
                            case 'partner_id' : $partner_id = $um["meta_value"];break;
                            case 'cv_provided' : $cv_provided = $um["meta_value"];break;
                            case 'guide_type_id' : $guide_type_id = $um["meta_value"];break;
                            case 'domicile_certified' : $domicile_certified = $um["meta_value"];break;
                            case 'new_renew' : $new_renew = $um["meta_value"];break;
                            case 'issued_date' : $issued_date = $um["meta_value"];break;
                            case 'expired_date' : $expired_date = $um["meta_value"];break;
                            case 'date_in_service' : $date_in_service = $um["meta_value"];break;
                            case 'photo' : $photo = $um["meta_value"];break;
                        }
                        $photo_path='';
                        if($photo!==''){
                           $file=Storage::url($uid.'/'. $photo);
                            if(!file_exists($file)){
                                $photo_path=Storage::url($uid.'/'. $photo);
                            }
                        }else{
                          $photo_path ='https://cdn1.iconfinder.com/data/icons/rcons-user-action/512/user-512.png';
                        }
                       
                        $url='/guides/'.Helper::encodeString($uid,Helper::encryptKey());
                        $profileID=Helper::encodeString($uid,Helper::encryptKey());
                        $date1=new DateTime($dob);
                        $date_2 = new DateTime( date( 'Y-m-d' ) );
                        $difference = $date_2->diff( $date1);
                        $age= $difference->y;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                    $guide_prices=$user["guide_price"];
                    $gp_language="";
                    $gp_province="";
                    $gp_price="";
                    //$gp is guide price
                    foreach ($guide_prices as $gp) {    
                       if($gp["default"]=='yes'){
                            $gp_language=($gp["default"]=='yes')?$gp["language_id"]:"";
                            $gp_province=($gp["default"]=='yes')?$gp["province_id"]:"";   
                            $gp_price=($gp["default"]=='yes')?$gp["price"]:""; 
                       }
                    }
                     ?>

                    <div class="row" >
            <div class="well well-sm" style="margin-bottom:10px">
                <div class="row blockguide" >
                    <div class="col-xs-12 col-md-2 text-center">
                        <a href="/guides/detail/<?php echo e($profileID); ?>">
                        <img src="<?php echo e($photo_path); ?>" alt="Guide"
                            class="img-thumbnail img img-responsive guideprofile" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6 section-box">
                        <h2 class="text text-info">
                             <a href="/guides/detail/<?php echo e($profileID); ?>"><?php echo e($fullname_en); ?></a>
                                <span style="font-size:14px">
                                    <span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="separator">|</span>
                                    <!-- <span class="glyphicon glyphicon-comment"></span>(100 Comments) -->
                                     (<i><?php echo e($layout->label->fullname_kh->title); ?></i>):
                                     &nbsp;
                                </span>    
                             <a href="/guides/detail/<?php echo e($profileID); ?>"><?php echo e($fullname_kh); ?></a>                           
                        </h2>
                        <p>
                            <?php echo e($layout->label->nationality->title); ?>: <?php echo e(Helper::term_translate($nationality_id)); ?>

                            | <?php echo e($layout->label->date_of_birth->title); ?>:<?php echo e(Helper::convertDate($dob,$format='full')); ?> &nbsp; 
                            | <?php echo e($layout->label->guide_age->title); ?> : <?php echo e(Helper::convertNumber($age)); ?> <?php echo e($layout->label->year->title); ?>

                            | <?php echo e($layout->label->gender->title); ?>: <?php echo e(Helper::term_translate($gender)); ?> <br>
                            | <?php echo e($layout->label->guide_type->title); ?>: <?php echo e(Helper::term_translate($guide_type_id)); ?> 
                        </p>
                         <p>
                            <?php echo e($layout->label->location->title); ?>: <?php echo e(Helper::term_translate($gp_province)); ?> | <?php echo e($layout->label->language->title); ?>: <?php echo e(Helper::term_translate($gp_language)); ?> 
                        </p>
                        <p>
                            <?php echo e($layout->label->number_of_booking->title); ?>: <b><?php echo e(Helper::convertNumber(Helper::countBooking($uid))); ?></b> <?php echo e($layout->label->number_booking->title); ?>

                        </p>
                       
                       
                    </div>
                     <div class="col-xs-12 col-md-2 text-center">
                        <h3 class="price"><b><?php echo e(Helper::convertNumber($gp_price)); ?> </b> <?php echo e($layout->label->usd->title); ?></h3>
                        <em class="perday"><?php echo e($layout->label->per_day->title); ?></em>
                       
                    </div>
                    <div class="col-xs-12 col-md-2 text-center">
                         <img src="data:image/png;base64,<?php echo e(base64_encode(QrCode::format('png')->size(140)->generate($url))); ?> ">
                    </div>
                </div>
            </div>
            </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<div class="col-lg-12" >

            <div class="col-lg-2">
                   <h5>Total Records:<b> <?php echo e($totalRecords); ?></b></h5>
            </div>
            <div class="col-lg-3">
                <?php echo $users->appends(Input::except('page'))->links(); ?>

            </div>
    
        </div>


 </form>  