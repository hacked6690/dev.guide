@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->create_user_account->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="{{ route('user_accounts.index') }}" class="smart-form" method="post" enctype="multipart/form-data">

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
												Role <code>*</code>

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

														@if(old('role_id') ==$user_role->id)
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
										<section class="col col-6 flexibled-error">
											<label class="label">
												Profile

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
												<input type="text" name="name" value="{{ old('name') }}" class="input-sm border-0 border-bottom-1">
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
												<input type="text" name="phone" value="{{ old('phone') }}" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												{!! $layout->label->phone_note->title !!}
											</div>
										</section>
									</div>

								</fieldset>

								<fieldset>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Email

												@if($errors->has('email'))
													<div class="error-badge" id="for-email">
														{!! Helper::alert('danger', $errors->first('email')) !!}
													</div>
												@endif
											</label>
											<label class="input"> <i class="icon-append fa fa-envelope"></i>
												<input type="email" name="email" value="{{ old('email') }}" class="border-0 border-bottom-1"></label>
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
												<input type="password" name="password" class="border-0 border-bottom-1"></label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Confirm password </label>

											<label class="input"> <i class="icon-append fa fa-undo"></i>
												<input type="password" name="password_confirmation" class="border-0 border-bottom-1"></label>
										</section>
									</div>

								</fieldset>

								<footer>
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary">
										{{ $layout->label->save->title }}
									</button>
								</footer>
							</form>

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