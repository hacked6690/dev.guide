<!DOCTYPE html>
<html lang="en">
<head>
  <title>Confirm Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<h1 class="text text-primary" style="text-align:center">Guide Online Booking System <br>Confirm Account</h1>
<h3 class="text text-info">Confirm Your Email</h3>
<p>Dear <b style="color:green">{{$name}}</b>,</p>
<p>We received a request to confirm your account, pls click the button below to confirm your account ...</p>
<a target="_blank" href="{{Helper::VERIFY_LINK()}}/{{encrypt($id)}}" class="btn btn-primary">Confirm Account</a>
<br><br><br>
<hr/>
<h5 class="text text-info">Any question about this,
		 pls feel free contact to our team via: Telephone: (093 789 150) 
		 or email: (v.vannochit@gmail.com) at anytime
</h5>

</body>
<html>