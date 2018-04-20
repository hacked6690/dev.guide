@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->posts->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-12">

							<form action="{{ route('posts.update', encrypt($post->id)) }}" class="smart-form" method="post">

								<fieldset>

									<div class="row">
										@if(Session::has('updated'))
											<section class="col col-8">
												{!! Helper::alert('success', Session::get('updated'), 'block font-15') !!}
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
														<input type="text" name="title" value="{{ old('title') ? old('title') : $post->title }}" class="input-sm border-0 border-bottom-1 font-bold font-18">
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-10 flexibled-error atoslug-upper">
													<label class="label">
														Slug <code>*</code> <botton class="btn btn-xs btn-primary atoslug" data-target="slug" data-slugof="post">auto</botton>

														@if($errors->has('slug'))
															<div class="error-badge" id="for-slug">
																{!! Helper::alert('danger', $errors->first('slug')) !!}
															</div>
														@endif
													</label>
													<label class="input">
														<input type="text" name="slug" value="{{ old('slug') ? old('slug') :$post->slug }}" class="input-sm border-0 border-bottom-1 font-15">
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
															id="excerpt" class="custom-scroll tinymce border-0 border-bottom-1">{{ old('excerpt') ? old('excerpt') :$post->excerpt }}</textarea>
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
															id="description" class="custom-scroll tinymce border-0 border-bottom-1">{{ old('description') ? old('description') :$post->description }}</textarea>
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

																@if(old('language_id') ==$language->id || !old('language_id') && $post->language_id ==$language->id)
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

															@foreach($ofposts as $ofpost)

																@if(old('translate_of') ==$ofpost->id || !old('translate_of') && $post->translate_of == $ofpost->id)
																	<option value="{{ $ofpost->id }}" selected>{{ $ofpost->title }}</option>
																@else
																	<option value="{{ $ofpost->id }}">{{ $ofpost->title }}</option>
																@endif
															@endforeach

														</select><i></i>
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-10 flexibled-error">
													<label class="label">
														Categories <code>*</code>

														@if($errors->has('categories'))
															<div class="error-badge" id="for-categories">
																{!! Helper::alert('danger', $errors->first('categories')) !!}
															</div>
														@endif
													</label>
													<label class="select select-multiple">
														<select class="costom-scroll border-0 border-bottom-1" name="categories[]" multiple="">

															@foreach($categories as $category)

																@if(old('categories') ==$category->term_id || !old('category') && $post_categories->contains($category->term_id))
																	<option value="{{ $category->term_id }}" selected>{{ $category->title }}</option>
																@else
																	<option value="{{ $category->term_id }}">{{ $category->title }}</option>
																@endif
															@endforeach

														</select>
													</label>
												</section>
											</div>
										</section>

									</div>

								</fieldset>

								<footer>
									{{ method_field('put') }}
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary">
										{!! $layout->label->save->title !!}
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