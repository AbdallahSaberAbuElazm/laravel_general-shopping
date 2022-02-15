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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//TODO:test code
Route::get('/',function(){
    return view('welcome');
});

//units
Route::get('/units' , 'UnitController@index')->name('units');
Route::post('/units','UnitController@store');
Route::delete('/units','UnitController@delete');
Route::put('/units','UnitController@update');
Route::post('/search-units','UnitController@search')->name('search-units');

//tags
Route::get('/tags','TagController@index')->name('tags');
Route::post('/tags','TagController@store');
Route::put('/units','TagController@update');
Route::delete('/delete','TagController@delete');
Route::post('/search-tags','TagController@search')->name('search-tags');

//products
Route::get('/products','ProductController@index')->name('products');
Route::post('/products','ProductController@store');
Route::get('/new-product/{id?}','ProductController@newProduct')->name('new-product');
Route::put('/update-product','ProductController@update')->name('update-product');

Route::middleware(['auth', 'user_is_admin'])->group(function () {

//   //units
//   Route::get('/units' , 'UnitController@index')->name('units');
//   Route::post('/units','UnitController@store');
//   Route::delete('/units','UnitController@delete');
//   Route::put('/units','UnitController@update');
//   Route::post('/search-units','UnitController@search')->name('search-units');

  //products
//   Route::get('/products','ProductController@index')->name('products');
  //Categories
  Route::get('/categories','CategoryController@index')->name('categories');
  //tags
//   Route::get('/tags','TagController@index')->name('tags');
  //countries
  Route::get('/countries','CountryController@index')->name('countries');
  //governorates
  Route::get('/governorates','GovernorateController@index')->name('governorates');
  //cities
  Route::get('/cities','CityController@index')->name('cities');
  //reviews
  Route::get('/reviews','ReviewController@index')->name('reviews');
  //Orders
  Route::get('/orders','OrderController@index')->name('orders');
  //shipments
  Route::get('/shipments','ShipmentController@index')->name('shipments');
  //roles
  Route::get('/roles','RoleController@index')->name('roles');
  //payments
  Route::get('/payments','PaymentController@index')->name('payments');
  //users
  Route::get('/users','UserController@index')->name('users');
  //tickets
  Route::get('/tickets','TicketController@index')->name('tickets');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
