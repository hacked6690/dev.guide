@extends('layouts.admin.master')

@section('style')
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/admin/css/smartadmin-production-plugins.min.css') }}">
	<style type="text/css">
		.widget-toolbar{
			color:green;
		}
		.jarviswidget tbody tr:last-child td{
			max-height:40px;
		}
		.disabled{
			background-color: orange;
		}
	</style>
@endsection
@section('content')
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
					<div class="col-sm-12 col-md-12 col-lg-3 " style="display:none">
						<!-- new widget -->
						<div class="jarviswidget jarviswidget-color-blueDark">
							<header>
								<h2> Add Events </h2>
							</header>
				
							<!-- widget div-->
							<div>
				
								<div class="widget-body">
									<!-- content goes here -->
				
									<form id="add-event-form">
										<fieldset>
				
											<div class="form-group">
												<label>Select Event Icon</label>
												<div class="btn-group btn-group-sm btn-group-justified" data-toggle="buttons">
													<label class="btn btn-default active">
														<input type="radio" name="iconselect" id="icon-1" value="fa-info" checked>
														<i class="fa fa-info text-muted"></i> </label>
													<label class="btn btn-default">
														<input type="radio" name="iconselect" id="icon-2" value="fa-warning">
														<i class="fa fa-warning text-muted"></i> </label>
													<label class="btn btn-default">
														<input type="radio" name="iconselect" id="icon-3" value="fa-check">
														<i class="fa fa-check text-muted"></i> </label>
													<label class="btn btn-default">
														<input type="radio" name="iconselect" id="icon-4" value="fa-user">
														<i class="fa fa-user text-muted"></i> </label>
													<label class="btn btn-default">
														<input type="radio" name="iconselect" id="icon-5" value="fa-lock">
														<i class="fa fa-lock text-muted"></i> </label>
													<label class="btn btn-default">
														<input type="radio" name="iconselect" id="icon-6" value="fa-clock-o">
														<i class="fa fa-clock-o text-muted"></i> </label>
												</div>
											</div>
											
											<div class="form-group">
												<label>Event ID</label>
												<input class="form-control"  id="myid" name="myid" maxlength="40" type="text" placeholder="Event ID">
											</div>

											<div class="form-group">
												<label>Event Title</label>
												<input class="form-control"  id="title" name="title" maxlength="40" type="text" placeholder="Event Title">
											</div>
											<div class="form-group">
												<label>Event Description</label>
												<textarea class="form-control" placeholder="Please be brief" rows="3" maxlength="40" id="description"></textarea>
												<p class="note">Maxlength is set to 40 characters</p>
											</div>
				
											<div class="form-group">
												<label>Select Event Color</label>
												<div class="btn-group btn-group-justified btn-select-tick" data-toggle="buttons">
													<label class="btn bg-color-darken active">
														<input type="radio" name="priority" id="option1" value="bg-color-darken txt-color-white" checked>
														<i class="fa fa-check txt-color-white"></i> </label>
													<label class="btn bg-color-blue">
														<input type="radio" name="priority" id="option2" value="bg-color-blue txt-color-white">
														<i class="fa fa-check txt-color-white"></i> </label>
													<label class="btn bg-color-orange">
														<input type="radio" name="priority" id="option3" value="bg-color-orange txt-color-white">
														<i class="fa fa-check txt-color-white"></i> </label>
													<label class="btn bg-color-greenLight">
														<input type="radio" name="priority" id="option4" value="bg-color-greenLight txt-color-white">
														<i class="fa fa-check txt-color-white"></i> </label>
													<label class="btn bg-color-blueLight">
														<input type="radio" name="priority" id="option5" value="bg-color-blueLight txt-color-white">
														<i class="fa fa-check txt-color-white"></i> </label>
													<label class="btn bg-color-red">
														<input type="radio" name="priority" id="option6" value="bg-color-red txt-color-white">
														<i class="fa fa-check txt-color-white"></i> </label>
												</div>
											</div>
				
										</fieldset>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-12">
													<button class="btn btn-default" type="button" id="add-event" >
														Add Event
													</button>
												</div>
											</div>
										</div>
									</form>
				
									<!-- end content -->
								</div>
				
							</div>
							<!-- end widget div -->
						</div>
						<!-- end widget -->
				
						<div class="well well-sm" id="event-container">
							<form>
								<fieldset>
									<legend>
										Draggable Events
									</legend>
									<ul id='external-events' class="list-unstyled">
										<li>
											<span class="bg-color-darken txt-color-white" data-description="Currently busy" data-icon="fa-time">Office Meeting</span>
										</li>
										<li>
											<span class="bg-color-blue txt-color-white" data-description="No Description" data-icon="fa-pie">Lunch Break</span>
										</li>
										<li>
											<span class="bg-color-red txt-color-white" data-description="Urgent Tasks" data-icon="fa-alert">URGENT</span>
										</li>
									</ul>
									<div class="checkbox">
										<label>
											<input type="checkbox" id="drop-remove" class="checkbox style-0" checked="checked">
											<span>remove after drop</span> </label>
					
									</div>
								</fieldset>
							</form>
				
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-9">
				
						<!-- new widget -->
						<div class="jarviswidget jarviswidget-color-blueDark">
				
							<header>
								<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
								<h2> My Events </h2>
								<div class="widget-toolbar">
									<!-- add: non-hidden - to disable auto hide -->
									<div class="btn-group">
										<!-- <button  class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
											Showing <i class="fa fa-caret-down"></i>
										</button>
										<ul class="dropdown-menu js-status-update pull-right">
											<li>
												<a href="javascript:void(0);" id="mt">Month</a>
											</li>
											<li>
												<a href="javascript:void(0);" id="ag">Agenda</a>
											</li>
											<li>
												<a href="javascript:void(0);" id="td">Today</a>
											</li>
										</ul> -->
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
				
				</div>
				
				<!-- end row -->

			</div>
			<!-- END MAIN CONTENT -->

	

		

		

		<!--================================================== -->

		

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		

	
	
		

	
</div>




<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" data-backdrop="static" data-keyboard="false" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          	<p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


@endsection


@section('script')

		

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"><\/script>');
			}
		</script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="{{URL::asset('assets/admin/js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>


		<!-- IMPORTANT: APP CONFIG -->
		<script src="{{URL::asset('assets/admin/js/app.config.js')}}"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="{{URL::asset('assets/admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="{{URL::asset('assets/admin/js/bootstrap/bootstrap.min.js')}}"></script>

		<!-- MAIN APP JS FILE -->
		<script src="{{URL::asset('assets/admin/js/app.min.js')}}"></script>
		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="{{URL::asset('assets/admin/js/plugin/moment/moment.min.js')}}"></script>
		<script src="{{URL::asset('assets/admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js')}}"></script>

		

		<script type="text/javascript">
		
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
					/*dayClick: function(day){
						
						alert(day.format());
					},*/
			        select: function (startDate, endDate, allDay) {		
			        	var oneDay = 1000 * 60 * 60 * 24; //Convert into millisec  
			        	

			        	var sta=startDate.format();
			            sta = new Date(startDate);
			            var end=endDate.format();
			            end	= new Date(endDate);
			            end.setDate(end.getDate()-1);	//for showing on UI		           
			            console.log('selected ' + sta + ' to ' + end);
			            end.setDate(end.getDate()+1);//for storing on database
			            var days = Math.ceil((end.getTime() - sta.getTime()) / oneDay);
			            console.log(days);
			            $(".fc-highlight").css("background", "red");


			            
			        },
			
			        events: [{
			        	id: 123,
			            title: 'All Day Event',
			            start: new Date(y, m, 1),			           
			            description: 'long description',
			            className: ["event", "bg-color-greenLight"],
			            icon: 'fa-check'
			       
			        }, {
			        	id: 127,
			            title: 'Meeting',
			            start: new Date(y, m, d),
			            allDay: false,
			             description: 'Meeting Description',
			            className: ["event", "bg-color-darken"]
			        },
			        {
			        	id: 127,
			            title: 'Meeting',
			            start: new Date(y, m, d+1),
			            end: new Date(y,m,d+4),
			            allDay: false,
			             description: 'Meeting IT',
			            className: ["event", "bg-color-darken"]
			        }
			        ],
			
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
				
				$('#mt').click(function () {
				    $('#calendar').fullCalendar('changeView', 'month');

				});
				
				$('#ag').click(function () {
				    $('#calendar').fullCalendar('changeView', 'agendaWeek');
				});
				
				$('#td').click(function () {
				    $('#calendar').fullCalendar('changeView', 'agendaDay');
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
				$('.fc-content').click(function(){					
					var event_id = $(this).find(".event_id").html();
					alert(event_id);
				
				});



				/*var calendar = $('#calendar').fullCalendar('getCalendar');
				calendar.on('dayClick', function(date, jsEvent, view) {
				  console.log('clicked on ' + date.format());
				});
				calendar.on('select', function(startDate, endDate) {
				  console.log('selected ' + startDate.format() + ' to ' + endDate.format());
				});*/


		


				
						
		
		});//end ready

		</script>


@endsection

