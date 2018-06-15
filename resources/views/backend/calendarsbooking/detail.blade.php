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
		.booking_table,.invoice-table{
			font-family: 'preyveng';
		}
		.invoice-header img{
			width:100px;
		}
		.invoice-footer tr td{
			font-size:14px;
		}
		.invoice-footer tr td:first-child{
			text-align: right;	
			width:30%;	
		}
		.invoice-footer tr td:nth-child(2){
			font-weight: bold;
			font-size: 12px;
		}
	</style>

@endsection
@section('content')
<div id="content">
	
	<!--=== Content Part ===-->
		<div class="container content" style="border:2px groove gray;margin-top:40px;padding-bottom:200px">
			<!--Invoice Header-->
			<div class="row invoice-header">
				<div class=" col-lg-12  col-xs-12">
					<img src="https://cdn.iconscout.com/public/images/icon/premium/png-256/booking-app-date-early-travel-hotel-33faf45441f69779-256x256.png" alt="kkk">
					<br>
					STATUS:
					<span style="font-weight:bold;text-transform:uppercase">#{{Bookings::statusName($booking->booking_status)}}</span>
					<hr/>
				</div>
			</div>
			<!--End Invoice Header-->
					@php
		      			   $enddate = date_create($booking->end); // For today/now, don't pass an arg.
			                $enddate->modify("-1 day");
			               $enddate=$enddate->format("Y-m-d");
		      		@endphp
			<!--Invoice Detials-->
			<div class="row invoice-info">
				<div class="col-xs-6">
					<div class="tag-box tag-box-v3">
						<h2>{{$layout->label->booking_information->title}}:</h2>
						<ul class="list-unstyled">
							<li><strong>{{$layout->label->booking_id->title}}:</strong> #{{$booking->id}}</li>
							<li><strong>{{$layout->label->booking_start->title}}:</strong> {{$booking->start}}</li>
							<li><strong>{{$layout->label->booking_end->title}}:</strong> {{$enddate}}</li>
							
						</ul>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="tag-box tag-box-v3">
					
						<h2>{{ $layout->label->guide_information->title }}</h2>
						<ul class="list-unstyled">
							<li><strong>{{ $layout->label->guide_id->title }}:</strong> #{{$user->id}}</li>
							<li><strong>{{ $layout->label->fullname_en->title }}:</strong> {{$guide_meta->fullname_en->value}}</li>
							<li><strong>{{ $layout->label->telephone->title }}:</strong> {{$guide_meta->telephone->value}}</li>
							<li><strong>{{ $layout->label->email->title }}:</strong> {{$user->email}}</li>
						</ul>
					</div>
				</div>
			</div>
			<!--End Invoice Detials-->

			<!--Invoice Table-->
			<div class="panel panel-default margin-bottom-40">
				
				<table class="table table-striped invoice-table">
					<thead>
						<tr>
							<th>Booking ID</th>
			      			<th>Title</th>
			      			<th>Description</th>
			      			<th>Start </th>
			      			<th> End</th>
						</tr>
					</thead>
					<tbody>					
		      			<tr>
		      				<td>{{$booking->id}}</td>
		      				<td>{{$booking->title}}</td>
		      				<td>{{$booking->description}}</td>
		      				<td>{{$booking->start}}</td>
		      				<td>{{$enddate}}</td>
		      				
		      			</tr>
					</tbody>
				</table>
			</div>
			<!--End Invoice Table-->
			<div class="row invoice-footer">
				<div class="col-lg-7"></div>
				<div class="col-lg-5">
						<h4 class="text text-info">{{$layout->label->creator_id->title}}
						<table class="table table-responsive table-hover">
							<tr>
								<td>{{$layout->label->fullname_en->title}}:</td>
								<td>{{$inputer_meta->fullname_en->value}}</td>
							</tr>
							<tr>
								<td>{{$layout->label->telephone->title}}:</td>
								<td>{{$inputer_meta->telephone->value}}</td>
							</tr>
							<tr>
								<td>{{$layout->label->email->title}}:</td>
								<td>{{$user->email}}</td>
							</tr>
							<tr>
								<td>{{$layout->label->activity_date->title}}:</td>
								<td>{{substr($booking->created_at,0,11)}}</td>
							</tr>
						</table>
				</div>
			</div>

			
		</div><!--/container-->
		<!--=== End Content Part ===-->

</div>

@endsection


		





 