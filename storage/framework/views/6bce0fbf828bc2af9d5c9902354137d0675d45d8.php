<!--=== Header ===-->
		<div class="header">
			<div class="container">
				<!-- Logo -->
				<a class="logo" href="/">
					<img src="<?php echo e(asset('assets/logo.png')); ?>" alt="Logo" style="width:150px">
				</a>
				<!-- End Logo -->
					<!-- multiple lang dropdown : find all flags in the flags page -->
				


				<!-- Topbar -->
				<div class="topbar">
					<ul class="loginbar pull-right">
								<?php echo $languaged_fr; ?>

						
						<li class="topbar-devider"></li>
						<!-- <li><a href="page_faq.html">Help</a></li> -->
						<li class="topbar-devider"></li>
						<li><a href="/login">Login</a></li>
					</ul>
				</div>
				<!-- End Topbar -->

				<!-- Toggle get grouped for better mobile display -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<!-- End Toggle -->
			</div><!--/end container-->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
				<div class="container">
					<ul class="nav navbar-nav">
						<!-- Home -->

						<li class="dropdown active">
							<a href="/" class="dropdown-toggle" >
								<?php echo e($layout->menu->home->title); ?>

							</a>
							
						</li>
						<!-- End Home -->

						<li class=" ">
							<a href="<?php echo e($layout->menu->all_guides->url); ?>" class="dropdown-toggle" >
								<?php echo e($layout->menu->all_guides->title); ?>

							</a>
							
						</li>

						<li class=" ">
							<a href="<?php echo e($layout->menu->all_travellers->url); ?>" class="dropdown-toggle" >
								<?php echo e($layout->menu->all_travellers->title); ?>

							</a>
							
						</li>

						<li class=" ">
							<a href="<?php echo e($layout->menu->sys_register->url); ?>" class="dropdown-toggle" >
								<?php echo e($layout->menu->sys_register->title); ?>

							</a>
							
						</li>
						<li class=" ">
							<a href="<?php echo e($layout->menu->contact_us->url); ?>" class="dropdown-toggle" >
								<?php echo e($layout->menu->contact_us->title); ?>

							</a>
							
						</li>
						

						

					

						

						
					</ul>
				

						<!-- Top menu profile link : this shows only when top menu is active -->
						


				</div><!--/end container-->
					

			</div><!--/navbar-collapse-->

		</div>

		<!--=== End Header ===-->

		