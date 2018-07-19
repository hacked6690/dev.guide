<!-- support jQuery Ui -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
	if (!window.jQuery.ui) {
		document.write('<script src="<?php echo e(asset('assets/admin/js/libs/jquery-ui-1.10.3.min.js')); ?>"><\/script>');
	}
</script>