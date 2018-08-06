<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title>{{ $layout->system->system_title->title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"><\/script>');
			}
		</script>


		<!-- #CSS Links -->
		@include('layouts.frontend.partials.required_style')
		
	</head>

	<body class="smart-style-0">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=1724749201072528&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



		@include('layouts.frontend.partials.header')
	

		<!-- #MAIN PANEL -->
		<div id="main" role="main" style="min-height:700px" >

			<!-- #MAIN CONTENT -->

				<!-- col -->
				@yield("content")

			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		<div class="myfooter">
		<!-- loaded switcher style-->
		<?php //@include('layouts.frontend.partials.style_switcher') ?>
		<!-- loaded footer page-->
		@include('layouts.frontend.partials.footer')

		</div>
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<?php //@include('layouts.frontend.partials.jquery') ?>
		<!-- laoded basic script -->
		@include('layouts.frontend.partials.required_script')
	</body>

</html>