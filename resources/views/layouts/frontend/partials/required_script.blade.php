<!-- JS Global Compulsory -->
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/jquery/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/jquery/jquery-migrate.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/back-to-top.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/smoothScroll.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/parallax-slider/js/modernizr.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/parallax-slider/js/jquery.cslider.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/plugins/owl-carousel/owl-carousel/owl.carousel.js')}}"></script>
	<!-- yield optional script on page[s] -->
	@yield('script')

	<!-- MAIN APP JS FILE -->
	<script src="{{ asset('assets/admin/js/app.seed.js') }}"></script>


	<!-- JS Customization -->
	<!--<script type="text/javascript" src="{{asset('assets/frontend/js/custom.js?t='. time()) }}"></script>-->

	<!-- custom Js -->
<script src="{{ asset('assets/admin/js/custom.js?t='. time()) }}"></script>


	<!-- JS Page Level -->
	<script type="text/javascript" src="{{asset('assets/frontend/js/app.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/js/plugins/owl-carousel.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/js/plugins/style-switcher.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/js/plugins/parallax-slider.js')}}"></script>

	<script type="text/javascript" src="{{asset('assets/frontend/plugins/smoothScroll.js')}}"></script>
	<script src="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js')}}"></script>
	<script src="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/js/plugins/datepicker.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/frontend/js/plugins/masking.js')}}"></script>
	

	<script type="text/javascript">
		/*jQuery(document).ready(function() {
			App.init();
			Masking.initMasking();
			Datepicker.initDatepicker();
			OwlCarousel.initOwlCarousel();
			StyleSwitcher.initStyleSwitcher();
			ParallaxSlider.initParallaxSlider();
		});*/
	</script>

	