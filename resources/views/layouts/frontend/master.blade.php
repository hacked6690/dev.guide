<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title>{{ $layout->system->system_title->title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		@include('layouts.frontend.partials.required_style')
		
	</head>

	<body class="smart-style-0">
		@include('layouts.frontend.partials.header')
	

		<!-- #MAIN PANEL -->
		<div id="main" role="main">

			<!-- #MAIN CONTENT -->

				<!-- col -->
				@yield("content")

			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		
		<!-- loaded switcher style-->
		@include('layouts.frontend.partials.style_switcher')
		<!-- loaded footer page-->
		@include('layouts.frontend.partials.footer')
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		@include('layouts.frontend.partials.jquery')
		<!-- laoded basic script -->
		@include('layouts.frontend.partials.required_script')
	</body>

</html>