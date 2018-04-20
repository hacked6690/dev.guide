@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->pages->title }}
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
											<th>Id</th>
											<th>Parent</th>
											<th>Tslt of</th>
											<th>Slug</th>
											<th>Title</th>
											<th>Viewed</th>
											<th>Shared</th>
											<th>Favorited</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($pages) ==0)
											{!! Helper::empty_table(10) !!}
										@endif

										@foreach($pages as $key => $page)
									      	<tr>
										        <td>{{ \Helper::indexed($pages, $key) }}</td>
										        <td>
										        	<code>
										        		{{ $page->id }}
										        	</code>
											        <a id="p{{ $page->id }}" class="hyper"></a>
										        </td>
										        <td>
										        	<a href="#p{{ $page->content_parent }}">
										        		{{ $page->content_parent }}
										        	</a>
										        </td>
										        <td>
										        	<a href="#p{{ $page->translate_of }}">
											        	<span class="font-12 txt-color-blue">
											        		{{ $page->translate_of }}
											        	</span>
											        </a>
										        </td>
										        <td>
										        	<code>
										        		{{ $page->slug }}
										        	</code>
										        </td>
										        <td>
										        	<div class="truncate-475" title="{{ $page->title }}">
										        		{!! $page->title !!}
										        	</div>
										        </td>
										        <td>{{ $page->viewed }}</td>
										        <td>{{ $page->shared }}</td>
										        <td>{{ $page->favorited }}</td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('pages.edit', encrypt($page->id)) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('pages.destroy', encrypt($page->id)) }}" method="post" class="inline-block">
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

								{!! \Helper::paginator(['route' => 'pages'], ['items' => $pages], ['display' => $display]) !!}

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