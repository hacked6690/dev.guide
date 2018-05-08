@extends('layouts.frontend.master')
@section('style')

	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/css/homepage.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		.glyphicon { margin-right:5px;}
		.section-box h2 { margin-top:0px;}
		.section-box h2 a { font-size:15px; }
		.glyphicon-heart { color:#e74c3c;}
		.glyphicon-comment { color:#27ae60;}
		.separator { padding-right:5px;padding-left:5px; }
		.section-box hr {margin-top: 0;margin-bottom: 5px;border: 0;border-top: 1px solid rgb(199, 199, 199);}	
		.price{
			color:#0896ff;
		}
		.perday{
			color:#93a1a1;
		}
		.mycontent .guideprofile{
			/*height:140px;
			width: 140px;*/
			width:80%;
			max-height: 130px;
		}
		.table-footer .sky-form{
			border:0px;
		}
		.pagination{
			margin:0px;
		}
	</style>
@endsection
@section('content')
	<div id="content" class="mycontent">
		<div class="row mycarousel" style="width:80%;margin:10px auto">
				@include('frontend.home.slide')
		</div>
		<div class="row" style="width:80%;margin:10px auto">
			<div class="col-lg-3 col-md-3" style="padding-left:0px">
				@include('frontend.home.leftsidebar')
			</div>
			<div class="col-lg-9 col-md-9">
				@include('frontend.guides.inc_listing')
			</div>
		</div>
	</div><!-- END MAIN CONTENT -->
	

@endsection
@section('script')

@endsection

