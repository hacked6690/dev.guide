@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->gp->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-12">

							@if(Session::has('deleted'))
								<section>
									{!! Helper::alert('success', Session::get('deleted'), 'block font-15') !!}
								</section>
							@endif
							@if(Session::has('warning'))
								<section class="col col-6">
									{!! Helper::alert('warning', Session::get('warning'), 'block font-15') !!}
								</section>
							@endif
							@if(Session::has('updated'))
								<section class="col col-6">
									{!! Helper::alert('success', Session::get('updated'), 'block font-15') !!}
								</section>
							@endif

							<div class="table-responsive">

								<table class="table table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>{{$layout->label->guide_id->title}}</th>
											<th>{{$layout->label->language->title}}</th>
											<th>{{$layout->label->location->title}}</th>
											<th>{{$layout->label->guide_price->title}}</th>
											<th>{{$layout->label->default->title}}</th>
											<th>{{$layout->label->fee_additional->title}}</th>
											<th>{{$layout->label->action->title}}</th>											
										</tr>
									</thead>
									<tbody>
										@if(count($guideprices) ==0)
											{!! Helper::empty_table(10) !!}
										@endif

										@foreach($guideprices as $key => $guideprice)
											<?php $user_meta=Helper::metas('user_meta',['user_id' => $guideprice->guide_id] );?>
									      	<tr>
										        <td>{{ \Helper::indexed($guideprices, $key) }}</td>
										        <td>
										        	<code>
										        		{{ $guideprice->guide_id }}
										        	</code>
											        <a id="{{ $guideprice->id }}" class="hyper"></a>
											        <br>

											       <?php  //{{$user_meta->fullname_en->value}} ?>
											        
											     
										        </td>
										        <td>
										        	<a href="{{ $guideprice->content_parent }}">
										        		{{ $guideprice->language->title }}
										        	</a>
										        </td>
										        <td>
										        	<a href="#p{{ $guideprice->translate_of }}">
											        	<span class="font-12 txt-color-blue">
											        		{{ $guideprice->province->title }}
											        	</span>
											        </a>
										        </td>
										        <td>
										        	<code>
										        		{{ $guideprice->price }} <code>USD</code>
										        	</code>
										        </td>
										        <td>
										        	<div class="truncate-35" title="{{ $guideprice->title }}">
										        		{!! $guideprice->default !!}
										        	</div>
										        </td>
										        <td>	
										        	<div class="truncate-275" title="{{ $guideprice->title }}">									        	
										        	@php
										        		$details=$guideprice->guideprice_detail;
										        	@endphp
										        	<table  class="table table-responsive table-hover" 
										        	style="background-color:#f0f0f5;font-size:12px">
										        		@php
										        			$n=1;
										        		@endphp
										        		@foreach($details as $detail)
										        		<tr>
										        			<td>{{$n++}}</td>
										        			<td>{{$detail->fee->title}}</td>
										        			<td>{{$detail->gp_price}}<code>USD</code></td>
										        			<td>
										        				<form action="{{ route('guidepricedetail.destroy', encrypt($detail->id)) }}" method="post" class="inline-block">
																	{{ method_field('delete') }}
																	{{ csrf_field() }}
																	<button type="button" class="btn btn-danger btn-xs jscfm">Delete</button>
																</form>
										        			</td>
										        		</tr>
										        		@endforeach

										        
										        	</table>
										        	</div>
										        </td>
										      
										        <td>
										        	<div class="btn-action">
										        		<button onclick="mypopup({{ $guideprice->id }})" 
										        			data-backdrop="static" data-keyboard="false"
										        			data-toggle="modal" data-target="#myModal"  class="detail btn btn-primary btn-xs">{{$layout->label->fee_additional->title}}</button>
											        	<a href="{{ route('guideprice.edit', Helper::encodeString($guideprice->id,Helper::encryptKey())) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('guideprice.destroy', encrypt($guideprice->id)) }}" method="post" class="inline-block">
															{{ method_field('delete') }}
															{{ csrf_field() }}
															<button type="button" class="btn btn-danger btn-xs jscfm">Delete</button>
														</form>
													</div>
										        </td>
									      	</tr>
										@endforeach
									</tbody>
								</table>

							</div>
							<!-- End + div.table-responsive -->

							<div class="table-footer">

							
								{!! \Helper::paginator(['route' => 'guideprice'], ['items' => $guideprices], ['display' => $display]) !!} 
						

							</div>

						</div>
					</div>
					<!-- End div.row +child -->

				</div>
				<!-- End .well class -->

			</div>
		</div>
		<!-- End div.row +parent -->

	</div>
	<!-- END MAIN CONTENT -->



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$layout->label->fee_additional->title}}</h4>
        </div>
        <div class="modal-body">
          	<form id="new_term-frm" class="ajxfrm smart-form" data-validate="true" data-reload="true" method="post">
          	<input type="hidden"  name="cmd" value="guideprice">
          		{{csrf_field()}}
          		<div class="row">
					<section class="col col-6 flexibled-error">
						<label class="label">
							{{$layout->label->fee_additional->title}} <code>*</code>
							@if($errors->has('fee_id'))
								<div class="error-badge" id="for-fee_id">
									{!! Helper::alert('danger', $errors->first('fee_id')) !!}
								</div>
							@endif
						</label>
						<label class="select">
							<select class="input-sm border-0 border-bottom-1" name="fee_id">

								{!! Helper::empty_option() !!}

								@foreach($fees as $fee)
									@if(old('fee_id') ==$fee->term_id)
										<option value="{{ $fee->term_id }}" selected>{{ $fee->title }}</option>
									@else
										<option value="{{ $fee->term_id }}">{{ $fee->title }}</option>
									@endif
								@endforeach
							</select><i></i>
						</label>
					</section>
				</div>
				<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												{{$layout->label->additional_price->title}} <code>*{{$layout->label->usd->title}} <code>*</code></code>

												@if($errors->has('price'))
													<div class="error-badge" id="for-slug">
														{!! Helper::alert('danger', $errors->first('price')) !!}
													</div>
												@endif
											</label>
											<label class="input">
												<input type="text" name="price" value="{{ old('price') }}" class="input-sm border-0 border-bottom-1">
											</label>
											<input type="hidden"  class="guideprice_id" name="guideprice_id" />
											
										</section>
				</div>
          	
        </div>
        <div class="modal-footer">        
          <button type="submit" name="save_detail" value="true" class="bt_save btn btn-default">
				{{ $layout->label->save->title }}
		  </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>          
        </div>
        </form>
      </div>      
    </div>
  </div>
  

@endsection

<script type="text/javascript">
	
	  function mypopup(guideprice_id) {	    
	        $(".guideprice_id").val(guideprice_id);	
	        // alert(guideprice_id);
	    }  
	

	

</script>