@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->create_layout_category->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="{{ route('layout_categories.index') }}" class="smart-form" method="post">

								<fieldset>

									<div class="row">
										@if(Session::has('inserted'))
											<section class="col col-6">
												{!! Helper::alert('success', Session::get('inserted'), 'block font-15') !!}
											</section>
										@endif
									</div>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Slug

												@if($errors->has('slug'))
													<div class="error-badge" id="for-slug">
														{!! Helper::alert('danger', $errors->first('slug')) !!}
													</div>
												@endif
											</label>
											<label class="input">
												<input type="text" name="slug" value="{{ old('slug') }}" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												{!! $layout->label->slug_note->title !!}
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Title

												@if($errors->has('title'))
													<div class="error-badge" id="for-title">
														{!! Helper::alert('danger', $errors->first('title')) !!}
													</div>
												@endif
											</label>
											<label class="input">
												<input type="text" name="title" value="{{ old('title') }}" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Description
											</label>
											<label class="textarea">
												<textarea name="description" rows="3" 
													class="custom-scroll border-0 border-bottom-1">{{ old('description') }}</textarea>
											</label>
											<div class="note">
												<strong>Note:</strong> height of the textarea depends on the rows attribute.
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">
												Options
											</label>
											<label class="input">
												<input type="text" name="options" value="{{ old('options') }}" class="input-sm border-0 border-bottom-1">
											</label>
											<div class="note">
												{!! $layout->label->options_note->title !!}
											</div>
										</section>
									</div>

								</fieldset>

								<footer>
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary">
										{{ $layout->label->save->title }}
									</button>
								</footer>
							</form>

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