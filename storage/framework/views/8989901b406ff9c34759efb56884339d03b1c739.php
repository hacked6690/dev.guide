<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">

	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut-o">
				<img src="<?php echo e(isset($user_meta->profile) ? Storage::url($user_id .'/profile/'. $user_meta->profile) : asset('assets/admin/img/avatars/male.png')); ?>" alt="me" class="online" />
				<span>
					<?php //{{ $user_meta->name }} ?>
				</span>
				<i class="fa fa-angle-down"></i>
			</a>

		</span>
	</div>
	<!-- end user info -->

	<!-- NAVIGATION : This navigation is also responsive

	To make this navigation dynamic please make sure to link the node
	(the reference to the nav > ul) after page load. Or the navigation
	will not initialize.
	-->
	<?php echo $navigated; ?>


	<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->