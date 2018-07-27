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
						.media-left img{width:40px;margin-left:5px;}
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
					    			<?php for($i=1;$i<=10;$i++){ ?>
					    				<li class="list-group-item">
							            <div class="media">
								              <div class="media-left">
								                <a href="#">
								                  <img class="media-object" src="https://yt3.ggpht.com/-cZmddsL7HZk/AAAAAAAAAAI/AAAAAAAAAAA/yG5YzQThO8E/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" alt="...">
								                </a>
								              </div>
								              <div class="media-body">
								                <h4 class="media-heading">Kandal Province</h4>
								                <span style='color:gray;font-size:12px'><b>100</b> Bookings | Province: Kompot & KPS</span>
								            </div>	
								            <div class="media-right">
								                <a href="#">
								                  <img class="media-object" src="https://image.flaticon.com/icons/svg/56/56994.svg" alt="...">
								                </a>
								              </div>
								        </div>
								        </li>
							        <?php } ?>
					 
					 </ul>

					
				