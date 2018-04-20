@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->user_roles->title }}
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
											<th>Description</th>
											<th>Options (Json)</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($user_roles) ==0)
											{!! Helper::empty_table(6) !!}
										@endif

										@foreach($user_roles as $key => $user_role)
									      	<tr>
										        <td>{{ $key +1 }}</td>
										        <td>
										        	<code>{{ $user_role->slug }}</code>
										        </td>
										        <td>{!! $user_role->title !!}</td>
										        <td>{{ $user_role->description }}</td>
										        <td>{{ $user_role->options }}</td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('user_privileges.create', encrypt($user_role->id)) }}" class="btn btn-success btn-xs">privileges</a>
											        	<a href="{{ route('user_roles.edit', encrypt($user_role->id)) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('user_roles.destroy', encrypt($user_role->id)) }}" method="post" class="inline-block">
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