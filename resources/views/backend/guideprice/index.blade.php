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
											        {{$user_meta->fullname_en->value}}
											        
											     
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
										        	<div class="truncate-475" title="{{ $guideprice->title }}">
										        		{!! $guideprice->default !!}
										        	</div>
										        </td>
										      
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('guideprice.edit', Helper::encodeString($guideprice->id,Helper::encryptKey())) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('posts.destroy', encrypt($guideprice->id)) }}" method="post" class="inline-block">
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

@endsection