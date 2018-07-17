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

<form action="{{ route('authorize.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >

<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#c2d6d6;padding:2px;margin:0px">       
        <div class="col-lg-2 col-md-2 col-xs-12">
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
                       <select value="{{ old('gender') }}" name="gender" >
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
                       {{ $layout->label->guide_type->title }}
                            @if($errors->has('guide_type_id'))
                                <div class="error-badge" id="for-guide_type_id">                                                            
                                    {!! Helper::alert('danger', $errors->first('guide_type_id')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('guide_type_id') }}" name="guide_type_id" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($guide_types as $guide_type)
                                 @if($searchField->guide_type_id==$guide_type->term_id)
                                    <option value="{{$guide_type->term_id}}" selected >{{$guide_type->title}}</option>
                                 @else
                                    <option value="{{$guide_type->term_id}}">{{$guide_type->title}}</option>
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
                     <select value="{{ old('nationality_id') }}" name="nationality_id" >
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
        <section class="col col-lg-3 col-md-3 col-xs-12 flexibled-error">
                <label class="label">
                       {{ $layout->label->language->title }}
                            @if($errors->has('guide_language'))
                                <div class="error-badge" id="for-guide_language">                                                            
                                    {!! Helper::alert('danger', $errors->first('guide_language')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('guide_language') }}" name="guide_language" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($guide_languages as $guide_language)
                                 @if($searchField->guide_language==$guide_language->term_id)
                                    <option value="{{$guide_language->term_id}}" selected >{{$guide_language->title}}</option>
                                 @else
                                    <option value="{{$guide_language->term_id}}">{{$guide_language->title}}</option>
                                @endif
                            @endforeach
                    </select>
                    <i></i>
               </label>
        </section>  
        <section class="col col-lg-1 col-md-1 col-xs-12 flexibled-error">
                <button type="submit"  class="btn-u" style="width:100%;margin-top:25px">
                    <span class="button_search"><i class="fa fa-search"></i></span>
                 </button>   
        </section>    

</div>
</form>	
<div class="myrow table table-responsive" >
		<table class="table table-responsive table-hover table-collapsed table-bordered">
			<thead>
				<tr class="bg-header">
					<th>#ID</th>
					<th>Fullname EN</th>
					<th>Gender</th>
					<th>Guide Type</th>
					<th>Nationality</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@if(count($users)==0)	
				<tr>
					<td colspan="7">
						NO DATA FOUND
					</td>
				</tr>
			@endif
				@foreach($users as $user)
				@php 
					$fullnameEN='' ;
					$gender='' ;
					$guide_type='';
					$nationality='';
				@endphp
					@foreach($user["user_metas"] as $v)
						@if($v["meta_key"]=='fullname_en')
							@php
								$fullnameEN=$v["meta_value"]
							@endphp
						@endif
						@if($v["meta_key"]=='gender')
							@php
								$gender=$v["meta_value"]
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
					@endforeach
						<tr>
							<td>
								<div class="wd-30">
								<code>{{$user["id"]}}</code>
								</div>
							</td>
							
							<td>
								<div class="wd-120">
									{{$fullnameEN}}
								</td>
								</div>
							<td>
								<div class="wd80">
									{{ContentTerms::getTermTitle($gender)}}
								</div>
							</td>
							<td>
								<div class="wd-100">
									{{ContentTerms::getTermTitle($guide_type_id)}}
								</div>
							</td>
							<td>
								<div class="wd-100">
									{{ContentTerms::getTermTitle($nationality)}}
								</div>
							</td>
							<td>
								<div class="wd-50">
								<img class="img img-responsive img_status" src="{{URL::asset('assets/status')}}/{{$user['active']}}.png"/>
								</div>
							</td>
							<td >
								<div class="wd-200">
							

								<button onclick="mypopup('{{ encrypt($user['id'])}}','{{$user['active']}}')" 
										        			data-backdrop="static" data-keyboard="false"
										        			data-toggle="modal" data-target="#myModal" 
										        			 class="detail btn btn-primary btn-xs">
										        			<i class="fas fa-edit"></i> &nbsp;Authorized
								</button>

								<a target="_blank" href="{{ route('authorize.edit', encrypt($user['id'])) }}" class="btn btn-primary btn-xs">
									<i class="fas fa-edit"></i> &nbsp;Edit
								</a>
								<form action="{{ route('guides.destroy', encrypt($user['id'])) }}" method="post" class="inline-block">
									{{ method_field('delete') }}
									{{ csrf_field() }}
									<button type="button" class="btn btn-danger btn-xs jscfm">
										<i class="fas fa-trash-alt"></i> &nbsp;Delete
									</button>
								</form>
								</div>
							</td>
						
						</tr>
					
				@endforeach
			</tbody>
		</table>
		{!! $users->appends(Input::except('page'))->links() !!}


</div>




<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$layout->label->guide_authorization->title}}</h4>
        </div>
        <div class="modal-body">
          	<form id="new_term-frm" class="ajxfrm smart-form" data-validate="true" data-reload="true" method="post">
          	<input type="hidden"  name="cmd" value="authorize">
          		{{csrf_field()}}
          		<input type="hidden"  class="guide_id" name="guide_id" />
          		<div class="row">
					<section class="col col-6 flexibled-error">
						<label class="label">
							{{$layout->label->pls_guide_status->title}} <code>*</code>
							@if($errors->has('status'))
								<div class="error-badge" id="for-status">
									{!! Helper::alert('danger', $errors->first('status')) !!}
								</div>
							@endif
						</label>
						<label class="select">
							<select class="input-sm border-0 border-bottom-1 status" name="status" >

								{!! Helper::empty_option() !!}
								{!! Helper::show_status() !!}
								
							</select><i></i>
						</label>
					</section>
				</div>
				
          	
        </div>
        <div class="modal-footer">        
          <button type="submit" name="save_detail" value="true" class="bt_save btn btn-default">
				{{ $layout->label->save->title }}
		  </button>
                  
        </div>
        </form>
      </div>      
    </div>
  </div>


		
@endsection



@section('script')
	<script type="text/javascript">
		  function mypopup(guide_id,active) {	
		  	// $('.guide_id').prop('disabled', false);
	        $(".guide_id").val(guide_id);
	        // $('.status option[value="'+active+'"]').attr("disabled", true);	
	         $('.status option[value="'+active+'"]').attr("selected", true);			      
	    } 
	
	</script>
@endsection


 