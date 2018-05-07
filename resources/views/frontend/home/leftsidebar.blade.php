					<ul class="list-group">
					    				<li class="list-group-item  li_parent">
					    						<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/14236-200.png">
							    				Searching Guide...
							    		</li>
							    		<li class="list-group-item">
								    		<form action="{{ route('guides.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="post" enctype="multipart/form-data">								    	
								    		
								    				<section class="flexibled-error">
															<label class="label">Guide's name: </label>
															<label class="input">
																<input type="text" value="" name="license_id" placeholder="">
															</label>
													</section>
													<section class="flexibled-error">
															<label class="label">Nationality: </label>
															<label class="select">
																<select>
																	<option selected disabled>Choose nationality</option>
																</select>
																<i></i>
															</label>
													</section>
													<section class="flexibled-error">
															<label class="label">Language: </label>
															<label class="select">
																<select>
																	<option selected disabled>Choose Language</option>
																</select>
																<i></i>
															</label>
													</section>
													<section class="flexibled-error">
															<label class="label">Location: </label>
															<label class="select">
																<select>
																	<option selected disabled>Choose Location</option>
																</select>
																<i></i>
															</label>
													</section>
													<section class="flexibled-error">
															<label class="label">Guide Type: </label>
															<label class="select">
																<select>
																	<option selected disabled>Choose Guide Type</option>
																</select>
																<i></i>
															</label>
													</section>
													<button type="submit"  class="btn-u" style="width:100%">
															<span class="button_search"><i class="fa fa-search"></i></span>
															Search	

													</button>								    		
							    		</li>
					    							 
					 </ul>
					<ul class="list-group">
					    				<li class="list-group-item  li_parent">
					    						<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/14236-200.png">
							    				Guide By Location...
							    		</li>	
					    			<?php for($i=1;$i<=10;$i++){ ?>
					    				<li class="list-group-item">
							            <div class="media">
								              <div class="media-left">
								                <a href="#">
								                  <img class="media-object" src="https://d.ibtimes.co.uk/en/full/1468607/google-maps.png" alt="...">
								                </a>
								              </div>
								              <div class="media-body">
								                <h4 class="media-heading">Kandal Province</h4>
								                <span style='color:gray;font-size:12px'><b>100</b> Guides</span>
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
					 <ul class="list-group">
					    				<li class="list-group-item  li_parent">
					    						<img src="https://cdn4.iconfinder.com/data/icons/free-large-boss-icon-set/512/Security.png">
							    				Top 10 Guides...
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

					
					<div class="headline-v2 bg-color-light"><h2>Top 10 Guides</h2></div>
					<!-- Photostream -->
					<ul class="list-inline blog-photostream margin-bottom-50">
						<li>
							<a href="assets/img/main/img22.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 1">
								<span><img class="img-responsive" src="assets/img/main/img22.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img23.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 2">
								<span><img class="img-responsive" src="assets/img/main/img23.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img4.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 3">
								<span><img class="img-responsive" src="assets/img/main/img4.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img9.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 4">
								<span><img class="img-responsive" src="assets/img/main/img9.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img25.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 5">
								<span><img class="img-responsive" src="assets/img/main/img25.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img6.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 6">
								<span><img class="img-responsive" src="assets/img/main/img6.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img20.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 7">
								<span><img class="img-responsive" src="assets/img/main/img20.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img3.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 8">
								<span><img class="img-responsive" src="assets/img/main/img3.jpg" alt=""></span>
							</a>
						</li>
						<li>
							<a href="assets/img/main/img7.jpg" rel="gallery" class="fancybox img-hover-v2" title="Image 9">
								<span><img class="img-responsive" src="assets/img/main/img7.jpg" alt=""></span>
							</a>
						</li>
					</ul>
					<!-- End Photostream -->