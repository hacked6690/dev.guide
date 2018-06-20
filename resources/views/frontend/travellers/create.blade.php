@extends('layouts.frontend.master')
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
	
	</style>
@endsection
@section('content')
	<div id="content">
	<div class="wrapper">
		<div class="container" style="width:90%">
			<form action="{{ route('travellers.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="post" enctype="multipart/form-data" >
				<div class="col-lg-6 col-md-6 col-lg-offset-3" style="border:1px dashed gray">
								<header>
									{{ $layout->label->traveller_registration->title }}
								</header>

								<fieldset>
									<div class="row">
										@if(Session::has('inserted'))
											<section class="col col-6">
												{!! Helper::alert('success', Session::get('inserted'), 'block font-15') !!}
											</section>
										@endif
									</div>
									
									
								
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
												<input type="text" value="{{ old('fullname_kh') }}" name="fullname_kh" placeholder="">
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
												<input type="text" value="{{ old('fullname_en') }}" name="fullname_en" placeholder="">
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

									<div class="row">
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
									</div>
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
											<textarea  rows="4" name="address" id="address">{{ old('address') }}</textarea>
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
													<input type="text" value="{{ old('dob') }}" name="dob" id="dob" placeholder="">
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
						                           <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
						                              @foreach($genders as $gender)
						                                   @if(old('gender') ==$gender->term_id)
						                                      <option value="{{$gender->term_id}}" selected >{{$gender->title}}</option>
						                                   @else
						                                      <option value="{{$gender->term_id}}">{{$gender->title}}</option>
						                                  @endif
						                              @endforeach
						                      </select>
						                      <i></i>
						                    </label>
										</section>										
									</div>
									<div class="row">		
										<section class="col col-lg-6 col-md-6 flexibled-error">
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
										<section class="col col-lg-6 flexibled-error">
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
													@foreach($nationalities as $nationality)
														@if(old('nationality_id') ==$nationality->term_id)
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
									<div class="row">
										<footer>
											{{ csrf_field() }}
											<button style="width:100%" type="submit"  class="btn-u btn-primary btn-lg">Submit</button>
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
<script type="text/javascript">
	 $( function() {
			    $( "#dob" ).datepicker();
			  } );
</script>
@endsection

