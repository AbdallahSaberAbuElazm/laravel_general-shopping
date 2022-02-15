<?php

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Get Categories
Route::get('categories','Api\CategoryController@index');
Route::get('categories/{id}','Api\CategoryController@show');
//Get Tags
Route::get('tags','Api\TagController@index');
Route::get('tags/{id}','Api\TagController@show');
//Get Products
Route::get('products','Api\ProductController@index');
Route::get('products/{id}','Api\ProductController@show');

//General routes
Route::get('countries','Api\CountryController@index');
Route::get('countries/{id}/governorates','Api\CountryController@showGovernorates');
Route::get('countries/{id}/cities','Api\CountryController@showCities');

Route::post('auth/register','Api\AuthController@register');
Route::post('auth/login','Api\AuthController@login');


Route::middleware(['auth:api'])->group(function () {

});
