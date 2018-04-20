@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->layout_items->title }}
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
											<th>#</th>
											<th title="Parent">pr</th>
											<th>Category</th>
											<th>Slug</th>
											<th>Title</th>
											<th>Url</th>
											<th>Icon</th>
											<th>Trslted</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($layout_items) ==0)
											{!! Helper::empty_table(10) !!}
										@endif

										@foreach($layout_items as $key => $layout_item)
									      	<tr>
										        <td>{{ \Helper::indexed($layout_items, $key) }}</td>
										        <td>
										        	@if($layout_item->parent !='')
										        		<code>{{ $layout_item->parent }}</code>
										        	@endif
										        </td>
										        <td>
										        	<span class="font-11">
										        		{{ $layout_item->layout_category }}
										        	</span>
										        </td>
										        <td>
										        	<code>{{ $layout_item->slug }}</code>
										        </td>
										        <td>{!! $layout_item->title !!}</td>
										        <td>
										        	<span class="font-12">
										        		{{ $layout_item->url }}
										        	</span>
										        </td>
										        <td>{!! $layout_item->icon !!}</td>
										        <td>
										        	@if($layout_item->translated !='')
										        		<code>{{ $layout_item->translated }}</code>
										        	@endif
										        </td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('layout_item_translates.create', encrypt($layout_item->id)) }}" class="btn btn-default btn-xs">trsl</a>
											        	<a href="{{ route('layout_items.edit', encrypt($layout_item->id)) }}" class="btn btn-primary btn-xs">edt</a>
											        	<form action="{{ route('layout_items.destroy', encrypt($layout_item->id)) }}" method="post" class="inline-block">
															{{ method_field('delete') }}
															{{ csrf_field() }}
															<button type="button" class="btn btn-danger btn-xs jscfm">Del</button>
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

								{!! \Helper::paginator(['route' => 'layout_items'], ['items' => $layout_items], ['display' => $display]) !!}

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