@extends('layouts.frontend.master')
@section('style')
	

	<style type="text/css">
		.mycontainer{
			width: 90%;
			margin-top:20px;
			border:1px groove orange;
			/*padding-bottom: 50px;*/
		}
		.mycontainer .col-lg-6:first-child{
			border-right: 1px dashed green;
			padding-bottom: 50px;
		}

/*Google font integration*/
@import url('https://fonts.googleapis.com/css?family=Roboto');

#contact{
    background-color:#f1f1f1;
    font-family: 'Roboto', sans-serif;
}
#contact .well h3{
	padding-left: 20px;
}





#contact .row{
    margin-bottom:30px;
}
#contact input{
	border-radius: 20px;
}
@media (max-width: 768px) { 
    #contact iframe {
        margin-bottom: 15px;
    }
    
}


	
	</style>
@endsection
@section('content')
	<div id="content">
	<div class="wrapper">
		<div class="container mycontainer" >
<section id="contact">
    <div class="well well-sm" style="padding:0px">
      <h3><strong>{{$layout->label->contact_note->title}}</strong></h3>
    </div>
	<hr/>
	

	<div class="row">
	  <div class="col-md-7">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d977.2016357736306!2d104.9096278262072!3d11.565722022287938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109516b4b83e617%3A0xc464b23f83b4309a!2sMinistry+of+Tourism!5e0!3m2!1sen!2skh!4v1533009925604"
         width="100%" height="480" frameborder="0" style="border:0" allowfullscreen>
         </iframe>
      </div>

      <div class="col-md-5">
          <h4><strong>{{$layout->label->contact_fillin->title}}</strong></h4>
        <form method="post" action="/contact_us">
        {{csrf_field()}}
          <div class="form-group">
          	@if($errors->has('name'))
				<div class="error-badge" id="for-name">
					{!! Helper::alert('danger', $errors->first('name')) !!}
				</div>
			@endif												
            <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="{{$layout->label->fullname_en->title}}">
          </div>
          <div class="form-group">
          @if($errors->has('email'))
				<div class="error-badge" id="for-email">
					{!! Helper::alert('danger', $errors->first('email')) !!}
				</div>
			@endif			
            <input type="email" class="form-control" name="email" value="{{old('email')}}"   placeholder="{{$layout->label->email->title}}">
          </div>
          <div class="form-group">
          @if($errors->has('telephone'))
				<div class="error-badge" id="for-telephone">
					{!! Helper::alert('danger', $errors->first('telephone')) !!}
				</div>
			@endif			
            <input type="tel" class="form-control" name="telephone"  value="{{old('telephone')}}" placeholder="{{$layout->label->telephone->title}}">
          </div>
          <div class="form-group">
          @if($errors->has('message'))
				<div class="error-badge" id="for-message">
					{!! Helper::alert('danger', $errors->first('message')) !!}
				</div>
			@endif			
            <textarea class="form-control" name="message" rows="3"  value="{{old('message')}}" placeholder="{{$layout->label->contact_message->title}}"></textarea>
          </div>
          <button class="btn btn-primary" type="submit" name="submit">
              <i class="fas fa-share-square"></i> {{ $layout->label->submit->title }}
          </button>
        </form>
	        @if(Session::has('inserted'))
				<section class="col col-12">
					{!! Helper::alert('success', Session::get('inserted'), 'block font-15') !!}
				</section>
			@endif

      </div>
    </div>

</section>

		</div>
	</div><!--end wrapper class-->
	</div>
	<!-- END MAIN CONTENT -->

@endsection
@section('script')

@endsection

