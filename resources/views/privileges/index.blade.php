@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->privileges->title }}					
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
											<th>Slug</th>
											<th>Title</th>
											<th>Parent</th>
											<th>Description</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($privileges) ==0)
											{!! Helper::empty_table(6) !!}
										@endif

										@foreach($privileges as $key => $privilege)
									      	<tr>
										        <td>{{ \Helper::indexed($privileges, $key) }}</td>
										        <td>
										        	<code>{{ $privilege->slug }}</code>
										        </td>
										        <td>{{ $privilege->title }}</td>
										        <td>
										        	@if($privilege->parent_title !='')
										        		<span class="font-12 font-light txt-color-blue">
										        			{!! $privilege->parent_title !!}
										        		</span>
										        	@endif
										        </td>
										        <td>{{ $privilege->description }}</td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('privileges.edit', encrypt($privilege->id)) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('privileges.destroy', encrypt($privilege->id)) }}" method="post" class="inline-block">
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

								{!! \Helper::paginator(['route' => 'privileges'], ['items' => $privileges], ['display' => $display]) !!}
								
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