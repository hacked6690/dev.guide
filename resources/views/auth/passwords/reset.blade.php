<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title>{{ $layout->system->system_title->title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		@include('layouts.admin.partials.required_style')

	</head>

	<body class="animated fadeInDown-o">

		<header id="header"></header>

		<div id="main" role="main">

			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
						<div class="well no-padding">
							<form action="{{ route('password.request') }}" class="smart-form client-form" method="post">
								<header>
									Reset Password
								</header>

								<fieldset>

									<section class="flexibled-error">
										<label class="label">
											E-mail address

											@if($errors->has('email'))
												<div class="error-badge" id="for-email">
													{!! Helper::alert('danger', $errors->first('email')) !!}
												</div>
											@endif
										</label>
										<label class="input"> 
											<i class="icon-append fa fa-envelope"></i>
											<input type="email" name="email" value="{{ $email or old('email') }}" class="border-0 border-bottom-1 flexibled">
										</label>
									</section>

									<section class="flexibled-error">
										<label class="label">
											Password

											@if($errors->has('password'))
												<div class="error-badge" id="for-password">
													{!! Helper::alert('danger',  $errors->first('password')) !!}
												</div>
											@endif
										</label>
										<label class="input"> 
											<i class="icon-append fa fa-unlock-alt"></i>
											<input type="password" name="password" value="{{ old('password') }}" class="border-0 border-bottom-1 flexibled">
										</label>
									</section>

									<section class="flexibled-error">
										<label class="label">
											Confirm Password

											@if($errors->has('password_confirmation'))
												<div class="error-badge" id="for-password_confirmation">
													{!! Helper::alert('danger',  $errors->first('password_confirmation')) !!}
												</div>
											@endif
										</label>
										<label class="input"> 
											<i class="icon-append fa fa-lock"></i>
											<input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="border-0 border-bottom-1 flexibled">
										</label>
									</section>

								</fieldset>
								<footer>
									{{ csrf_field() }}
									<input type="hidden" name="token" value="{{ $token }}">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-fw fa-undo"></i> Reset
									</button>
								</footer>
							</form>

						</div>

					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    @include('layouts.admin.partials.jquery')

		<!-- IMPORTANT: APP CONFIG -->
		@include('layouts.admin.partials.required_script')

	</body>
</html>