@extends('layouts.frontend.master')
@section('style')
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
	
	
	</style>
@endsection
@section('content')
	<div id="content">
	<div class="wrapper">
		<div class="container" style="width:90%">
			<form action="{{ route('guides.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="post" >
				<div class="col-lg-5 col-md-5">
								<header>
									{{ $layout->label->guide_registration->title }}
								</header>

								<fieldset>
									<div class="row">
												<section class="col col-10 flexibled-error">
													<label class="label">
														Title <code>*</code>

														@if($errors->has('title'))
															<div class="error-badge" id="for-title">
																{!! Helper::alert('danger', $errors->first('title')) !!}
															</div>
														@endif
													</label>
													<label class="input">
														<input type="text" name="title" value="{{ old('title') }}" class="input-sm border-0 border-bottom-1 font-bold font-18">
													</label>
												</section>
											</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->first_name_latin->title }} <code>*</code>
														@if($errors->has('first_name'))
															<div class="error-badge" id="for-first_name">
																{!! Helper::alert('danger', $errors->first('first_name')) !!}
															</div>
														@endif
											</label>
											<label class="input">
												<input type="text" value="{{ old('first_name') }}" name="first_name" placeholder="">
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->last_name_latin->title }} <code>*</code>
														@if($errors->has('last_name'))
															<div class="error-badge" id="for-last_name">
																{!! Helper::alert('danger', $errors->first('last_name')) !!}
															</div>
														@endif
											</label>										
											<label class="input">
												<input type="text" value="{{ old('last_name') }}" name="last_name" placeholder="">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->first_name_khmer->title }}<code>*</code>
														@if($errors->has('first_name_kh'))
															<div class="error-badge" id="for-first_name_kh">
																{!! Helper::alert('danger', $errors->first('first_name_kh')) !!}
															</div>
														@endif
											</label>
											<label class="input">
												<input type="text" value="{{ old('first_name_kh') }}" name="first_name_kh" placeholder="">
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->last_name_khmer->title }}<code>*</code>
														@if($errors->has('last_name_kh'))
															<div class="error-badge" id="for-last_name_kh">															
																{!! Helper::alert('danger', $errors->first('last_name_kh')) !!}
															</div>
														@endif
											</label>
											<label class="input">
												<input type="text" value="{{ old('last_name_kh') }}" name="last_name_kh" placeholder="">
											</label>
										</section>
									</div>
									<section class="flexibled-error">
										<label class="label">
														{{ $layout->label->email->title }}<code>*</code>
														@if($errors->has('email'))
															<div class="error-badge" id="for-email">															
																{!! Helper::alert('danger', $errors->first('email')) !!}
															</div>
														@endif
										</label>
										<label class="input">
											<i class="icon-append fa fa-envelope"></i>
											<input type="email" value="{{ old('email') }}" name="email" placeholder="">
											<b class="tooltip tooltip-bottom-right">Pls Fill your email account</b>
										</label>
									</section>
									<section class="flexibled-error">
										<label class="label">
														{{ $layout->label->address->title }}<code>*</code>
														@if($errors->has('address'))
															<div class="error-badge" id="for-address">															
																{!! Helper::alert('danger', $errors->first('address')) !!}
															</div>
														@endif
										</label>
										<label class="textarea">
											<i class="icon-append fa fa-comment"></i>
											<textarea value="{{ old('address') }}" rows="4" name="address" id="address"></textarea>
										</label>
									</section>


									<div class="row">
											<section class="col col-6 flexibled-error">
												<label class="label">
														{{ $layout->label->date_of_birth->title }}<code>*</code>
														@if($errors->has('date_of_birth'))
															<div class="error-badge" id="for-date_of_birth">															
																{!! Helper::alert('danger', $errors->first('date_of_birth')) !!}
															</div>
														@endif
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="{{ old('date_of_birth') }}" name="date_of_birth" id="date_of_birth" placeholder="">
												</label>
											</section>	
											<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->gender->title }}<code>*</code>
														@if($errors->has('gender'))
															<div class="error-badge" id="for-gender">															
																{!! Helper::alert('danger', $errors->first('gender')) !!}
															</div>
														@endif
											</label>
											<label class="select">
												<select name="gender" >
													<option value="{{ old('gender') }}" value="0" selected disabled>Select Gender</option>
													<option value="1">Male</option>
													<option value="2">Female</option>
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">		
										<section class="col col-lg-12 col-md-12 flexibled-error">
													<label class="label">
																{{ $layout->label->telephone->title }}<code>*</code>
																@if($errors->has('telephone'))
																	<div class="error-badge" id="for-telephone">															
																		{!! Helper::alert('danger', $errors->first('telephone')) !!}
																	</div>
																@endif
													</label>
													<label class="input">
														<input type="text" value="{{ old('telephone') }}" name="telephone" placeholder="">
													</label>
										</section>					
									</div>
									<div class="row">											
											<section class="col col-lg-12 flexibled-error">
											<label class="label">
																{{ $layout->label->nationality->title }}<code>*</code>
																@if($errors->has('nationality'))
																	<div class="error-badge" id="for-nationality">															
																		{!! Helper::alert('danger', $errors->first('nationality')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('nationality') }}" name="nationality" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($nationalities as $nationality)
														@if(old('nationality') ==$nationality->term_id)
																	<option value="{{$nationality->term_id}}" selected >{{$nationality->title}}</option>
														@else
																	<option value="{{$nationality->term_id}}">{{$nationality->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">											
											<section class="col col-lg-12 flexibled-error">
											<label class="label">
																{{ $layout->label->province->title }}<code>*</code>
																@if($errors->has('province'))
																	<div class="error-badge" id="for-province">															
																		{!! Helper::alert('danger', $errors->first('province')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('province') }}" name="province" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($provinces as $province)
														@if(old('province') ==$province->term_id)
																	<option value="{{$province->term_id}}" selected >{{$province->title}}</option>
														@else
																	<option value="{{$province->term_id}}">{{$province->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
																{{ $layout->label->password->title }}<code>*</code>
																@if($errors->has('province'))
																	<div class="error-badge" id="for-password">															
																		{!! Helper::alert('danger', $errors->first('password')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password" name="password" placeholder="Password" id="password">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
																{{ $layout->label->confirm_password->title }}<code>*</code>
																@if($errors->has('confirm_password'))
																	<div class="error-badge" id="for-confirm_password">															
																		{!! Helper::alert('danger', $errors->first('confirm_password')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password" name="confirm_password" placeholder="Password" id="confirm_password">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>									
									</div>
									
								</fieldset>								
								
					</div>
					<div class="col-lg-7 col-md-7" style="border-left:1px dashed green">
						
						<fieldset>
							<div class="row">		
								<section class="col col-lg-4 col-md-4 flexibled-error">
											<label class="label">
																{{ $layout->label->generation->title }}<code>*</code>
																@if($errors->has('generation'))
																	<div class="error-badge" id="for-generation">															
																		{!! Helper::alert('danger', $errors->first('generation')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<input type="text" value="{{ old('generation') }}" name="generation" placeholder="">
											</label>
								</section>

								<section class="col col-lg-4 col-md-4 flexibled-error">
									<label class="label">
																{{ $layout->label->guide_certified->title }}<code>*</code>
																@if($errors->has('guide_certified'))
																	<div class="error-badge" id="for-guide_certified">															
																		{!! Helper::alert('danger', $errors->first('guide_certified')) !!}
																	</div>
																@endif
									</label>
									<label class="select">
										<select name="guide_certified">
										
											@if(old('guide_certified') == 'yes')
												<option value="yes" selected>Yes</option>
												<option value="no">No</option>
											@elseif(old('guide_certified') == 'no')
												<option value="yes" >Yes</option>
												<option value="no" selected>No</option>
											@else
												<option value="" selected disabled>Select Below</option>
												<option value="yes">Yes</option>
												<option value="no">No</option>
											@endif
											
											
										</select>
											<i></i>
									</label>
								</section>	
								<section class="col col-lg-4 col-md-4 flexibled-error">
									<label class="label">
																{{ $layout->label->behavior_certified->title }}<code>*</code>
																@if($errors->has('behavior_certified'))
																	<div class="error-badge" id="for-behavior_certified">															
																		{!! Helper::alert('danger', $errors->first('behavior_certified')) !!}
																	</div>
																@endif
									</label>
									<label class="select">
										<select name="behavior_certified">
										
											@if(old('behavior_certified') == 'yes')
												<option value="yes" selected>Yes</option>
												<option value="no">No</option>
											@elseif(old('behavior_certified') == 'no')
												<option value="yes" >Yes</option>
												<option value="no" selected>No</option>
											@else
												<option value="" selected disabled>Select Below</option>
												<option value="yes">Yes</option>
												<option value="no">No</option>
											@endif
											
											
										</select>
											<i></i>
									</label>
								</section>									
							</div>
							<div class="row">		
								<section class="col col-lg-3 col-md-3 flexibled-error">
											<label class="label">
																{{ $layout->label->id_number->title }}<code>*</code>
																@if($errors->has('id_number'))
																	<div class="error-badge" id="for-id_number">															
																		{!! Helper::alert('danger', $errors->first('id_number')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<input type="text" value="{{ old('id_number') }}" name="lastname" placeholder="ID Number">
											</label>
								</section>

								<section class="col col-lg-5 col-md-5 flexibled-error">

									<label class="label">
																{{ $layout->label->partner_type->title }}<code>*</code>
																@if($errors->has('partner_type'))
																	<div class="error-badge" id="for-partner_type">															
																		{!! Helper::alert('danger', $errors->first('partner_type')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('province') }}" name="province" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($partner_types as $partner_type)
														@if(old('partner_type') ==$partner_type->term_id)
																	<option value="{{$partner_type->term_id}}" selected >{{$partner_type->title}}</option>
														@else
																	<option value="{{$partner_type->term_id}}">{{$partner_type->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
								</section>	
								<section class="col col-lg-4 col-md-4 flexibled-error">

									<label class="label">
																{{ $layout->label->cv_provided->title }}<code>*</code>
																@if($errors->has('cv_provided'))
																	<div class="error-badge" id="for-cv_provided">															
																		{!! Helper::alert('danger', $errors->first('cv_provided')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('cv_provided') }}" name="cv_provided" >
													
													@if(old('cv_provided') == 'yes')
														<option value="yes" selected>Yes</option>
														<option value="no">No</option>
													@elseif(old('cv_provided') == 'no')
														<option value="yes" >Yes</option>
														<option value="no" selected>No</option>
													@else
														<option value="" selected disabled>Select Below</option>
														<option value="yes">Yes</option>
														<option value="no">No</option>
													@endif
												</select>
												<i></i>
											</label>
								</section>									
							</div>
							
							<div class="row">		
								<section class="col col-lg-6 col-md-6 flexibled-error">

											<label class="label">
																{{ $layout->label->domicile_certified->title }}<code>*</code>
																@if($errors->has('domicile_certified'))
																	<div class="error-badge" id="for-domicile_certified">															
																		{!! Helper::alert('danger', $errors->first('domicile_certified')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('domicile_certified') }}" name="domicile_certified" >
													
													@if(old('domicile_certified') == 'yes')
														<option value="yes" selected>Yes</option>
														<option value="no">No</option>
													@elseif(old('domicile_certified') == 'no')
														<option value="yes" >Yes</option>
														<option value="no" selected>No</option>
													@else
														<option value="" selected disabled>Select Below</option>
														<option value="yes">Yes</option>
														<option value="no">No</option>
													@endif
												</select>
												<i></i>
											</label>
								</section>					
								<section class="col col-lg-6 col-md-6 flexibled-error">

											<label class="label">
																Re{{ $layout->label->renewal_type->title }}<code>*</code>
																@if($errors->has('renewal_type'))
																	<div class="error-badge" id="for-renewal_type">															
																		{!! Helper::alert('danger', $errors->first('renewal_type')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('renewal_type') }}" name="renewal_type" >
													
													@if(old('renewal_type') == 'new')
														<option value="new" selected>New</option>
														<option value="renewal">Renewal</option>
													@elseif(old('renewal_type') == 'renewal')
														<option value="new" >New</option>
														<option value="renewal" selected>Renewal</option>
													@else
														<option value="" selected disabled>Select Below</option>
														<option value="new">New</option>
														<option value="renewal">Renewal</option>
													@endif
												</select>
												<i></i>
											</label>
								</section>										
							</div>
							<div class="row">		
								<section class="col col-lg-8 col-md-8 flexibled-error">

									<label class="label">
																{{ $layout->label->guide_type->title }}<code>*</code>
																@if($errors->has('guide_type'))
																	<div class="error-badge" id="for-guide_type">															
																		{!! Helper::alert('danger', $errors->first('guide_type')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('guide_type') }}" name="guide_type" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($guide_types as $guide_type)
														@if(old('guide_type') ==$guide_type->term_id)
																	<option value="{{$guide_type->term_id}}" selected >{{$guide_type->title}}</option>
														@else
																	<option value="{{$guide_type->term_id}}">{{$guide_type->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
								</section>																
							</div>
							<div class="row">
											<section class="col col-4 flexibled-error">
												<label class="label">
																{{ $layout->label->issued_date->title }}<code>*</code>
																@if($errors->has('issued_date'))
																	<div class="error-badge" id="for-issued_date">															
																		{!! Helper::alert('danger', $errors->first('issued_date')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="issued_date" id="issued_date"  placeholder="Issued Date">
												</label>
											</section>	
											<section class="col col-4 flexibled-error">
												<label class="label">
																{{ $layout->label->expired_date->title }}<code>*</code>
																@if($errors->has('expired_date'))
																	<div class="error-badge" id="for-expired_date">															
																		{!! Helper::alert('danger', $errors->first('expired_date')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="expired_date" id="expired_date" placeholder="Expired Date">
												</label>
											</section>	
											<section class="col col-4 flexibled-error">
												<label class="label">
																{{ $layout->label->service_date->title }}<code>*</code>
																@if($errors->has('service_date'))
																	<div class="error-badge" id="for-service_date">															
																		{!! Helper::alert('danger', $errors->first('service_date')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" name="service_date" id="service_date"  placeholder="Service Date">
												</label>
											</section>								
							</div>
							<div class="block_language">
								<div class="row language_item">	
									<div class="col-lg-12 col-md-12">
										<div  style="border-top:1px dashed green;height:10px"></div>
									</div>
							        <section class="col col-lg-5 col-md-5 flexibled-error">
											<label class="label">
											
																{{ $layout->label->language->title }}<code>*</code>
																@if($errors->has('guide_language1'))
																	<div class="error-badge" id="for-guide_language">															
																		{!! Helper::alert('danger', $errors->first('guide_language1')) !!}
																	</div>
																@endif
											
											</label>
											<label class="select">
												<select value="{{ old('guide_language1') }}" id="guide_language1" class="guide_language" name="guide_language1" >
													<option value="" selected disabled>Select Below</option>
													@foreach($guide_languages as $guide_language)
														@if(old('guide_language') ==$guide_language->term_id)
																	<option value="{{$guide_language->term_id}}" selected >{{$guide_language->title}}</option>
														@else
																	<option value="{{$guide_language->term_id}}">{{$guide_language->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
									</section>				 
									<section class="col col-lg-4 col-md-4 flexibled-error">
											<label class="label">
																{{ $layout->label->proficiency->title }}<code>*</code>
																@if($errors->has('proficiency'))
																	<div class="error-badge" id="for-proficiency">															
																		{!! Helper::alert('danger', $errors->first('proficiency')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('proficiency') }}" name="proficiency" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($proficiencies as $proficiency)
														@if(old('proficiency') ==$proficiency->term_id)
																	<option value="{{$proficiency->term_id}}" selected >{{$proficiency->title}}</option>
														@else
																	<option value="{{$proficiency->term_id}}">{{$proficiency->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
									</section>
									<section class="col col-lg-3 col-md-3 flexibled-error">
												<label class="label">
																{{ $layout->label->price_usd->title }}<code>*</code>
																@if($errors->has('guide_price'))
																	<div class="error-badge" id="for-guide_price">															
																		{!! Helper::alert('danger', $errors->first('guide_price')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<input type="text" value="{{old('price_description')}}" class="guide_price" id="guide_price" name="guide_price" placeholder="">
												</label>
									</section>									
									<section class="col col-lg-12 col-md-12 margin_bottom">
												<label class="label">
																{{ $layout->label->description->title }}:<code>*</code>
																@if($errors->has('guide_price'))
																	<div class="error-badge" id="for-price_description">															
																		{!! Helper::alert('danger', $errors->first('price_description')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<input type="text" value="{{old('price_description')}}" class="price" id="price_description" name="price_description[]" placeholder="">
												</label>
									</section>							
								</div>
								<div class="row">
									<section class="col">
										<button type="button"  id="add_language"  class="add_language btn btn-primary">
											<i class=" fa fa-plus-circle" aria-hidden="true"></i>&nbsp;{{ $layout->label->add_language->title }}
									</section>
								</div>
								
							</div><!--end block language-->
							<hr/>
							<div class="block_location">
								<div class="row location_item">	
									<div class="col-lg-12 col-md-12">
										<div  style="border-top:1px dashed green;height:10px"></div>
									</div>
							       <section class="col col-lg-5 col-md-5 flexibled-error">
											<label class="label">
																{{ $layout->label->province->title }}<code>*</code>
																@if($errors->has('province'))
																	<div class="error-badge" id="for-province">															
																		{!! Helper::alert('danger', $errors->first('province')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('province') }}" name="province" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($provinces as $province)
														@if(old('province') ==$province->term_id)
																	<option value="{{$province->term_id}}" selected >{{$province->title}}</option>
														@else
																	<option value="{{$province->term_id}}">{{$province->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
									</section>
									<section class="col col-lg-4 col-md-4 flexibled-error">
										<label class="label">
																{{ $layout->label->location->title }}<code>*</code>
																@if($errors->has('location'))
																	<div class="error-badge" id="for-location">															
																		{!! Helper::alert('danger', $errors->first('location')) !!}
																	</div>
																@endif
										</label>
										<label class="select">
											<select name="location" class="location form-control" id="location">
												
											</select>
												<i></i>
										</label>
									</section>
									<section class="col col-lg-3 col-md-3">
												<label class="label">
																{{ $layout->label->price_usd->title }}<code>*</code>
																@if($errors->has('location_price'))
																	<div class="error-badge" id="for-location_price">															
																		{!! Helper::alert('danger', $errors->first('location_price')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<input type="text" value="{{ old('location_price')}}" class="price" id="location_price" name="location_price" placeholder="">
												</label>
									</section>									
														
								</div>
								<div class="row">
									<section class="col">
										<button type="button"  id="add_location"  class="add_location btn btn-primary">
											<i class=" fa fa-plus-circle" aria-hidden="true"></i>&nbsp;{{ $layout->label->add_location->title }}
										</button>
									</section>
								</div>
							</div><!--end block province-->
							
							
							<div class="row">
										<section class="col col-lg-12">
											<label class="checkbox"><input type="checkbox" name="terms" id="terms"><i></i>{{ $layout->label->i_agree_term->title }}</label>
										</section>
										<footer>
											{{ csrf_field() }}
											<button type="submit"  class="btn-u">Submit</button>
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
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
            var c = 1;
            $('.add_language').on('click', function() {            	
               /* var last_ele=$(".language_item:last");
                c++;
                  var new_ele=last_ele.clone(true);
                 last_ele.after(new_ele);*/
                 
                var orginalDiv = $('.language_item:last');
				var clonedDiv = orginalDiv.clone();
				c++;
				clonedDiv.find('.guide_language').attr('name','guide_language'+c);
				clonedDiv.appendTo('.language_item');



               
                
            });















            $('.add_location').on('click', function() {            	
                c++;
                 // alert(c);
                 var last_ele=$(".location_item:last");
                 var new_ele=last_ele.clone(true);
                 last_ele.after(new_ele);
                
            });
            $( function() {
			    $( "#date_of_birth" ).datepicker();
			    $( "#issued_date" ).datepicker();
			    $( "#expired_date" ).datepicker();
			    $( "#service_date" ).datepicker();
			  } );

        </script>
@endsection

