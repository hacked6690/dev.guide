<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title><?php echo e($layout->system->system_title->title); ?></title>
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		<?php echo $__env->make('layouts.admin.partials.required_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</head>

	<body id="login">
		
		<header id="header"></header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
						<div class="well no-padding">

							<form action="<?php echo e(route('register')); ?>" class="smart-form client-form" method="post">
								<header>
									Registration <span id="register_msg" class="txt-color-blue" data-loadtxt=" — Verifying..."></span>
								</header>

								<fieldset>
									
									<section class="flexibled-error">
										<label class="label">
											Email

											<?php if($errors->has('email')): ?>
												<div class="error-badge" id="for-email">
													<?php echo Helper::alert('danger', $errors->first('email')); ?>

												</div>
											<?php endif; ?>
										</label>
										<label class="input"> 
											<i class="icon-append fa fa-envelope"></i>
											<input type="email" name="email" value="<?php echo e(old('email')); ?>" class="border-0 border-bottom-1 flexibled">
										</label>
									</section>

									<section class="flexibled-error">
										<label class="label">
											Password

											<?php if($errors->has('password')): ?>
												<div class="error-badge" id="for-password">
													<?php echo Helper::alert('danger', $errors->first('password')); ?>

												</div>
											<?php endif; ?>
										</label>
										<label class="input"> 
											<i class="icon-append fa fa-lock"></i>
											<input type="password" name="password" class="border-0 border-bottom-1 flexibled">
										</label>
									</section>

									<section class="flexibled-error">
										<label class="label">
											Confirm password 
										</label>
										<label class="input"> 
											<i class="icon-append fa fa-undo"></i>
											<input type="password" name="password_confirmation" class="border-0 border-bottom-1 flexibled">
										</label>
									</section>
									
								</fieldset>
								<footer>
									<?php echo e(csrf_field()); ?>

									<button type="submit" class="btn btn-primary">
										Send
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
	    <?php echo $__env->make('layouts.admin.partials.jquery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	    <?php echo $__env->make('layouts.admin.partials.jquery_ui', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- IMPORTANT: APP CONFIG -->
		<?php echo $__env->make('layouts.admin.partials.required_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</body>

</html>