<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assets/admin/css/smartadmin-production-plugins.min.css')); ?>">
	<style type="text/css">
		@font-face {
		    font-family: writehand;
		    src: url("<?php echo e(asset('assets/admin/fonts/writehand.ttf')); ?>");
		}
		@font-face {
		    font-family: preyveng;
		    src: url("<?php echo e(asset('assets/admin/fonts/preyveng.ttf')); ?>");
		}
		.widget-toolbar{
			color:green;
		}
		.jarviswidget tbody tr:last-child td{
			max-height:40px;
		}
		.disabled{
			background-color: orange;
		}
		.btn-select-tick .active i{
			line-height: 30px;
			height: 30px;
		}
		.btn_save,.btn_delete{
			height: 45px;
			margin-top:10px;
			width:100%;
		}
		@import  url('//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');        
		.custom-bullet li {
		    display: block;
		    margin-top:10px;
		    border-bottom:1px solid green;
		}
		.custom-bullet li:hover{
			background-color: #f0f5f5;
		}
		.custom-bullet li:before
		{
		    /*Using a Bootstrap glyphicon as the bullet point*/
		    content: "\e080";
		    font-family: 'Glyphicons Halflings';
		    font-size: 9px;
		    float: left;
		    margin-top: 4px;
		    margin-left: -17px;
		    color: #CCCCCC;
		}
		.custom-bullet li a{
			font-size: 16px;
			font-family: "writehand";
		}
		.custom-bullet li  .description{
			font-family: "preyveng";
			padding-left: 10px;
		}
		.fc-title{
			font-family: 'preyveng';
			font-size: 13px;
			margin-top:5px;
			padding:5px;

		}
		.fc-title .ultra-light{
			font-size:11px;

		}
		 .event_id{
			display: none;
		}
		#bookings-frm,.smart-form .input input, .smart-form .select select, .smart-form .textarea textarea{
			font-family: "preyveng";
		}


	</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="content">
			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li>Home</li><li>Cool Features!</li><li>3 Calendar</li>
				</ol>
				
			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">
				<div class="row">	
					<div class="col-sm-12 col-md-12 col-lg-9">
						<?php if(Session::has('inserted')): ?>
							<section>
								<?php echo Helper::alert('success', Session::get('inserted'), 'block font-15'); ?>

							</section>
						<?php endif; ?>
						<?php if(Session::has('updated')): ?>
							<section>
								<?php echo Helper::alert('success', Session::get('updated'), 'block font-15'); ?>

							</section>
						<?php endif; ?>
						<?php if(Session::has('deleted')): ?>
							<section>
								<?php echo Helper::alert('danger', Session::get('deleted'), 'block font-15'); ?>

							</section>
						<?php endif; ?>
						<!-- new widget -->
						<div class="jarviswidget jarviswidget-color-blueDark">				
							<header>
							
								<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
								<h2> My Events </h2>
								<div class="widget-toolbar">
									<!-- add: non-hidden - to disable auto hide -->
									<div class="btn-group">										
										<select id="myselected">
											<option value="mt">Month</option>
											<option value="ag">Agenda</option>
											<option value="td">Today</option>
										</select>									
									</div>
								</div>
							</header>
							<!-- widget div-->
							<div>				
								<div class="widget-body no-padding">
									<!-- content goes here -->
									<div class="widget-body-toolbar">
				
										<div id="calendar-buttons">
				
											<div class="btn-group">
												<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
												<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
											</div>
										</div>
									</div>
									<div id="calendar"></div>
				
									<!-- end content -->
								</div>				
							</div>
							<!-- end widget div -->
						</div>
						<!-- end widget -->				
					</div>
					<!--end md 9-->
					<div class="col-lg-3 col-md-3">
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
								<?php  $i=0;  ?>
								<?php $__currentLoopData = $list_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php 
								 $i++;
								 if($i>10) break;
								 ?>
									<li>
										<a href="javascript:void(0)" class="fc-content"><span class="event_id"><?php echo e($booking["id"]); ?></span> <?php echo e($booking["title"]); ?></a><br>
										<span class="description"><?php echo e($booking["description"]); ?></span>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								    
								    
								</ul>
							</div>
							<!-- end widget div -->
						</div>
						<!-- end widget -->				
					</div>
					<!--end md 3-->
				
				</div>
				
				<!-- end row -->

			</div>
			<!-- END MAIN CONTENT -->

	

		

		

		<!--================================================== -->

		

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		

	
	
		

	
</div>



<div style="margin-left:300px"> 
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    	
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo e($layout->label->calendar_setting->title); ?></h4>
        </div>
        <div class="modal-body">
          	<div class="col-sm-12 col-md-12 col-lg-12 " style="">
						<!-- new widget -->
						<div class="jarviswidget jarviswidget-color-blueDark">
							<header>
								<h2> Add Events </h2>
							</header>				
							<!-- widget div-->
							<div>				
								<div class="widget-body">
									<!-- content goes here -->				
									<form id="bookings-frm" class="ajxfrm smart-form" data-validate="true" data-reload="true" method="post">
										<input type="hidden"  name="cmd" value="bookings">
										<?php echo e(csrf_field()); ?>

										<fieldset>				
											<div class="row">
												<section class="col col-8 flexibled-error">
													<label class="label">
														<?php echo e($layout->label->starting_fromto->title); ?> <code>*</code>
													</label>
													<label class="input">
														<div class="col-lg-5">
															<input type="text" id="starting" name="starting" value="<?php echo e(old('starting')); ?>"  class="input-sm border-0 border-bottom-1">
														</div>
														<div class="col-lg-2"></div>
														<div class="col-lg-5">															
															<input type="text" id="ending" name="ending" value="<?php echo e(old('ending')); ?>"  class="input-sm border-0 border-bottom-1">
														</div>
														
													
													</label>													
													
												</section>
											</div>
										
											<div class="row">
												<section class="col col-12 flexibled-error">
													<label class="label">
														<?php echo e($layout->label->select_icon->title); ?> <code>*</code>
														
															<div class="error-badge" id="for-iconselect">
																<?php echo Helper::alert('danger', $errors->first('iconselect')); ?>

															</div>
													
													</label>
													<div class="btn-group btn-group-sm btn-group-justified " data-toggle="buttons">
															<label class="btn btn-default">
																<input class="flexibled" type="radio" checked  value="fa-calendar" name="iconselect"  >
																<i class="fa fa-calendar text-muted"></i> 
															</label>
															<label class="btn btn-default">
																<input class="flexibled" value="fa-clock-o" type="radio" name="iconselect"  >
																<i class="fa fa-clock-o text-muted"></i> 
															</label>															
															
													</div>												
													
												</section>
											</div>


											<div class="row">
												<section class="col col-8 flexibled-error">
													<label class="label">
														<?php echo e($layout->label->booking_title->title); ?> <code>*</code>

														<?php if($errors->has('title')): ?>
															<div class="error-badge" id="for-title">
																<?php echo Helper::alert('danger', $errors->first('title')); ?>

															</div>
														<?php endif; ?>
													</label>
													<label class="input">
														<input type="hidden" name="booking_id" id="booking_id" value="" class="input-sm border-0 border-bottom-1">
														<input type="text" name="title" value="<?php echo e(old('title')); ?>" class="input-sm border-0 border-bottom-1">
													</label>													
													
												</section>
											</div>
											<div class="row">
												<section class="col col-8 flexibled-error">
													<label class="label">
														<?php echo e($layout->label->booking_description->title); ?> <code>*</code>

														<?php if($errors->has('description')): ?>
															<div class="error-badge" id="for-description">
																<?php echo Helper::alert('danger', $errors->first('description')); ?>

															</div>
														<?php endif; ?>
													</label>
													<label class="input">
														<textarea rows="5" class="form-control" name="description" id="description"></textarea>
													</label>													
													
												</section>
											</div>	
											<!-- <div class="form-group">
												<label>Select Event Color</label>
												<div class="btn-group btn-group-justified btn-select-tick" data-toggle="buttons">
													<label class="btn bg-color-darken active">
														<input type="radio" name="color" id="option1" value="bg-color-darken txt-color-white" checked>
														<i class="fa fa-check txt-color-white"></i> </label>
													<label class="btn bg-color-blue">
														<input type="radio" name="color" id="option2" value="bg-color-blue txt-color-white">
														<i class="fa fa-check txt-color-white"></i> </label>
													
												</div>
											</div> -->
											<div class="form-group">
												
												<div class="col-md-12">
													<input  name="btn_submit"  type="submit" class="btn_save btn btn-primary"  />													
													<input  name="cmd_submit"  type="hidden" class="btn_save btn btn-primary"  />
													<input  name="cmd_id"  type="hidden" class="btn_save btn btn-primary"  />
												</div>
											</div>
										</fieldset>
										
									</form>
									<div id="delete_form">
										<form id="delete_bookings-frm" class="ajxfrm smart-form" data-validate="true" data-reload="true" method="post" >
									
											<?php echo e(csrf_field()); ?>

											<input type="hidden"  name="cmd" value="dbooking">
											<div class="form-group">
												<div class="col-md-12">
													<input  name="cmd_id"  type="hidden" class="btn_save btn btn-primary"  />
													<button type="button" class="btn btn_delete btn-danger btn-xs jscfm">Delete</button>
												</div>
											</div>
										</form>
									</div>
									<!-- end content -->
								</div>
				
							</div>
							<!-- end widget div -->
						</div>
						<!-- end widget -->
				
						
					</div>
        </div>
        <!--end modal-body-->
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php

/*$events=array(
    array("id"=>"123","title"=>"All Day Event",'start'=>'2018-06-12','description'=>'Meeting Description','className'=>'event'),
    array("id"=>"124","title"=>"All Month Event",'start'=>'2018-06-22','end'=>'2018-06-25','description'=>'Meeting IT Description','className'=>'event'),
  );*/


$events=$list_bookings;
//echo json_encode($events,JSON_NUMERIC_CHECK);

?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

		

		

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?php echo e(URL::asset('assets/admin/js/plugin/bootstrap-slider/bootstrap-slider.min.js')); ?>"></script>


		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo e(URL::asset('assets/admin/js/app.config.js')); ?>"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="<?php echo e(URL::asset('assets/admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')); ?>"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo e(URL::asset('assets/admin/js/bootstrap/bootstrap.min.js')); ?>"></script>

		<!-- MAIN APP JS FILE -->
		<!--
		<script src="<?php echo e(URL::asset('assets/admin/js/app.min.js')); ?>"></script>
		-->
		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo e(URL::asset('assets/admin/js/plugin/moment/moment.min.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js')); ?>"></script>

		

		<script type="text/javascript">
		function formatDate(date) {
		    var d = new Date(date),
		        month = '' + (d.getMonth() + 1),
		        day = '' + (d.getDate()),
		        year = d.getFullYear();

		    if (month.length < 2) month = '0' + month;
		    if (day.length < 2) day = '0' + day;

		    return [year, month, day].join('-');
		}
		// DO NOT REMOVE : GLOBAL FUNCTIONS!		
		$(document).ready(function() {			
			pageSetUp();
			    "use strict";
			
			    var date = new Date();
			    var d = date.getDate();
			    var m = date.getMonth();
			    var y = date.getFullYear();
			
			    var hdr = {
			        left: 'title',
			        center: 'month,agendaWeek,agendaDay',
			        right: 'prev,today,next'
			    };
			
			    var initDrag = function (e) {
			        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			        // it doesn't need to have a start or end
			
			        var eventObject = {
			        	 id: $.trim(e.children('span').attr('data-id')),
			            title: $.trim(e.children().text()), // use the element's text as the event title
			            description: $.trim(e.children('span').attr('data-description')),
			            icon: $.trim(e.children('span').attr('data-icon')),
			            className: $.trim(e.children('span').attr('class')) // use the element's children as the event class
			        };
			        // store the Event Object in the DOM element so we can get to it later
			        e.data('eventObject', eventObject);
			
			        // make the event draggable using jQuery UI
			        e.draggable({
			            zIndex: 999,
			            revert: true, // will cause the event to go back to its
			            revertDuration: 0 //  original position after the drag
			        });

			    };
			
			    var addEvent = function (id,title, priority, description, icon) {

			    	id = id.length === 0 ? "Untitled ID" : id;
			        title = title.length === 0 ? "Untitled Event" : title;
			        description = description.length === 0 ? "No Description" : description;
			        icon = icon.length === 0 ? " " : icon;
			        priority = priority.length === 0 ? "label label-default" : priority;
			
			        var html = $('<li><span class="' + priority + '" data-id="' + id  + '" data-description="' + description + '" data-icon="' +
			            icon + '">' + title + '</span></li>').prependTo('ul#external-events').hide().fadeIn();
			
			        $("#event-container").effect("highlight", 800);
			
			        initDrag(html);
			    };
			
			    /* initialize the external events
				 -----------------------------------------------------------------*/
			
			    $('#external-events > li').each(function () {
			        initDrag($(this));
			    });
			
			    $('#add-event').click(function () {
			    	var id = $('#myid').val(),
			        	title = $('#title').val(),
			            priority = $('input:radio[name=priority]:checked').val(),
			            description = $('#description').val(),
			            icon = $('input:radio[name=iconselect]:checked').val();
			
			        addEvent(id,title, priority, description, icon);

			    });
			
			    /* initialize the calendar
				 -----------------------------------------------------------------*/
				
			    $('#calendar').fullCalendar({
					selectable: true,
					allDay: true,
			        header: hdr,			       
			        editable: true,
			        droppable: true, // this allows things to be dropped onto the calendar !!!
			
			        drop: function (date, allDay) { // this function is called when something is dropped
			
			            // retrieve the dropped element's stored Event Object
			            var originalEventObject = $(this).data('eventObject');
			
			            // we need to copy it, so that multiple events don't have a reference to the same object
			            var copiedEventObject = $.extend({}, originalEventObject);
			
			            // assign it the date that was reported
			            copiedEventObject.start = date;
			            copiedEventObject.allDay = allDay;
			
			            // render the event on the calendar
			            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			            // is the "remove after drop" checkbox checked?
			            if ($('#drop-remove').is(':checked')) {
			                // if so, remove the element from the "Draggable Events" list
			                $(this).remove();
			                 console.log('Have been drop');
			            }
			
			        },
					
					// dayClick: function(day) {
					//   console.log('Day Click'+day);
					// },

			        select: function (startDate, endDate, allDay) {		
			        	var oneDay = 1000 * 60 * 60 * 24; //Convert into millisec  
			        	

			        	var sta=startDate.format();
			            sta = new Date(startDate);
			            var end=endDate.format();
			            end	= new Date(endDate);
			            end.setDate(end.getDate()-1);	//for showing on UI	

			       
			             sta=formatDate(sta);
			             end=formatDate(end);
			             console.log(sta);
			             console.log(end);
			           	
			            $('#myModal').modal(
				            {
							    backdrop: 'static',
							    keyboard: false
							}
						);
						$('#myModal').modal('show');
						$('#delete_form').hide();
						$("#bookings-frm")[0].reset();
						$(".fc-highlight").css("background", "red");
						$('#starting').val(sta);
						$('#ending').val(end);
						$('input[name="btn_submit"]').val('Save');
						$('input[name="cmd_submit"]').val('Save');
			            
			        },

					events: <?php echo json_encode($events,JSON_NUMERIC_CHECK); ?> ,			        
			
			        eventRender: function (event, element, icon) {
			        	
			            if (!event.description == "") {
			                element.find('.fc-title').append("<br/>"+
			                "<span class='event_id'>" + event.id +
			                    "</span>"+
			                 "<span class='ultra-light'>" + event.description +
			                    "</span>"+
			                " ");
			            }
			            if (!event.icon == "") {
			                element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon +
			                    " '></i>");
			            }

			             var month = $(this).find(":selected").attr('data-month'),
        						year = $("#calendar").fullCalendar('getDate').format('YYYY');
    					console.log(month);
   						/* var m = moment([year, month, 1]).format('YYYY-MM-DD');
						$('#calendar').fullCalendar('gotoDate', m );
						console.log(m);*/


			        },
			
			        windowResize: function (event, ui) {
			            $('#calendar').fullCalendar('render');
			        }
			    });
			
			    /* hide default buttons */
			    $('.fc-right, .fc-center').hide();

			
				$('#calendar-buttons #btn-prev').click(function () {
				    $('.fc-prev-button').click();
				    return false;
				});
				
				$('#calendar-buttons #btn-next').click(function () {
				    $('.fc-next-button').click();
				    return false;
				});
				
				$('#calendar-buttons #btn-today').click(function () {
				    $('.fc-today-button').click();
				    return false;
				});
				
				


				$('#myselected').change(function () {
				    var selectedValue=$('#myselected').val();
				    switch(selectedValue) {
					    case 'mt':
					        $('#calendar').fullCalendar('changeView', 'month');
					        break;
					    case 'ag':
					       $('#calendar').fullCalendar('changeView', 'agendaWeek');
					        break;
					    case 'td':
					       $('#calendar').fullCalendar('changeView', 'agendaDay');
					        break;
					    default:
					        $('#calendar').fullCalendar('changeView', 'month');
					}
				});
				$('#calendar').on('click', 'div.fc-content', function (e) {
					// $('.fc-content2').click(function(){	
					var booking_id = $(this).find(".event_id").html();
					$.ajax({
						url: 'ajax/edit_booking',
						type: "POST",								
						data: {id : booking_id},
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						success: function(data) {
							 var end	= new Date(data.booking.end);
	            			 end.setDate(end.getDate()-1);	//for showing on UI	
	            			 end=formatDate(end);


							 	$('#myModal').modal(
						            {
									    backdrop: 'static',
									    keyboard: false
									}
								);
								$('#myModal').modal('show');
								$('#delete_form').show();
								$("#bookings-frm")[0].reset();
								$(".fc-highlight").css("background", "red");
								$('#starting').val(data.booking.start);
								$('#ending').val(end);
								$('#booking_id').val(data.booking.id);
								$('input[name="title"]').val(data.booking.title);
								$('#description').val(data.booking.description);
								$('input[name="btn_submit"]').val('Update');
								$('input[name="cmd_submit"]').val('Update');
								$('input[name="cmd_id"]').val(data.booking.id);

								// var m=data.booking.end;
								//  $('#calendar').fullCalendar('gotoDate', m );

								// pppppppp

								

						},
						error: function (responseData, textStatus, errorThrown) {
							console.log('error');
						}
					});
					// });


				});










			$('.fc-content').click(function(){	
					var booking_id = $(this).find(".event_id").html();
					$.ajax({
						url: 'ajax/edit_booking',
						type: "POST",								
						data: {id : booking_id},
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						success: function(data) {
							 var end	= new Date(data.booking.end);
	            			 end.setDate(end.getDate()-1);	//for showing on UI	
	            			 end=formatDate(end);


							 	$('#myModal').modal(
						            {
									    backdrop: 'static',
									    keyboard: false
									}
								);
								$('#myModal').modal('show');
								$('#delete_form').show();
								$("#bookings-frm")[0].reset();
								$(".fc-highlight").css("background", "red");
								$('#starting').val(data.booking.start);
								$('#ending').val(end);
								$('#booking_id').val(data.booking.id);
								$('input[name="title"]').val(data.booking.title);
								$('#description').val(data.booking.description);
								$('input[name="btn_submit"]').val('Update');
								$('input[name="cmd_submit"]').val('Update');
								$('input[name="cmd_id"]').val(data.booking.id);
						},
						error: function (responseData, textStatus, errorThrown) {
							console.log('error');
						}
					});
		});


				
		
		});//end ready

		</script>




  

<?php $__env->stopSection(); ?>


 
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>