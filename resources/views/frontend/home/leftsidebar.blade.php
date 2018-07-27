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
							    				{{$layout->label->guide_by_location->title}}
							    		</li>	
					    				@foreach($provinces as $pro)
					    				<li class="list-group-item">
							            <div class="media">
								              <div class="media-left">
								                <a href="/guides?province_id={{$pro->term_id}}">
								                  <img class="media-object" src="https://d.ibtimes.co.uk/en/full/1468607/google-maps.png" alt="...">
								                </a>
								              </div>
								              <div class="media-body">
								                <h4 class="media-heading">
								                	 <a href="/guides?province_id={{$pro->term_id}}">
								                		{{$pro->title}}
								                	</a>
								                </h4>
								                
								                <span style='color:gray;font-size:12px'><b>{{GuidesController::countGuideByProvince($pro->term_id)}}</b> {{$layout->label->guide->title}}</span>
								            </div>	
								            <div class="media-right">
								                 <a href="/guides?province_id={{$pro->term_id}}">
								                  <img class="media-object" src="https://image.flaticon.com/icons/svg/56/56994.svg" alt="...">
								                </a>
								              </div>
								        </div>
								        </li>
								        
					    		@endforeach
					    				
							    				 
					 </ul>
					 <ul class="list-group">
					    				<li class="list-group-item  li_parent mybg">
					    						<img src="https://cdn4.iconfinder.com/data/icons/free-large-boss-icon-set/512/Security.png">
							    				{{$layout->label->top_guide->title}}
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

					
				