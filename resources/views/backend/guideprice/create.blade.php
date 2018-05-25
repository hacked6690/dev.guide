@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->gp->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="{{ route('guideprice.index') }}" class="smart-form" method="post">
							{{csrf_field()}}
								<fieldset>

									<div class="row">
										@if(Session::has('inserted'))
											<section class="col col-6">
												{!! Helper::alert('success', Session::get('inserted'), 'block font-15') !!}
											</section>
										@endif
										@if(Session::has('warning'))
											<section class="col col-6">
												{!! Helper::alert('warning', Session::get('warning'), 'block font-15') !!}
											</section>
										@endif
									</div>

									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												{{$layout->label->language->title}} <code>*</code>

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
														@if(old('language_id') ==$language->term_id)
															<option value="{{ $language->term_id }}" selected>{{ $language->title }}</option>
														@else
															<option value="{{ $language->term_id }}">{{ $language->title }}</option>
														@endif
													@endforeach
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												{{$layout->label->province->title}} <code>*</code>

												@if($errors->has('province_id'))
													<div class="error-badge" id="for-province_id">
														{!! Helper::alert('danger', $errors->first('province_id')) !!}
													</div>
												@endif
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="province_id">

													{!! Helper::empty_option() !!}

													@foreach($provinces as $province)
														@if(old('province_id') ==$province->term_id)
															<option value="{{ $province->term_id }}" selected>{{ $province->title }}</option>
														@else
															<option value="{{ $province->term_id }}">{{ $province->title }}</option>
														@endif
													@endforeach
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												{{$layout->label->set_default->title}} <code>*</code>

												@if($errors->has('boolean_id'))
													<div class="error-badge" id="for-boolean_id">
														{!! Helper::alert('danger', $errors->first('boolean_id')) !!}
													</div>
												@endif
											</label>
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="boolean_id">

													{!! Helper::empty_option() !!}

													@foreach($booleans as $boolean)
														@if(old('boolean_id') ==$boolean->term_id)
															<option value="{{ $boolean->title }}" selected>{{ $boolean->title }}</option>
														@else
															<option value="{{ $boolean->title }}">{{ $boolean->title }}</option>
														@endif
													@endforeach
												</select><i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												{{$layout->label->guide_price->title}} <code>*{{$layout->label->usd->title}} <code>*</code></code>

												@if($errors->has('price'))
													<div class="error-badge" id="for-slug">
														{!! Helper::alert('danger', $errors->first('price')) !!}
													</div>
												@endif
											</label>
											<label class="input">
												<input type="text" name="price" value="{{ old('price') }}" class="input-sm border-0 border-bottom-1">
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