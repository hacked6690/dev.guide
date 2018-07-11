<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('test','frontend\GuidesController@test');

Route::get('dashboard', ['uses' => 'DashboardController@index']);

Route::resource('posts', 'PostsController');
Route::resource('pages', 'PagesController');

Route::resource('content_terms', 'ContentTermsController', ['except' => ['show']]);

Route::get('languages/{id}/set', ['as' => 'languages.set', 'uses' => 'LanguagesController@set']);
Route::resource('languages', 'LanguagesController', ['except' => ['show']]);

Route::resource('layout_categories', 'LayoutCategoriesController', ['except' => ['show']]);

Route::resource('layout_items', 'LayoutItemsController', ['except' => ['show']]);

Route::get('layout_item_translates/create/{encrypted_id}', ['as' => 'layout_item_translates.create', 'uses' => 'LayoutItemTranslatesController@create']);
Route::resource('layout_item_translates', 'LayoutItemTranslatesController', ['except' => ['create', 'show', 'edit', 'update', 'destroy']]);

Route::resource('user_roles', 'UserRolesController', ['except' => ['show']]);

Route::get('user_privileges/create/{encrypted_id}', ['as' => 'user_privileges.create', 'uses' => 'UserPrivilegesController@create']);
Route::resource('user_privileges', 'UserPrivilegesController', ['except' => ['create', 'show', 'edit', 'destroy']]);

Route::resource('profiles', 'ProfilesController', ['only' => ['edit', 'update']]);

Route::resource('user_accounts', 'UserAccountsController', ['except' => ['show']]);

Route::resource('user_metas', 'UserMetasController', ['except' => ['index', 'create', 'show', 'edit', 'update', 'destroy']]);

Route::resource('user_passwords', 'UserPasswordsController', ['only' => ['update']]);

Route::resource('privileges', 'PrivilegesController', ['except' => ['show']]);

Route::get('home',function(){ return view('home.index');});

// Static Ajax routes ;
Route::prefix('ajax')->group(function () {
	Route::post('of_taxonomy', ['as' => 'ajax.of_taxonomy', 'uses' => 'AjaxController@of_taxonomy']);
	Route::post('realtime_upload', ['as' => 'ajax.realtime_upload', 'uses' => 'AjaxController@realtime_upload']);
});


Route::resource('guides', 'frontend\GuidesController');
Route::resource('travellers', 'frontend\TravellersController');
Route::resource('guideprice', 'backend\GuidePriceController');
Route::resource('bookings', 'backend\CalendarsBooking');
Route::get('booking_history', 'backend\CalendarsBooking@booking_history');
Route::get('event_history', 'backend\CalendarsBooking@event_history');
Route::get('calendardetail/{id}', 'backend\CalendarsBooking@detail');
Route::post('ajax/bookings', 'backend\CalendarsBooking@ajx_store');
Route::post('ajax/dbooking', 'backend\CalendarsBooking@ajx_delete');//dbooking is delete booking
Route::get('events/{guide_id}','backend\CalendarsBooking@events');
	
Route::post('ajax/edit_booking', 'backend\CalendarsBooking@ajx_edit');
Route::resource('guidepricedetail', 'backend\GuidePriceDetailController');
Route::post('ajax/guideprice', 'backend\GuidePriceController@ajx_store');
Route::get(' guides/detail/{id}','frontend\GuidesController@detail');
Route::resource('homepage', 'frontend\HomeController');


