@extends('layouts.admin.master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/css/homepage.css')}}">
	<link rel="stylesheet" href="{{asset('assets/frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<style type="text/css">
	.img_status{
		width: 35px;
	}
	.wd-20{
		width:20px;
	}
	.wd-30{
		width:30px;
	}
	.wd-40{
		width:40px;
	}
	.wd-50{
		width:50px;
	}
	.wd-60{
		width:60px;
	}
	.wd-70{
		width:70px;
	}
	.wd-80{
		width:80px;
	}
	.wd-90{
		width:90px;
	}
	.wd-100{
		width:100px;
	}
	.wd-120{
		width:120px;
	}
	.wd-140{
		width:140px;
	}
	.wd-160{
		width:160px;
	}
	.wd-180{
		width:180px;
	}
	.bg-header{
		
	}
	.mysearch{
		width:100%;
		padding:10px;
	}
</style>

@endsection
@section('content')


<div class="table table-responsive">
	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Message</th>
			</tr>
		</thead>
		<tbody>
			@foreach($contacts as $c)
				<tr>
					<td>{{$c->fullname_en}}</td>
					<td>{{$c->email}}</td>
					<td>{{$c->telephone}}</td>
					<td>{{$c->message}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="col-lg-12">
				{!! $contacts->appends(Input::except('page'))->links() !!}
	</div>
</div>




		
@endsection






 