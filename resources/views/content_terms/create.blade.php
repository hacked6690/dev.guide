@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->create_content_term->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="{{ route('content_terms.index') }}" class="smart-form" method="post">

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
												Taxonomy <code>*</code>

												@if($errors->has('taxonomy'))
													<div class="error-badge" id="for-taxonomy">
														{!! Helper::alert('danger', $errors->first('taxonomy')) !!}
													</div>
												@endif
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="taxonomy">

													{!! Helper::empty_option() !!}

													@foreach($taxonomies as $taxonomy)

														@if(old('taxonomy') ==$taxonomy->taxonomy)
															<option value="{{ $taxonomy->taxonomy }}" selected>{{ $taxonomy->taxonomy }}</option>
														@else
															<option value="{{ $taxonomy->taxonomy }}">{{ $taxonomy->taxonomy }}</option>
														@endif
													@endforeach
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												<span class="txt-color-blue">
													Don't has taxonomy!
												</span>

												@if($errors->has('new_taxonomy'))
													<div class="error-badge" id="for-new_taxonomy">
														{!! Helper::alert('danger', $errors->first('new_taxonomy')) !!}
													</div>
												@endif
											</label>
											<label class="toggle txt-color-red">
												<input name="onoff" class="onoff" data-target="new_taxonomy" type="checkbox" {!! old('onoff') ? 'checked' :'' !!}>
												<i data-swchon-text="ON" data-swchoff-text="OFF"></i> Create one →
											</label>
										</section>
									</div>
									<div class="row onoff_input {!! old('onoff') ? '' :'hidden' !!}">
										<section class="col col-6 flexibled-error">
											<label class="input">
												<input type="text" {!! old('onoff') ? 'name="new_taxonomy"' :'tmp-name="new_taxonomy"' !!}
													value="{{ old('new_taxonomy') }}" class="input-sm border-0 border-bottom-1">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error atoslug-upper">
											<label class="label">
												Slug <botton class="btn btn-xs btn-primary atoslug" data-target="slug" data-slugof="term">auto</botton>

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
										<section class="col col-8 flexibled-error">
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
										<section class="col col-6 flexibled-error">
											<label class="label">
												Term group

												@if($errors->has('term_group'))
													<div class="error-badge" id="for-term_group">
														{!! Helper::alert('danger', $errors->first('term_group')) !!}
													</div>
												@endif
											</label>
											<label class="input">
												<input type="text" name="term_group" value="{{ old('term_group') }}"
													class="input-sm border-0 border-bottom-1" placeholder="#number only">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
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

													@foreach($terms as $term)

														@if(old('parent') ==$term->term_id)
															<option value="{{ $term->term_id }}" selected>{{ $term->title }}</option>
														@else
															<option value="{{ $term->term_id }}">{{ $term->title }}</option>
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
									<div class="row">
										<section class="col col-6" data-last="0">
											<label class="input">
												<a href="javascript:;" class="btn btn-link font-bold txt-color-red" id="new_meta">
													<i class="glyphicon glyphicon-share-alt"></i>
													Add meta
												</a>
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