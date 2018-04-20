@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">					
					{{ $layout->menu->create_privilege->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="{{ route('privileges.index') }}" class="smart-form" method="post">

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
												Parent <code>#Optional</code>

												@if($errors->has('parent'))
													<div class="error-badge" id="for-parent">
														{!! Helper::alert('danger', $errors->first('parent')) !!}
													</div>
												@endif
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="parent">

													{!! Helper::empty_option() !!}

													@foreach($privileges as $privilege)

														@if(old('parent') ==$privilege->id)
															<option value="{{ $privilege->id }}" selected>{{ $privilege->title }}</option>
														@else
															<option value="{{ $privilege->id }}">{{ $privilege->title }}</option>
														@endif
													@endforeach
												</select><i></i>
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
										</section>
									</div>

								</fieldset>

								<footer>
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary">
										{{ $layout->label->save->title }}
									</button>
									<button type="submit" name="sane" value="true" class="btn btn-default">
										{{ $layout->label->sane->title }}
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