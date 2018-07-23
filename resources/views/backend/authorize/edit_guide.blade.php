@extends('layouts.admin.master')
@section('style')
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
	.inline-block{
		padding:0px;
		margin: 0px;
	}
	.border-0{
		border: 0px solid #bdbdbd !important;
	}
	.border-bottom-1{
		border-bottom: 1px solid #bdbdbd !important;
	}
	.ui-widget.ui-widget-content{
		width:250px;
	}
	.profilephoto img{
		width:200px;
	}
	
	</style>
@endsection
@section('content')
	<div id="content">
	<div class="wrapper">
		<div class="container" style="width:100%;padding:0px;margin:0px">
		@php
			$fullname_en = '';
			$fullname_kh = '';
			$guide_certified='';
			$photo='';
		@endphp
		@foreach($guide->user_metas as $um)
			@php
				switch($um->meta_key){
					case 'fullname_en' : $fullname_en = $um->meta_value;break;
					case 'fullname_kh' : $fullname_kh = $um->meta_value;break;
					case 'license_id' : $license_id = $um->meta_value;break;
					case 'address' : $address = $um->meta_value;break;
					case 'dob' : $dob = $um->meta_value;break;
					case 'gender' : $gender = $um->meta_value;break;
					case 'telephone' : $telephone = $um->meta_value;break;
					case 'nationality_id' : $nationality_id = $um->meta_value;break;
			
					case 'generation' : $generation = $um->meta_value;break;
					case 'guide_certified' : $guide_certified = $um->meta_value;break;
					case 'behavior_certified' : $behavior_certified = $um->meta_value;break;
					case 'id_card' : $id_card = $um->meta_value;break;
					case 'partner_id' : $partner_id = $um->meta_value;break;
					case 'cv_provided' : $cv_provided = $um->meta_value;break;
					case 'guide_type_id' : $guide_type_id = $um->meta_value;break;
					case 'domicile_certified' : $domicile_certified = $um->meta_value;break;
					case 'new_renew' : $new_renew = $um->meta_value;break;
					case 'issued_date' : $issued_date = $um->meta_value;break;
					case 'expired_date' : $expired_date = $um->meta_value;break;
					case 'date_in_service' : $date_in_service = $um->meta_value;break;
					case 'photo' : $photo = $um->meta_value;break;


				}
			@endphp
			
			
		@endforeach
		@php
			if($photo!==''){			
		
				 $photo=Storage::url($guide->id.'/' . $photo);
			}else{
				$photo ='http://www.bsmc.net.au/wp-content/uploads/No-image-available.jpg';
			}
			@endphp
			
		
			<form action="{{ route('guides.update', encrypt($guide->id)) }}" id="sky-form4" class="sky-form" class="smart-form" method="post" enctype="multipart/form-data" >
				<div class="col-lg-5 col-md-5">
								<header>
									{{ $layout->label->guide_registration->title }}  
									<a target="_blank" href="/authorize/settingprice/{{encrypt($guide->id) }}" class="btn btn-success btn-sm" style="color:white">
									<i class="fas fa-edit"></i> &nbsp;Setting Guide Price
									</a>
								</header>

								<fieldset>
									<div class="row">
										@if(Session::has('updated'))
											<section class="col col-12">
												{!! Helper::alert('success', Session::get('updated'), 'block font-15') !!}
											</section>
										@endif
									</div>
									
									<section class="flexibled-error">
											<label class="label">
														{{ $layout->label->license_id->title }} <code>*</code>
														@if($errors->has('license_id'))
															<div class="error-badge" id="for-license_id">
																{!! Helper::alert('danger', $errors->first('license_id')) !!}
															</div>
														@endif
											</label>
											<label class="input">
												<input type="text" value="{{$license_id}}" name="license_id" placeholder="">
											</label>
									</section>
								
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->fullname_kh->title }}<code>*</code>
														@if($errors->has('fullname_kh'))
															<div class="error-badge" id="for-fullname_kh">
																{!! Helper::alert('danger', $errors->first('fullname_kh')) !!}
															</div>
														@endif
											</label>
											<label class="input">
												<input type="text" value="{{$fullname_kh}}" name="fullname_kh" placeholder="">
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
														{{ $layout->label->fullname_en->title }}<code>*</code>
														@if($errors->has('fullname_en'))
															<div class="error-badge" id="for-fullname_en">															
																{!! Helper::alert('danger', $errors->first('fullname_en')) !!}
															</div>
														@endif
											</label>
											<label class="input">
												<input type="text" value="{{$fullname_en}}" name="fullname_en" placeholder="">
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
											<input type="email" value="{{$guide->email }}" name="email" placeholder="">
											<b class="tooltip tooltip-bottom-right">Pls Fill your email account</b>
										</label>
									</section>
								<!-- Password and Confirm hidden -->
								<!-- 	<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
																{{ $layout->label->password->title }}<code>*</code>
																@if($errors->has('password'))
																	<div class="error-badge" id="for-password">															
																		{!! Helper::alert('danger', $errors->first('password')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password" value="{{old('password')}}" name="password" placeholder="Password" id="password">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>
										<section class="col col-6 flexibled-error">
											<label class="label">
																{{ $layout->label->confirm_password->title }}<code>*</code>
																@if($errors->has('password_confirmation'))
																	<div class="error-badge" id="for-confirm_password">															
																		{!! Helper::alert('danger', $errors->first('password_confirmation')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<input type="password"  name="password_confirmation" placeholder="Password" id="password_confirmation">
												<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
										</section>									
									</div> -->
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
											<textarea  rows="4" name="address" id="address">{{ $address }}</textarea>
										</label>
									</section>


									<div class="row">
											<section class="col col-6 flexibled-error">
												<label class="label">
														{{ $layout->label->date_of_birth->title }}<code>*</code>
														@if($errors->has('dob'))
															<div class="error-badge" id="for-dob">															
																{!! Helper::alert('danger', $errors->first('dob')) !!}
															</div>
														@endif
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="{{ Helper::CalendarDate($dob) }}" name="dob" id="dob" placeholder="">
												</label>
											</section>	
											<section class="col col-6 flexibled-error">
											 <label class="label">
						                        {{ $layout->label->gender->title }} 
						                        @if($errors->has('gender'))
						                            <div class="error-badge" id="for-gender">
						                             {!! Helper::alert('danger', $errors->first('gender')) !!}
						                             </div>
						                       @endif
						                    </label>
						                    <label class="select">
						                       <select value="{{ old('gender') }}" name="gender" >
						                           <option value="0" selected disabled >{{$layout->label->please_select_below->title}}</option>
						                              @foreach($genders as $g)
						                                   @if($gender ==$g->term_id)
						                                      <option value="{{$g->term_id}}" selected >{{$g->title}}</option>
						                                   @else
						                                      <option value="{{$g->term_id}}">{{$g->title}}</option>
						                                  @endif
						                              @endforeach
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
														<input type="text" value="{{ $telephone }}" name="telephone" placeholder="">
													</label>
										</section>					
									</div>
									<div class="row">											
											<section class="col col-lg-12 flexibled-error">
											<label class="label">
																{{ $layout->label->nationality->title }}<code>*</code>
																@if($errors->has('nationality_id'))
																	<div class="error-badge" id="for-nationality_id">															
																		{!! Helper::alert('danger', $errors->first('nationality_id')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('nationality_id') }}" name="nationality_id" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($nationalities as $n)
														@if($nationality_id ==$n->term_id)
																	<option value="{{$n->term_id}}" selected >{{$n->title}}</option>
														@else
																	<option value="{{$n->term_id}}">{{$n->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
										</section>										
									</div>
									<div class="row">											
										<section class="col col-lg-6 flexibled-error">
											<label class="label">
																{{ $layout->label->province->title }}<code>*</code>
																@if($errors->has('province_id'))
																	<div class="error-badge" id="for-province_id">															
																		{!! Helper::alert('danger', $errors->first('province_id')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('province_id') }}" name="province_id" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($provinces as $p)
														@if($guide_price->province_id ==$p->term_id)
																	<option value="{{$p->term_id}}" selected >{{$p->title}}</option>
														@else
																	<option value="{{$p->term_id}}">{{$p->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
										</section>	
										<section class="col col-lg-6 flexibled-error">
											<label class="label">
																{{ $layout->label->language->title }}<code>*</code>
																@if($errors->has('language_id'))
																	<div class="error-badge" id="for-language_id">															
																		{!! Helper::alert('danger', $errors->first('language_id')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('language_id') }}" name="language_id" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($guide_languages as $guide_language)
														@if($guide_price->language_id ==$guide_language->term_id)
																	<option value="{{$guide_language->term_id}}" selected >{{$guide_language->title}}</option>
														@else
																	<option value="{{$guide_language->term_id}}">{{$guide_language->title}}</option>
														@endif
														
													@endforeach
												</select>
												<i></i>
											</label>
										</section>											
									</div>
									<div class="row">		
										<section class="col col-lg-12 col-md-12 flexibled-error">
													<label class="label">
																{{ $layout->label->guide_price->title }}<code>*</code>
																@if($errors->has('guide_price'))
																	<div class="error-badge" id="for-guide_price">															
																		{!! Helper::alert('danger', $errors->first('guide_price')) !!}
																	</div>
																@endif
													</label>
													<label class="input">
														<input type="text" value="{{ $guide_price->price }}" name="guide_price" placeholder="">
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
												<input type="text" value="{{ $generation }}" name="generation" placeholder="">
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
										
											@if($guide_certified == 'yes')
												<option value="yes" selected>Yes</option>
												<option value="no">No</option>
											@elseif($guide_certified == 'no')
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
										
											@if($behavior_certified == 'yes')
												<option value="yes" selected>Yes</option>
												<option value="no">No</option>
											@elseif($behavior_certified == 'no')
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
																@if($errors->has('id_card'))
																	<div class="error-badge" id="for-id_card">															
																		{!! Helper::alert('danger', $errors->first('id_card')) !!}
																	</div>
																@endif
											</label>
											<label class="input">
												<input type="text" value="{{$id_card}}" name="id_card" placeholder="ID Number">
											</label>
								</section>

								<section class="col col-lg-5 col-md-5 flexibled-error">

									<label class="label">
																{{ $layout->label->partner_type->title }}<code>*</code>
																@if($errors->has('partner_id'))
																	<div class="error-badge" id="for-partner_id">															
																		{!! Helper::alert('danger', $errors->first('partner_id')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('partner_id') }}" name="partner_id" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($partner_types as $partner_type)
														@if($partner_id ==$partner_type->term_id)
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
													
													@if($cv_provided == 'yes')
														<option value="yes" selected>Yes</option>
														<option value="no">No</option>
													@elseif($cv_provided == 'no')
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
													
													@if($domicile_certified == 'yes')
														<option value="yes" selected>Yes</option>
														<option value="no">No</option>
													@elseif($domicile_certified == 'no')
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
																{{ $layout->label->renewal_type->title }}<code>*</code>
																@if($errors->has('new_renew'))
																	<div class="error-badge" id="for-new_renew">															
																		{!! Helper::alert('danger', $errors->first('new_renew')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('new_renew') }}" name="new_renew" >
													
													@if($new_renew == 'new')
														<option value="new" selected>New</option>
														<option value="renewal">Renewal</option>
													@elseif($new_renew == 'renewal')
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
																@if($errors->has('guide_type_id'))
																	<div class="error-badge" id="for-guide_type_id">															
																		{!! Helper::alert('danger', $errors->first('guide_type_id')) !!}
																	</div>
																@endif
											</label>
											<label class="select">
												<select value="{{ old('guide_type_id') }}" name="guide_type_id" >
													<option value="0" selected disabled>Select Below</option>
													@foreach($guide_types as $guide_type)
														@if($guide_type_id ==$guide_type->term_id)
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
													<input type="text" value="{{Helper::CalendarDate($issued_date)}}" name="issued_date" id="issued_date"  placeholder="Issued Date">
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
													<input type="text" value="{{Helper::CalendarDate($expired_date)}}"  name="expired_date" id="expired_date" placeholder="Expired Date">
												</label>
											</section>	
											<section class="col col-4 flexibled-error">
												<label class="label">
																{{ $layout->label->service_date->title }}<code>*</code>
																@if($errors->has('date_in_service'))
																	<div class="error-badge" id="for-date_in_service">															
																		{!! Helper::alert('danger', $errors->first('date_in_service')) !!}
																	</div>
																@endif
												</label>
												<label class="input">
													<i class="icon-append fa fa-calendar"></i>
													<input type="text" value="{{Helper::CalendarDate($date_in_service)}}"  name="date_in_service" id="date_in_service"  placeholder="Service Date">
												</label>
											</section>								
							</div>
							
							
							<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Profile

												@if($errors->has('photo'))
													<div class="error-badge" id="for-photo">
														{!! Helper::alert('danger', $errors->first('photo')) !!}
													</div>
												@endif
											</label>
											<div class="input input-file">
												<span class="button">
													<input type="file"  name="photo" accept="image/*" onchange="this.parentNode.nextSibling.value = this.value">
														Browse
												</span><input type="text" class="border-0 border-bottom-1" placeholder="" readonly="">
											</div>
										</section>
							</div>		
							<div class="row profilephoto">					
								<img src="{{$photo}}" class="img img-responsive img-thumbnail ">
							</div>
							<div class="row">
										<section class="col col-lg-12">
											<label class="label">
																
																@if($errors->has('agree'))
																	<div class="error-badge" id="for-agree">															
																		{!! Helper::alert('danger', $errors->first('agree')) !!}
																	</div>
																@endif
											</label>
											<label class="checkbox">
												@if(old('agree')!=='')
													<input type="checkbox"  name="agree" id="agree"><i></i>{{ $layout->label->i_agree_term->title }}
												@else
													<input type="checkbox" value="{{old('agree')}}" name="agree" id="agree"><i></i>{{ $layout->label->i_agree_term->title }}
												@endif
												
											</label>
										</section>
										<footer>
											{{ method_field('put') }}
											{{ csrf_field() }}
											<button type="submit"  class="btn-u btn btn-primary"> <i class="far fa fa-lg fa-save"></i> &nbsp;Submit</button>
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
          
            $( function() {
			    $( "#dob" ).datepicker();
			    $( "#issued_date" ).datepicker();
			    $( "#expired_date" ).datepicker();
			    $( "#date_in_service" ).datepicker();
			  } );

        </script>
@endsection

