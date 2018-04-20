@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->layout_item_translates->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-8">

							<form action="{{ route('layout_item_translates.index') }}" class="smart-form" method="post">

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
												Layout item <code>[ to be translated ]</code>

												@if($errors->has('item_id'))
													<div class="error-badge" id="for-item_id">
														{!! Helper::alert('danger', $errors->first('item_id')) !!}
													</div>
												@endif
											</label>
											<label class="input">
												<input type="hidden" name="item_id" value="{{ $layout_item->id }}">
												<input type="text" value="{{ $layout_item->title }}" class="input-xs font-13 border-0 border-bottom-1" readonly>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6 flexibled-error">
											<label class="label">
												Language id

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
														@if(old('language_id') ==$language['id'])
															<option value="{{ $language['id'] }}" selected>{{ $language['title'] }}</option>
														@else
															<option value="{{ $language['id'] }}">{{ $language['title'] }}</option>
														@endif
													@endforeach
												</select><i></i>
											</label>
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