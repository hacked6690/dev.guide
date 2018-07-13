<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assets/admin/css/smartadmin-production-plugins.min.css')); ?>">
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('assets/admin/css/mycalendar.css')); ?>"> -->
	<style type="text/css">
	li .event_date{
		font-size:15px;
		margin-right: 10px;
	}
	li .event_title{
		font-size:13px;
		margin-left:30px;
		font-family: 'preyveng';
	}
	.text-transform{
		text-transform: uppercase;
	}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="content">			
<!-- https://pusher.com/tutorials/chat-laravel/ -->
			<!-- MAIN CONTENT -->
			<div id="content">
				
				<div class="row">	
					<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="panel panel-primary">
						    <div class="panel-heading">
						        <h4 class="text text-transform"><i class="far fa-bell"></i> Upcoming Events</h4>
						    </div>
						    <div id="app">
		                      <events></events>
		                    </div>
						    <div class="panel-body">
						    	<template id="event-template">
						        <div class="row" style="margin:0px">						            
						                <ul class="list-group" v-for="event in events">
						                	
						                	<li class="list-group-item">
						                		<span class="event_date"><i class="fas fa-calendar-alt"></i> {{event.start}}=> {{event.end}}</span>
						                		<br>
						                		<span class="event_title">{{event.title}}</span>
						                	</li>	
						                			                	
						                </ul>				
						        </div>
						        </template>
						    </div>
						</div>
						<div class="panel panel-primary">
						    <div class="panel-heading">
						        <h4 class="text text-transform"><i class="far fa-bell"></i> Upcoming Bookings</h4>
						    </div>
						    <div id="app2">
		                      <bookings></bookings>
		                    </div>
						    <div class="panel-body">
						    	<template id="booking-template">
						        <div class="row" style="margin:0px">						            
						                <ul class="list-group" v-for="booking in bookings">
						                	
						                	<li class="list-group-item">
						                		<span class="event_date"><i class="fas fa-calendar-alt"></i> {{booking.start}}=> {{booking.end}}</span>
						                		<br>
						                		<span class="event_title">{{booking.title}}</span>
						                	</li>	
						                			                	
						                </ul>				
						        </div>
						        </template>
						    </div>
						</div>
						
					</div>
					<div class="col-sm-12 col-md-9 col-lg-9">
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
					<!--end md 12-->	
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
									<form id="bookings-frm" class="ajxfrm smart-form" data-validate="true" data-reload="false" method="post">
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
												<section class="col col-lg-12 col-6 flexibled-error">
													 <label class="label">
								                        <?php echo e($layout->label->booking_status->title); ?> 
								                        <?php if($errors->has('booking_status')): ?>
								                            <div class="error-badge" id="for-booking_status">
								                             <?php echo Helper::alert('danger', $errors->first('booking_status')); ?>

								                             </div>
								                       <?php endif; ?>
								                    </label>
								                    <label class="select" >
								                       <select value="<?php echo e(old('booking_status')); ?>" name="booking_status" id="booking_status" >
								                           <option value=""  ><?php echo e($layout->label->please_select_below->title); ?></option>
								                              <?php $__currentLoopData = $booking_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								                                  
								                                      <option value="<?php echo e($bs->term_id); ?>"  ><?php echo e($bs->title); ?></option>
								                                
								                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								                      </select>
								                      <i></i>
								                    </label>
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
										<form id="delete_bookings-frm" class="ajxfrm smart-form" data-validate="true" data-reload="false" method="post" >									
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
		<!--<script src="<?php echo e(URL::asset('assets/admin/js/bootstrap/bootstrap.min.js')); ?>"></script>-->
		<!-- MAIN APP JS FILE -->
		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo e(URL::asset('assets/admin/js/plugin/moment/moment.min.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js')); ?>"></script>




		    <!-- Vue js script -->  
					    <script type="text/javascript" src="https://unpkg.com/vue/dist/vue.js"></script>
					<!-- end vuejs script -->
                  <script type="text/javascript">

                    Vue.component('events',{
                        template:'#event-template',
                        data: function(){
                            return {
                                events:[]
                            }
                        },
                        created: function(){
                            this.getEvents();
                            
                        },
                         methods: {
					            getEvents: function(){
					             $.getJSON("<?php echo e(route('api_upcoming_event')); ?>", function(events){
					             this.events=events;					             
					            }.bind(this));
					             setTimeout(this.getEvents,1000);
					            }
					        }
                       

                    });

                    new Vue({
                      el:"#app",
                    });

                     Vue.component('bookings',{
                        template:'#booking-template',
                        data: function(){
                            return {
                                bookings:[]
                            }
                        },
                        created: function(){
                            this.getBookings();
                            
                        },
                         methods: {
					            getBookings: function(){
					             $.getJSON("<?php echo e(route('api_upcoming_booking')); ?>", function(bookings){
					             this.bookings=bookings;					             
					            }.bind(this));
					             setTimeout(this.getBookings,1000);
					            }
					        }
                       

                    });

                    new Vue({
                      el:"#app2",
                    });
                 </script>








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

			         //If previous date not available noted...
		                if(startDate.isBefore(moment())) {
		                    $('#calendar').fullCalendar('unselect');
		                    return false;
		                }


			        	var oneDay = 1000 * 60 * 60 * 24; //Convert into millisec
			        	var sta=startDate.format();
			            sta = new Date(startDate);
			            var end=endDate.format();
			            end	= new Date(endDate);
			            end.setDate(end.getDate()-1);	//for showing on UI				       
			             sta=formatDate(sta);
			             end=formatDate(end);
			             /*console.log(sta);
			             console.log(end);		*/	           	
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
								$('#booking_status').val(data.booking.booking_status);
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