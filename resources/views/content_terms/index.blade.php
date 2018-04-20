@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->content_terms->title }}
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
											<th>Taxonomy</th>
											<th>Slug</th>
											<th>Title</th>
											<th>Term group</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@if(count($content_terms) ==0)
											{!! Helper::empty_table(7) !!}
										@endif

										@foreach($content_terms as $key => $content_term)
									      	<tr>
										        <td>{{ \Helper::indexed($content_terms, $key) }}</td>
										        <td>
										        	<code>
										        		{{ $content_term->term_id }}
										        	</code>
											        <a id="p{{ $content_term->term_id }}" class="hyper"></a>
										        </td>
										        <td>
										        	<a href="#p{{ $content_term->parent }}">
										        		{{ $content_term->parent }}
										        	</a>
										        </td>
										        <td>
										        	<span class="font-12 txt-color-blue">
										        		{{ $content_term->taxonomy }}
										        	</span>
										        </td>
										        <td>
										        	<code>
										        		{{ $content_term->slug }}
										        	</code>
										        </td>
										        <td>
										        	<div class="truncate-475" title="{{ $content_term->title }}">
										        		{!! $content_term->title !!}
										        	</div>
										        </td>
										        <td>{{ $content_term->term_group }}</td>
										        <td>
										        	<div class="btn-action">
											        	<a href="{{ route('content_terms.edit', encrypt($content_term->term_id)) }}" class="btn btn-primary btn-xs">edit</a>
											        	<form action="{{ route('content_terms.destroy', encrypt($content_term->term_id)) }}" method="post" class="inline-block">
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

								{!! \Helper::paginator(['route' => 'content_terms'], ['items' => $content_terms], ['display' => $display]) !!}

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