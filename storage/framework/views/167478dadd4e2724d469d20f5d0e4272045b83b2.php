<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta name="csrf_token" content="<?php echo e(csrf_token()); ?>"
</head>
<body>
<div id="app">
<h1>Here is the Alert Box Page</h1>
</div>
<!-- <script src="<?php echo e(resource_path()); ?>/assets/js/app.js"  charset="utf-8"></script> -->
<script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
</body>
</html>