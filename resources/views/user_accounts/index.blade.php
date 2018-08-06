@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->user_accounts->title }}
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
											<th>Role as</th>
											<th>Name</th>
											<th>Email</th>
											<th>#tel</th>
											<th>Created at</th>
											<th>Updated at</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($users) ==0)
											{!! Helper::empty_table(8) !!}
										@endif

										@foreach($users as $key => $user)										
											
									      	<tr>
									      		@php
												$user_meta = \Helper::metas('user_meta', ['user_id' => $user->id]);
												@endphp
										        <td>{{ \Helper::indexed($users, $key) }}</td>
										        <td>
										        	<code>{{ $user->role->title }}</code>
										        </td>
										        <td>{{ isset($user_meta->name->value)?$user_meta->name->value:"..."}}</td>
										        <td>{!! $user->email !!}</td>
										        <td>{{ isset($user_meta->phone->value)?$user_meta->phone->value:"..." }}</td>
										        <td>{{ $user->created_at }}</td>
										        <td>{{ $user->updated_at }}</td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('user_accounts.edit', encrypt($user->id)) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('user_accounts.destroy', encrypt($user->id)) }}" method="post" class="inline-block">
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
								
								{!! \Helper::paginator(['route' => 'user_accounts'], ['items' => $users], ['display' => $display]) !!}

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