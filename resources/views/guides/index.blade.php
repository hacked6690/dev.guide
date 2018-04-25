@extends('layouts.frontend.master')
@section('style')
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
@endsection
@section('content')
	<div id="content">
	<div class="wrapper">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">					
					
				</h1>
			</div>
		</div>

		<div class="row" style="width:80%;margin:0 auto">
			<form action="#" id="sky-form4" class="sky-form">
				<div class="col-lg-4 col-md-4">
								<header>
									Guide Online Registration{{ $layout->menu->create_privilege->title }}
								</header>

								<fieldset>

									<div class="row">
										<section class="col col-6">
											<label class="input">
												<input type="text" name="firstname" placeholder="First name ">
											</label>
										</section>
										<section class="col col-6">
											<label class="input">
												<input type="text" name="lastname" placeholder="Last name">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="input">
												<input type="text" name="firstname" placeholder="First name ">
											</label>
										</section>
										<section class="col col-6">
											<label class="input">
												<input type="text" name="lastname" placeholder="Last name">
											</label>
										</section>
									</div>
									<section>
										<label class="input">
											<i class="icon-append fa fa-envelope"></i>
											<input type="email" name="email" placeholder="Email address">
											<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
										</label>
									</section>
									<section>
										<label class="label">Address</label>
										<label class="textarea">
											<i class="icon-append fa fa-comment"></i>
											<textarea rows="4" name="message" id="message"></textarea>
										</label>
									</section>


									<div class="row">
											<section class="col col-6">
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="start" id="start" placeholder="Date Of Birth">
												</label>
											</section>	
											<section class="col col-6">
											<label class="select">
												<select name="gender">
													<option value="0" selected disabled>Gender</option>
													<option value="1">Male</option>
													<option value="2">Female</option>
													<option value="3">Other</option>
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">											
											<section class="col col-lg-12">
											<label class="select">
												<select name="gender">
													<option value="0" selected disabled>Nationality</option>
													<option value="1">Cambodia</option>
													<option value="2">Vietnames</option>
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">											
											<section class="col col-lg-12">
											<label class="select">
												<select name="gender">
													<option value="0" selected disabled>Province</option>
													<option value="1">Cambodia</option>
													<option value="2">Vietnames</option>
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password" name="password" placeholder="Password" id="password">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>
										<section class="col col-6" >
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password" name="passwordConfirm" placeholder="Confirm password">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>										
									</div>
									
								</fieldset>								
								
					</div>
					<div class="col-lg-8 col-md-8" style="border-left:1px dashed green">
						<header>
							Guide Information Detail:
						</header>
						<fieldset>
							<div class="row">		
								<section class="col col-lg-4 col-md-4">
											<label class="input">
												<input type="text" name="lastname" placeholder="Generation th">
											</label>
								</section>

								<section class="col col-lg-4 col-md-4">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>Guide Certified</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>	
								<section class="col col-lg-4 col-md-4">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>Behavior Certified</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>										
							</div>
							<div class="row">		
								<section class="col col-lg-3 col-md-3">
											<label class="input">
												<input type="text" name="lastname" placeholder="ID Number">
											</label>
								</section>

								<section class="col col-lg-5 col-md-5">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>Partner Type</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>	
								<section class="col col-lg-4 col-md-4">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>CV Provided</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>										
							</div>
							<div class="row">		
								<section class="col col-lg-12 col-md-12">
											<label class="input">
												<input type="text" name="lastname" placeholder="Telephone Number">
											</label>
								</section>					
							</div>
							<div class="row">		
								<section class="col col-lg-6 col-md-6">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>Domicile Certified</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>	
								<section class="col col-lg-6 col-md-6">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>Renewal Type</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>										
							</div>
							<div class="row">		
								<section class="col col-lg-12 col-md-12">
									<label class="select">
										<select name="gender">
											<option value="0" selected disabled>Guide Type</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>																
							</div>
							<div class="row">
											<section class="col col-4">
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="issueddate" id="date" class="hasDatepicker" placeholder="Issued Date">
												</label>
											</section>	
											<section class="col col-4">
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="finish" id="finish" placeholder="Expired Date">
												</label>
											</section>	
											<section class="col col-4">
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="dateservice" id="date" class="hasDatepicker" placeholder="Service Date">
												</label>
											</section>								
							</div>
							<div class="row about_province">	
						       <!--  <section class="col col-lg-3 col-md-3">
									<label class="select">
										<select name="location[]" class="location_province form-control" id="location_province">
											<option value="0" selected disabled>Province</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>  
								<section class="col col-lg-3 col-md-3">
									<label class="select">
										<select name="province_location" class="province_location form-control" id="province_location">
											<option value="0" selected disabled>Location</option>
											<option value="1">Cambodia</option>
											<option value="2">Vietnames</option>
										</select>
											<i></i>
									</label>
								</section>
								<section class="col col-lg-2 col-md-2">
											<label class="input">
												<input type="text" class="price" id="price" name="price0" placeholder="Price/USD">
											</label>
								</section>	
								<section>
									<button type="button"  id="add_location"  class="more_location btn btn-primary">
										<i class=" fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add more location
									</button>
								</section> -->
							
							</div>
							
							<div class="row">
										<section class="col col-lg-12">
											<label class="checkbox"><input type="checkbox" name="terms" id="terms"><i></i>I agree with the Terms and Conditions</label>
										</section>
										<footer>
											<button type="submit" class="btn-u">Submit</button>
										</footer>
							</div>


						</fieldset>
					</div>
					</form><!--end form-->
							<!-- End Reg-Form -->
		</div>
			
	</div><!--end wrapper class-->
	</div>
	<!-- END MAIN CONTENT -->

@endsection
@section('script')

 <script>
            var c = 0;
            $('.more_location').on('click', function() {            	
                c++;
                  $(".more_location").before($(".more_location").prev().clone());
                $('#price').attr('name', 'price' + c)

                
            });
        </script>
@endsection

