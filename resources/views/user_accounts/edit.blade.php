@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->user_accounts->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<ul class="nav nav-tabs">
								<li class="{{ !Session::has('password') ? 'active' :'' }}">
									<a href="#personal" data-toggle="tab">
										<i class="glyphicon glyphicon-user"></i> Personal info</a>
								</li>
								<li class="{{ Session::has('password') ? 'active' :'' }}">
									<a href="#credential" data-toggle="tab">
										<i class="glyphicon glyphicon-lock"></i> Password</a>
								</li>
							</ul>

							<div class="tab-content">

								<div class="tab-pane fade in {{ !Session::has('password') ? 'active' :'' }}" id="personal">

									<form action="{{ route('user_accounts.update', encrypt($user->id)) }}" class="smart-form" method="post" enctype="multipart/form-data">

										<fieldset>

											<div class="row">
												@if(Session::has('updated'))
													<section class="col col-6">
														{!! Helper::alert('success', Session::get('updated'), 'block font-15') !!}
													</section>
												@endif
											</div>

											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Role <code>[ #important ]</code>

														@if($errors->has('role_id'))
															<div class="error-badge" id="for-role_id">
																{!! Helper::alert('danger', $errors->first('role_id')) !!}
															</div>
														@endif
													</label>
													<label class="select">
														<select class="input-sm border-0 border-bottom-1" name="role_id">

															{!! Helper::empty_option() !!}

															@foreach($user_roles as $user_role)
																@if($user->role_id == $user_role->id)
																	<option value="{{ $user_role->id }}" selected>{{ $user_role->title }}</option>
																@else
																	<option value="{{ $user_role->id }}">{{ $user_role->title }}</option>
																@endif
															@endforeach
														</select><i></i>
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-4 pull-right">
													<div class="profile-alt height-0">
														<img src="{{ $profile }}" width="112" height="112" alt=".profile" />
													</div>
													<div class="profile-note">
														<code>#Profile</code>
													</div>
												</section>
												<section class="col col-6 flexibled-error">
													<label class="label">
														Change profile ?

														@if($errors->has('profile'))
															<div class="error-badge" id="for-profile">
																{!! Helper::alert('danger', $errors->first('profile')) !!}
															</div>
														@endif
													</label>
													<div class="input input-file">
														<span class="button">
															<input type="file" name="profile" accept="image/*" onchange="this.parentNode.nextSibling.value = this.value">
																Browse
														</span><input type="text" class="border-0 border-bottom-1" placeholder="Include some files" readonly="">
													</div>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Name

														@if($errors->has('name'))
															<div class="error-badge" id="for-name">
																{!! Helper::alert('danger', $errors->first('name')) !!}
															</div>
														@endif
													</label>
													<label class="input">
														<input type="text" name="name" value="{{ old('name') ? old('name') :$user_meta->name->value }}" class="input-sm border-0 border-bottom-1">
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Phone

														@if($errors->has('phone'))
															<div class="error-badge" id="for-phone">
																{!! Helper::alert('danger', $errors->first('phone')) !!}
															</div>
														@endif
													</label>
													<label class="input">
														<input type="text" name="phone" value="{{ old('phone') ? old('phone') :$user_meta->phone->value }}" class="input-sm border-0 border-bottom-1">
													</label>
													<div class="note">
														{!! $layout->label->phone_note->title !!}
													</div>
												</section>
											</div>

										</fieldset>

										<footer>
											{{ method_field('put') }}
											{{ csrf_field() }}
											<button type="submit" class="btn btn-primary">
												{{ $layout->label->save->title }}
											</button>
										</footer>
									</form>

								</div>

								<div class="tab-pane fade in {{ Session::has('password') ? 'active' :'' }}" id="credential">

									<form action="{{ route('user_passwords.update', encrypt($user->id)) }}" class="smart-form" method="post">

										<fieldset>

											<div class="row">
											@if(Session::has('updated'))
												<section class="col col-6">
													{!! Helper::alert('success', Session::get('updated'), 'block font-15') !!}
												</section>
											@endif
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Email <code>#not required</code>
													</label>
													<label class="input"> <i class="icon-append fa fa-envelope"></i>
														<input type="email" value="{{ $user->email }}" class="font-18 border-0 border-bottom-1" disabled></label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Current Password

														@if($errors->has('curr_password'))
															<div class="error-badge" id="for-curr_password">
																{!! Helper::alert('danger', $errors->first('curr_password')) !!}
															</div>
														@endif
													</label>
													<label class="input"> <i class="icon-append fa fa-code"></i>
														<input type="password" name="curr_password" value="{{ old('curr_password') }}" class="border-0 border-bottom-1"></label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Password

														@if($errors->has('password'))
															<div class="error-badge" id="for-password">
																{!! Helper::alert('danger', $errors->first('password')) !!}
															</div>
														@endif
													</label>
													<label class="input"> <i class="icon-append fa fa-lock"></i>
														<input type="password" name="password" value="{{ old('password') }}" class="border-0 border-bottom-1"></label>
												</section>
											</div>
											<div class="row">
												<section class="col col-6 flexibled-error">
													<label class="label">
														Confirm password </label>
													<label class="input"> <i class="icon-append fa fa-undo"></i>
														<input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="border-0 border-bottom-1"></label>
												</section>
											</div>

										</fieldset>

										<footer>
											{{ method_field('put') }}
											{{ csrf_field() }}
											<button type="submit" class="btn btn-primary">
												{{ $layout->label->save->title }}
											</button>
										</footer>
									</form>

								</div>
							</div>
							<!-- End div.tab-content -->

						</div>
					</div>
					<!-- End div.row +child -->

				</div>
				<!-- End .well class -->

			</div>
		</div>
		<!-- End div.row +parent -->

	</div>
	<!-- END MAIN CONTENT -->

@endsection