@extends('layouts.frontend.master')
@section('style')

	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/css/homepage.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		.glyphicon {  margin-bottom: 10px;margin-right: 10px;}
		small {
		display: block;
		line-height: 1.428571429;
		color: #999;
		}
		.detail img{
			width: 100%;
			height: 220px;
		}
		.first_td{
			border-bottom: 1px solid green;
			width:50%;
		}
	</style>
@endsection
@section('content')
	<div id="content" class="mycontent">
		<div class="row mycarousel" style="width:80%;margin:10px auto">
				@include('frontend.home.slide')
		</div>
		<div class="row" style="width:80%;margin:10px auto">
			<div class="col-lg-0 col-md-0" style="padding-left:0px">
				<?php //@include('frontend.home.leftsidebar') ?>
			</div>
			<div class="col-lg-10 col-md-10 detail col-lg-offset-1">
				@include('frontend.guides.inc_detail')
			</div>
		</div>
	</div><!-- END MAIN CONTENT -->
	

@endsection
@section('script')

@endsection

