<div class="col-lg-3 col-md-3" style="display:none">
						<div class="jarviswidget jarviswidget-color-blueDark">				
							<header>
								<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
								<h2> Recent Active Booking </h2>
								<div class="widget-toolbar">
									
								</div>
							</header>
							<!-- widget div-->
							<div>				
								<ul class="custom-bullet">
								@php $i=0; @endphp
								@foreach($list_bookings as $booking)
								@php
								 $i++;
								 if($i>10) break;
								@endphp
									<li>
										<a href="javascript:void(0)" class="fc-content"><span class="event_id">{{$booking["id"]}}</span> {{$booking["title"]}}</a><br>
										<span class="description">{{$booking["description"]}}</span>
									</li>
								@endforeach
								    
								    
								</ul>
							</div>
							<!-- end widget div -->
						</div>
						<!-- end widget -->				
					</div>
					<!--end md 3-->