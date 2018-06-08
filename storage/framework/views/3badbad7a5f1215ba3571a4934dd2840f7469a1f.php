
<script src="<?php echo e(asset('assets/admin/js/app.config.seed.js')); ?>"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo e(asset('assets/admin/js/bootstrap/bootstrap.min.js')); ?>"></script>

<!--[if IE 8]>
	<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="<?php echo e(asset('assets/admin/js/app.seed.js')); ?>"></script>

<!-- Additional libs -->
<script src="<?php echo e(asset('assets/admin/js/libs/jquery-confirm-v3.0.1/jquery-confirm.min.js')); ?>"></script>

<!-- yield optional script on page[s] -->
<?php echo $__env->yieldContent('script'); ?>

<!-- custom Js -->
<script src="<?php echo e(asset('assets/admin/js/custom.js?t='. time())); ?>"></script>

