@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->create_page->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-12">

							<form action="{{ route('pages.index') }}" class="smart-form" method="post">

								<fieldset>

									<div class="row">
										@if(Session::has('inserted'))
											<section class="col col-8">
												{!! Helper::alert('success', Session::get('inserted'), 'block font-15') !!}
											</section>
										@endif
									</div>

									<div class="row">
										
										<section class="col col-8">
											<div class="row">
												<section class="col col-10 flexibled-error">
													<label class="label">
														Title <code>*</code>

														@if($errors->has('title'))
															<div class="error-badge" id="for-title">
																{!! Helper::alert('danger', $errors->first('title')) !!}
															</div>
														@endif
													</label>
													<label class="input">
														<input type="text" name="title" value="{{ old('title') }}" class="input-sm border-0 border-bottom-1 font-bold font-18">
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-10 flexibled-error atoslug-upper">
													<label class="label">
														Slug <code>*</code> <botton class="btn btn-xs btn-primary atoslug" data-target="slug" data-slugof="page">auto</botton>

														@if($errors->has('slug'))
															<div class="error-badge" id="for-slug">
																{!! Helper::alert('danger', $errors->first('slug')) !!}
															</div>
														@endif
													</label>
													<label class="input">
														<input type="text" name="slug" value="{{ old('slug') }}" class="input-sm border-0 border-bottom-1 font-15">
													</label>
													<div class="note">
														{!! $layout->label->slug_note->title !!}
													</div>
												</section>
											</div>
											<div class="row">
												<section class="col col-10">
													<label class="label">
														Excerpt
													</label>
													<label class="textarea">
														<textarea name="excerpt" rows="3" data-height="75" data-menubar="false" data-ignore="image"
															id="excerpt" class="custom-scroll tinymce border-0 border-bottom-1">{{ old('excerpt') }}</textarea>
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-10 flexibled-error">
													<label class="label">
														Description <code>*</code>

														@if($errors->has('description'))
															<div class="error-badge" id="for-description">
																{!! Helper::alert('danger', $errors->first('description')) !!}
															</div>
														@endif
													</label>
													<label class="textarea">
														<textarea name="description" rows="7"
															id="description" class="custom-scroll tinymce border-0 border-bottom-1">{{ old('description') }}</textarea>
													</label>
												</section>
											</div>	
										</section>

										<section class="col col-4">
											<div class="row">
												<section class="col col-10 flexibled-error">
													<label class="label">
														Language <code>*</code>

														@if($errors->has('language_id'))
															<div class="error-badge" id="for-language_id">
																{!! Helper::alert('danger', $errors->first('language_id')) !!}
															</div>
														@endif
													</label>
													<label class="select">
														<select class="input-sm border-0 border-bottom-1" name="language_id">

															{!! Helper::empty_option() !!}

															@foreach($languages as $language)

																@if(old('language_id') ==$language->id || !old('language_id') && $language->slug =='en')
																	<option value="{{ $language->id }}" selected>{{ $language->title }}</option>
																@else
																	<option value="{{ $language->id }}">{{ $language->title }}</option>
																@endif
															@endforeach

														</select><i></i>
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-10 flexibled-error">
													<label class="label">
														Translate of

														@if($errors->has('translate_of'))
															<div class="error-badge" id="for-translate_of">
																{!! Helper::alert('danger', $errors->first('translate_of')) !!}
															</div>
														@endif
													</label>
													<label class="select">
														<select class="input-sm border-0 border-bottom-1" name="translate_of">

															{!! Helper::empty_option() !!}

															@foreach($ofpages as $ofpage)

																@if(old('translate_of') ==$ofpage->id)
																	<option value="{{ $ofpage->id }}" selected>{{ $ofpage->title }}</option>
																@else
																	<option value="{{ $ofpage->id }}">{{ $ofpage->title }}</option>
																@endif
															@endforeach

														</select><i></i>
													</label>
												</section>
											</div>												
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

@section('script')
	<script src="{{ asset('assets/admin/js/libs/tinymce/tinymce.min.js') }}"></script>
@endsection