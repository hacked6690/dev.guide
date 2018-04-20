@extends('layouts.admin.master')

@section('content')
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					{{ $layout->menu->create_user_privilege->title }}
				</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="well well-sm">

					<div class="row">
						<div class="col-md-12 col-lg-12">

							<form action="{{ route('user_privileges.index') }}" class="smart-form custom-sf" method="post">

								<fieldset>

									<div class="row">
										@if(Session::has('updated'))
											<section class="col col-8">
												{!! Helper::alert('success', Session::get('updated'), 'block font-15') !!}
											</section>
										@endif
									</div>

									<div class="row">
										<section class="col col-8 flexibled-error">
											<label class="label">
												<div class="font-18">
													<i class="fa fa-bolt"></i> Privileges for role &mdash; <code>{{ $user_role->title }}</code>
												</div>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-8 flexibled-error">
											<label class="label">Choose user privileges for this user role</label>
											<div class="note">
												<strong>Maxlength</strong> is automatically added via the "maxlength='#'" attribute
											</div>
										</section>
									</div>
									<div class="row">
										@if($errors->has('privileges'))
											<section class="col col-8 flexibled-error">
												{!! Helper::alert('danger', $errors->first('privileges')) !!}
											</section>
										@endif
									</div>

								</fieldset>
								<fieldset>

									@foreach($privileges as $key => $privilege)

										<div class="row">
											<section class="col col-4 flexibled-error">
												<label class="toggle">
													<input name="privileges[]" type="checkbox" class="parent-privilege"
														value="{{ $privilege->id }}" {!! in_array($privilege->id, $user_privileges) ? 'checked="true"' :'' !!} />
													<i data-swchon-text="ON" data-swchoff-text="OFF"></i>
													# <span class="font-13 font-bold txt-color-blue">{{ $privilege->title }}</span>
												</label>
												<div class="ofprivilege" data-parent="{{ $privilege->id }}">
													<button class="btn btn-xs btn-default font-9 _ js178">/Crud/</button>
												</div>
											</section>
										</div>

										@if(property_exists($arr_chld, $privilege->id))

											<div class="child-privileges hidden" id="chldof-{{ $privilege->id }}">

												@foreach($arr_chld->{$privilege->id} as $key => $chld)

													<div class="row margin-bottom-0">
														<section class="col col-4 flexibled-error">
															<label class="toggle">
																<input name="privileges[]" type="checkbox"
																	value="{{ $chld->id }}" {!! in_array($chld->id, $user_privileges) ? 'checked="true"' :'' !!} />
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>
																<span class="font-12">&nbsp;&nbsp; &mdash; {{ $chld->title }}</span>
															</label>
														</section>
													</div>

												@endforeach

											</div>

										@endif

									@endforeach

								</fieldset>

								<footer>
									{{ csrf_field() }}
									<input type="hidden" name="_role" value="{{ encrypt($user_role->id) }}">
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