@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->languages->title }}
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
											<th>Priority</th>
											<th>Set default</th>
											<th>Icon</th>
											<th>Options (Json)</th>
											<th>Status</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($languages) ==0)
											{!! Helper::empty_table(8) !!}
										@endif

										@foreach($languages as $key => $language)
									      	<tr>
										        <td>{{ $key +1 }}</td>
										        <td>
										        	<code>{{ $language->slug }}</code>
										        </td>
										        <td>{{ $language->title }}</td>
										        <td>{{ $language->priority }}</td>
										        <td>{{ $language->set_default }}</td>
										        <td>{!! $language->icon !!}</td>
										        <td>{{ $language->options }}</td>
										        <td>{{ $language->status }}</td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('languages.edit', encrypt($language->id)) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('languages.destroy', encrypt($language->id)) }}" method="post" class="inline-block">
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