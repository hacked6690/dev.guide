<?php 
use App\Http\Controllers\frontend\GuidesController; 
use App\User; 
use Illuminate\Support\Facades\Storage;
?>
 <form action="<?php echo e(route('guides.index')); ?>" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >
<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#c2d6d6">       
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


<?php


if(sizeof($users)==0){
    echo "<h2 class='text text-center text-danger' style='padding:100px;font-size:66px'>NO DATA FOUND!!!</h2>";
}

foreach ($users as $key=>$value) {
    $uid=$value->id;
  $url='/guides/'.Helper::encodeString($value->id,Helper::encryptKey());
  $uemail=$value->email;  

$user_meta=Helper::metas('user_meta',['user_id' => $uid] );
$guide_prices=$value->guide_price;

$gp_language="";
$gp_province="";
$gp_price="";
//$gp is guide price
foreach ($guide_prices as $key => $value) {    
   if($value->default=='yes'){
        $gp_language=($value->default=='yes')?$value->language->title:"";
        $gp_province=($value->default=='yes')?$value->province->title:"";   
        $gp_price=($value->default=='yes')?$value->price:""; 
   }
}

$photo_path='';
$file=Storage::url('guide_profile_test/' . $user_meta->photo->value);
if(!file_exists($file)){
    $photo_path=Storage::url('guide_profile_test/' . $user_meta->photo->value);
}


$date1=new DateTime($user_meta->dob->value);
$date_2 = new DateTime( date( 'Y-m-d' ) );
$difference = $date_2->diff( $date1);
$age= $difference->y;
$profileID=Helper::encodeString($uid,Helper::encryptKey());
// $profileID=$uid;

 
echo '
  <div class="row" >
            <div class="well well-sm" style="margin-bottom:10px">
                <div class="row" >
                    <div class="col-xs-12 col-md-2 text-center">
                        <a href="/guides/detail/'.$profileID.'">
                        <img src="'. $photo_path .'" alt="Guide"
                            class="img-rounded img-responsive guideprofile" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6 section-box">
                        <h2 class="text text-info">
                             <a href="/guides/detail/'.$profileID.'">'.$user_meta->fullname_en->value.'</a>
                                <span style="font-size:14px">
                                    <span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="separator">|</span>
                                    <span class="glyphicon glyphicon-comment"></span>(100 Comments)
                                </span>                               
                        </h2>
                        <p>
                            '.$layout->label->nationality->title.': '.$user_meta->nationality_id->title.' 
                            | '.$layout->label->date_of_birth->title.':'.$user_meta->dob->value.' 
                            | '.$layout->label->gender->title.': '.$user_meta->gender->title.' 
                            | '.$layout->label->guide_type->title.': '.$user_meta->guide_type_id->title.'  
                        </p>
                         <p>
                            '.$layout->label->location->title.': '.$gp_province.' | '.$layout->label->language->title.': '.$gp_language.'  
                        </p>
                        <p>
                            '.$layout->label->number_of_booking->title.': <b>34</b> BOOKINGS
                        </p>
                       
                       
                    </div>
                     <div class="col-xs-12 col-md-2 text-center">
                        <h3 class="price"><b>'.$gp_price.'</b> '.$layout->label->usd->title.'</h3>
                        <em class="perday">'.$layout->label->per_day->title.'</em>
                       
                    </div>
                    <div class="col-xs-12 col-md-2 text-center">
                         <img src="data:image/png;base64,'.base64_encode(QrCode::format("png")->size(140)->generate($url)).' ">
                    </div>
                </div>
            </div>
    </div>
    ';



}

?>






<div class="table-footer">
<?php echo Helper::customPagination($page,$totalPage,$totalRecord,$display); ?>


</div>


 </form>  