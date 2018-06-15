@php
use  App\Model\Backend\Bookings;
use Illuminate\Support\Facades\Input;
@endphp
@extends('layouts.admin.master')

@section('style')
	<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/admin/css/smartadmin-production-plugins.min.css') }}">
	<style type="text/css">
		@font-face {
		    font-family: writehand;
		    src: url("{{ asset('assets/admin/fonts/writehand.ttf') }}");
		}
		@font-face {
		    font-family: preyveng;
		    src: url("{{ asset('assets/admin/fonts/preyveng.ttf') }}");
		}
		.booking_table{
			font-family: 'preyveng';
		}
	</style>

@endsection
@section('content')
<div id="content">
	
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">{{$layout->label->all_events->title}}</a></li>
   
  </ul>

  <div class="tab-content booking_table">
    <div id="home" class="tab-pane fade in active">
    	<form method="get" action="/booking_history">
    	<div class="row" style="margin:10px">	
				    <div class="col-sm-4 col-md-2">
				    	{{Helper::monthDropdown($filter->month)}}
				    </div>
				    <div class="col-sm-4 col-md-2">
				    	{{Helper::yearDropdown($filter->year)}}
				    </div>
				    <div class="col-sm-3 col-md-3">				        
				        <div class="input-group">
				            <input type="text" value="{{$filter->search}}" class="form-control" placeholder="Search by title" name="search" >
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>
				    </div>	
			
    	</div>
    	<div class="row">
      		<table class="table table-responsive table-hover table-collapse table-bordered">
	      		<tr>
	      			<th>Event ID</th>
	      			<th>Title</th>
	      			<th>Description</th>
	      			<th>Start </th>
	      			<th> End</th>
	      			<th>Action</th>
	      		</tr>
	      		@if(count($listings)<=0)
	      			{!! Helper::empty_table(6) !!}
	      		@endif
		      		@foreach($listings as $lb)
		      		
		      		@php
		      			   $enddate = date_create($lb->end); // For today/now, don't pass an arg.
			                $enddate->modify("-1 day");
			               $enddate=$enddate->format("Y-m-d");
		      		@endphp
	      			<tr>
	      				<td>{{$lb->id}}</td>
	      				<td>{{$lb->title}}</td>
	      				<td>{{$lb->description}}</td>
	      				<td>{{$lb->start}}</td>
	      				<td>{{$enddate}}</td>
	      				<td>
	      					<a href="/calendardetail/{{ encrypt($lb->id) }}" target="_blank" class="btn btn-primary btn-xs">
	      						 <i class="fas fa-print"></i> View
	      					</a>
	      				</td>
	      			</tr>
	      		
		      		@endforeach
		    
      		</table>
      	</div>     
      	<div class="row" >      	
      		<div class="col-lg-2">   
      			{{Helper::filterDisplay($display)}}		
      		</div>
      		<div class="col-lg-6"></div>
      		<div class="col-lg-4">
      			{{ $listings->appends(Input::except('page'))->links() }}
      		</div>
      	</div>
      	</form>
      	
    </div>
   
   
  </div>

</div>

@endsection


		





 