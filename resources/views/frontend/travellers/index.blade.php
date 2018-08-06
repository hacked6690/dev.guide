@extends('layouts.frontend.master')
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
	
	.profile img{
		width: 200px;
	}
	.table > tbody > tr > td {
     vertical-align: middle;
     text-align: center;
	}
	.mycontainer{
		width:90%;
		margin:0 auto;
	}

</style>

@endsection
@section('content')
<div class="content" id="content">
<div class="mycontainer">
	<form action="{{ route('travellers.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >

<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#c2d6d6;padding:2px;margin:0px">       
        <div class="col-lg-3 col-md-3 col-xs-12">
                <section class="flexibled-error">
                    <label class="label">
                        {{ $layout->label->fullname_en->title }} 
                        @if($errors->has('fullname_en'))
                            <div class="error-badge" id="for-fullname_en">
                             {!! Helper::alert('danger', $errors->first('fullname_en')) !!}
                             </div>
                       @endif
                    </label>
                    <label class="input">
                        <input type="text" value="{{$searchField->fullname_en}}" name="fullname_en" placeholder="Guide name">
                    </label>
                </section>
        </div>    
        <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                    <label class="label">
                        {{ $layout->label->gender->title }} 
                        @if($errors->has('gender'))
                            <div class="error-badge" id="for-gender">
                             {!! Helper::alert('danger', $errors->first('gender')) !!}
                             </div>
                       @endif
                    </label>
                    <label class="select">
                       <select value="{{ old('gender') }}" name="gender" onchange="return form.submit()" >
                           <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                              @foreach($genders as $gender)
                                   @if($searchField->gender==$gender->term_id)
                                      <option value="{{$gender->term_id}}" selected >{{$gender->title}}</option>
                                   @else
                                      <option value="{{$gender->term_id}}">{{$gender->title}}</option>
                                  @endif
                              @endforeach
                      </select>
                      <i></i>
                    </label>
        </section>       
     
         <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                <label class="label">
                       {{ $layout->label->nationality->title }}
                            @if($errors->has('nationality_id'))
                                <div class="error-badge" id="for-nationality_id">                                                            
                                    {!! Helper::alert('danger', $errors->first('nationality_id')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('nationality_id') }}" name="nationality_id" onchange="return form.submit()" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($nationalities as $nationality)
                                 @if($searchField->nationality_id==$nationality->term_id)
                                    <option value="{{$nationality->term_id}}" selected >{{$nationality->title}}</option>
                                 @else
                                    <option value="{{$nationality->term_id}}">{{$nationality->title}}</option>
                                @endif
                            @endforeach
                    </select>
                    <i></i>
               </label>
        </section> 
        
        
      

        <section class="col col-lg-1 col-md-1 col-xs-12 flexibled-error">
                <button type="submit"  class="btn-u btn btn-primary" style="width:100%;margin-top:30px;padding:2px">
                    <span class="button_search"><i class="fa fa-search"></i></span>
                 </button>   
        </section>    

</div>
</form>	
</div>

<div class="mycontainer  table table-responsive" >
		<table class="table table-responsive table-hover  table-bordered">
			<thead>
				<tr class="bg-header"  >
					<th style="width:10%">#{{$layout->label->id->title}}</th>
					<th style="width:15%">{{$layout->label->fullname_en->title}}</th>
					<th style="width:15%">{{$layout->label->fullname_kh->title}}</th>
					<th>{{$layout->label->gender->title}}</th>
					<th>{{$layout->label->telephone->title}}</th>
					<th>{{$layout->label->date_of_birth->title}}</th>					
					<th>{{$layout->label->nationality->title}}</th>
					<th>{{$layout->label->email->title}}</th>
				
				</tr>
			</thead>
			<tbody>
			@if(count($users)==0)	
				<tr  >
					<td colspan="8">
						<center>
							<h1 class="text text-danger">{{$layout->label->notfound->title}}</h1>
						</center>
					</td>
				</tr>
			@endif
				@foreach($users as $user)
				@php 
					$uid=$user["id"];
					$fullnameEN='' ;
					$fullnameKH='';
					$gender='' ;
					$guide_type='';
					$telephone='';
					$dob='';
					$nationality='';
					$photo='';
				@endphp
					@foreach($user["user_metas"] as $v)
						@if($v["meta_key"]=='fullname_en')
							@php
								$fullnameEN=$v["meta_value"]
							@endphp
						@endif
							@if($v["meta_key"]=='fullname_kh')
							@php
								$fullnameKH=$v["meta_value"]
							@endphp
						@endif
						@if($v["meta_key"]=='gender')
							@php
								$gender=$v["meta_value"]
							@endphp
						@endif
						@if($v["meta_key"]=='telephone')
							@php
								$telephone=$v["meta_value"]
							@endphp
						@endif
						@if($v["meta_key"]=='dob')
							@php
								$dob=$v["meta_value"]
							@endphp
						@endif
						@if($v["meta_key"]=='guide_type_id')
							@php
								$guide_type_id=$v["meta_value"]
							@endphp
						@endif
						@if($v["meta_key"]=='nationality_id')
							@php
								$nationality=$v["meta_value"]
							@endphp
						@endif		
						@if($v["meta_key"]=='photo')
							@php
								$photo=$v["meta_value"]
							@endphp
						@endif	
					@endforeach

						@php		
						$photo_path='';
                        if($photo!==''){
                           $file=Storage::url($uid.'/'. $photo);
                            if(!file_exists($file)){
                                $photo_path=Storage::url($uid.'/'. $photo);
                            }
                        }else{
                          $photo_path ='https://www.greatplacetowork.com/templates/gptw/images/no-image-available.jpg';
                        }
                        @endphp

						<tr>
							<td class="profile">
								<code>{{Helper::convertNumber($user["id"])}}</code><br>
								<img src="{{$photo_path}}"  class="img img-responsive img-thumbnail">
								
							</td>
							
							<td>								
									{{$fullnameEN}}
							</td>
							<td>								
									{{$fullnameKH}}
							</td>
							
							<td>
								
									{{Helper::term_translate($gender)}}
						
							</td>
							<td>
								
									{{Helper::convertNumber($telephone)}}
							
							</td>
							<td>
								
									{{Helper::convertDate($dob,$format='full')}}
								
							</td>							
							
							<td>
								
									{{Helper::term_translate($nationality)}}
							
							</td>
							<td>
								
									{{$user["email"]}}
								
							</td>
							
							
						
						</tr>
					
				@endforeach
			</tbody>
		</table>
		
		<div class="col-lg-12" >

			<div class="col-lg-2">
				   <h5>Total Records:<b> {{$totalRecords}}</b></h5>
			</div>
			<div class="col-lg-3">
				{!! $users->appends(Input::except('page'))->links() !!}
			</div>
	
		</div>

</div>













</div>








		
@endsection






 