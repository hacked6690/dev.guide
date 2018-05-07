@extends('layouts.frontend.master')
@section('style')

	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		/* Carousel Styles */
			.carousel-indicators .active {
			    background-color: #2980b9;
			}

			.carousel-inner img {
			    width: 100%;
			    max-height: 460px
			}

			.carousel-control {
			    width: 0;
			}

			.carousel-control.left,
			.carousel-control.right {
				opacity: 1;
				filter: alpha(opacity=100);
				background-image: none;
				background-repeat: no-repeat;
				text-shadow: none;
			}
			.carousel-control.left{
				margin-left: 20px;
			}
			.carousel-control.right{
				margin-right: 20px;
			}

			.carousel-control.left span {
				padding: 0px;
			}

			.carousel-control.right span {
				padding: 0px;
			}

			.carousel-control .glyphicon-chevron-left, 
			.carousel-control .glyphicon-chevron-right, 
			.carousel-control .icon-prev, 
			.carousel-control .icon-next {
				position: absolute;
				top: 45%;
				z-index: 5;
				display: inline-block;
			}

			.carousel-control .glyphicon-chevron-left,
			.carousel-control .icon-prev {
				left: 0;
			}

			.carousel-control .glyphicon-chevron-right,
			.carousel-control .icon-next {
				right: 0;
			}

			.carousel-control.left span,
			.carousel-control.right span {
				background-color: #000;
			}

			.carousel-control.left span:hover,
			.carousel-control.right span:hover {
				opacity: .7;
				filter: alpha(opacity=70);
			}

			/* Carousel Header Styles */
			.header-text {
			    position: absolute;
			    top: 20%;
			    left: 1.8%;
			    right: auto;
			    width: 96.66666666666666%;
			    color: #fff;
			}

			.header-text h2 {
			    font-size: 40px;
			}

			.header-text h2 span {
			    background-color: #2980b9;
				padding: 10px;
			}

			.header-text h3 span {
				background-color: #000;
				padding: 15px;
			}

			.btn-min-block {
			    min-width: 170px;
			    line-height: 26px;
			}

			.btn-theme {
			    color: #fff;
			    background-color: transparent;
			    border: 2px solid #fff;
			    margin-right: 15px;
			}

			.btn-theme:hover {
			    color: #000;
			    background-color: #fff;
			    border-color: #fff;
			}
			.container {
			    margin-top: 10px;
			}
			.news-v1-in img{
				width:100%;
				max-height: 250px;
				min-height: 250px;
			}
			.media-left img{
				width:45px;
				margin-left:10px;
				/*border-radius:50%;*/
			}
			.media-right img{
				width:10px;
			}
			.headline-v2{
				padding:1px;
			}
			.li_parent{
				font-size: 16px;
				font-weight: bold;
				text-transform: uppercase;
				background-color: #1aa3ff;
				color:white;
			}
			.li_parent img{
				width:20px;
			}
			.mycontent .list-group{
				margin-bottom: 10px;
			}
			.sky-form fieldset{
				font-size: 12px;
				padding: 0 5px;
			}
			.mycontent .sky-form .label{
				font-size: 15px;
			}
			.button_search{
				font-size:22px;
			}
	
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

