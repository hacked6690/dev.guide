<?php 
use App\Http\Controllers\frontend\GuidesController; 
use App\User; 
use Illuminate\Support\Facades\Storage;
?>
					<style type="text/css">
						.list-group-item{
							padding:5px 10px;
						}
						
						.media-heading{margin-bottom: -5px;}
						.media-left img{width:40px;height:40px;border-radius:2px;margin-left:5px;}
					</style>
					
					 <ul class="list-group" >
					    				<li class="list-group-item  li_parent mybg" >
					    						<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/14236-200.png">
							    				<?php echo e($layout->label->guide_by_location->title); ?>

							    		</li>	
					    				<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    				<li class="list-group-item">
							            <div class="media">
								              <div class="media-left">
								                <a href="/guides?province_id=<?php echo e($pro->term_id); ?>">
								                  <img class="media-object" src="https://d.ibtimes.co.uk/en/full/1468607/google-maps.png" alt="...">
								                </a>
								              </div>
								              <div class="media-body">
								                <h4 class="media-heading">
								                	 <a href="/guides?province_id=<?php echo e($pro->term_id); ?>">
								                		<?php echo e($pro->title); ?>

								                	</a>
								                </h4>
								                
								                <span style='color:gray;font-size:12px'><b><?php echo e(GuidesController::countGuideByProvince($pro->term_id)); ?></b> <?php echo e($layout->label->guide->title); ?></span>
								            </div>	
								            <div class="media-right">
								                 <a href="/guides?province_id=<?php echo e($pro->term_id); ?>">
								                  <img class="media-object" src="https://image.flaticon.com/icons/svg/56/56994.svg" alt="...">
								                </a>
								              </div>
								        </div>
								        </li>
								        
					    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    				
							    				 
					 </ul>
					 <ul class="list-group">
					    				<li class="list-group-item  li_parent mybg">
					    						<img src="https://cdn4.iconfinder.com/data/icons/free-large-boss-icon-set/512/Security.png">
							    				<?php echo e($layout->label->top_guide->title); ?>

							    		</li>	
							    	<?php $__currentLoopData = $popularGuide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								    	<?php 
								    			$uid=$pg->guide_id;
								    		  $user_meta=Helper::metas('user_meta',['user_id' => $uid] );
								    		  $name=(isset($user_meta->fullname_en) && ($user_meta->fullname_en->value!==''))?$user_meta->fullname_en->value:'';
								    		  $photo_path="https://cdn1.iconfinder.com/data/icons/rcons-user-action/512/user-512.png";
												if(isset($user_meta->photo) && ($user_meta->photo->value)!=="")
												$photo_path=Storage::url($uid.'/' . $user_meta->photo->value);
												$url='/guides/detail/'.Helper::encodeString($uid,Helper::encryptKey());
								    	 ?>
							    		<li class="list-group-item">
							            <div class="media">
								              <div class="media-left">
								                <a target="_blank" href="<?php echo e($url); ?>">
								                  <img class="media-object" src="<?php echo e($photo_path); ?>" alt="...">
								                </a>
								              </div>
								              <div class="media-body">
								                <h4 class="media-heading"><a target="_blank" href="<?php echo e($url); ?>"><?php echo e($name); ?></a></h4>
								                <span style='color:gray;font-size:12px'><b><?php echo e(Helper::convertNumber($pg->CO)); ?></b> <?php echo e($layout->label->number_booking->title); ?> </span>
								            </div>	
								            <div class="media-right">
								                <a  target="_blank" href="<?php echo e($url); ?>">
								                  <img class="media-object" src="https://image.flaticon.com/icons/svg/56/56994.svg" alt="...">
								                </a>
								              </div>
								        </div>
								        </li>
							    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    			
					 
					 </ul>

					
				