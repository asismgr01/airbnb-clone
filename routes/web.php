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
#forntend routes#
Route::get('/','FrontendController@index')->name('gethome');
Route::get('/product','FrontendController@product')->name('product');
Route::get('/product-detail/{hotel}','FrontendController@product_detail')->name('product_detail');
Route::get('/product-list','FrontendController@product_list')->name('product_list');
Route::get('/about','FrontendController@about')->name('about');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::get('/shopping-cart','FrontendController@shoping_cart')->name('shoping_cart');
Route::post('/cart/add','CartController@postcart')->name('cartadd');
Route::get('/cart/remove','CartController@cartremove')->name('cartremove');
Route::get('/checkout','CartController@checkout')->name('checkout')->middleware(['auth','user']);
Route::get('/search','HotelController@getsearch')->name('search');
Route::get('/wishlist','FrontendController@wishlist')->name('wishlist');
Route::get('/signup','FrontendController@register')->name('signup');
Route::post('/register-user','UserController@register_user')->name('register-user');
Route::get('/active/{token}','UserController@activate_user')->name('activate-user');
Route::resource('/hotelreview','HotelReviewController');
Route::get('/hotels','FrontendController@hotels')->name('hotels');
Route::get('/experiences','FrontendController@experiences')->name('experiences');
Route::get('experiences_detail/{id}','FrontendController@experiences_detail')->name('experiences_detail');
Route::resource('/activityreview','ActivityReviewController');
Route::get('/load-hotels','FrontendController@load_hotels')->name('load_hotels');
Route::get('/load-experiences','FrontendController@load_experiences')->name('load_experiences');
/*=======================================================================================*/
/*ajax call*/
Route::post('/hotel/rooms','FrontendController@show')->name('hotel-rooms');
Route::post('/ajaxcall','FrontendController@ajaxcall')->name('ajaxcall');
/*=======================================================================================*/
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
	Route::get('/','HomeController@admin')->name('admin');	
	Route::resource('city','CityController');
	Route::resource('activitycategory','ActivityCategoryController');
	Route::resource('vendor','VendorController');
	/*Route::get('activities/{role}','ActivitiesController@index')->name('activities.index');*/
	Route::resource('adminactivity','AdminActivityController');
	Route::resource('adminhotel','AdminHotelController');
	Route::resource('adminroom','AdminRoomController');
	Route::resource('adminuser','AdminUserController');
	Route::resource('banner','BannerController');
	Route::resource('hotelreview','HotelReviewController');
	Route::resource('roombooking','RoomBookingController');
});
Route::group(['prefix'=>'vendor','middleware'=>['auth','vendor']],function(){
	Route::get('/','HomeController@vendor')->name('vendor');
	Route::get('/view','HotelController@view')->name('view');
	Route::resource('hotel','HotelController');
	Route::resource('room','RoomController');
	Route::resource('activities','ActivitiesController');
	Route::resource('vendororder','VendorOrderController');
	Route::get('/display','ActivitiesController@display')->name('display');
	Route::post('/ajax','RoomController@ajax')->name('ajax');
});
Route::group(['prefix'=>'user','middleware'=>['auth','user']],function(){
	Route::get('/','HomeController@users')->name('users');
	Route::resource('userorder','UserOrderController');
	Route::get('/cancel','UserOrderController@cancel')->name('cancel');
});

Auth::routes();
Route::get('/register',function(){
    return redirect()->route('login');
})->name('register');

Route::get('/home', 'HomeController@index')->name('home');
