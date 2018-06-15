<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<style type="text/css">
		
		</style>
		<title>{{ $layout->system->system_title->title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"><\/script>');
			}
		</script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

		
		<?php
		/*if (Request::is('calendarsbooking'))
		{
		   
		}else{
			$str='
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
				';
			echo $str;
		}*/

		?>
		<!-- #CSS Links -->
		@include('layouts.admin.partials.required_style')

		@if(Session::has('locale') AND Session::get('locale') =='kh')
			@include('layouts.admin.partials.kh_style')
		@endif

		@include('layouts.admin.partials.script_label')

	</head>

	<body class="smart-style-0">
		
		<!-- #HEADER -->
		@include('layouts.admin.partials.header')

		<!-- #NAVIGATION -->
		@include('layouts.admin.partials.aside')

		<!-- #MAIN PANEL -->
		<div id="main" role="main">

			<!-- #MAIN CONTENT -->

				<!-- col -->
				@yield("content")

			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		<!-- #PLUGINS -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<?php //@include('layouts.admin.partials.jquery') ?>

		<!-- laoded basic script -->
		@include('layouts.admin.partials.required_script')

	</body>

</html>

