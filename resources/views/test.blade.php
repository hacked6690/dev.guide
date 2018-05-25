 <?php $url="guides/1";?>
 <img src="data:image/png;base64,<?php echo base64_encode(QrCode::format('png')->size(200)->generate($url)); ?> ">
 <?php


 ?>
