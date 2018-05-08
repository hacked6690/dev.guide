@extends('layouts.frontend.master')
@section('style')

	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/css/homepage.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		
	
	</style>
@endsection
@section('content')
	<div id="content" class="mycontent">
		<div class="row mycarousel" style="width:95%;margin:10px auto">
				@include('frontend.home.slide')
		</div>
		<div class="row" style="width:95%;margin:10px auto">
			<div class="col-lg-3 col-md-3">
				@include('frontend.home.leftsidebar')
			</div>
			<div class="col-lg-9 col-md-9">
				@include('frontend.home.content')
			</div>
		</div>
	</div><!-- END MAIN CONTENT -->
	

@endsection
@section('script')

@endsection

