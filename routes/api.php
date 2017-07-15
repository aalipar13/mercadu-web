<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middlware' => 'cors'], function()
{
    // Authentication
    Route::group(['namespace' => 'Api\Customer\Auth\Controllers'], function()
    {
        Route::post('/login', ['as' => 'api.login', 'uses' => 'CustomerAuthController@login']);
        Route::post('/logout', ['as' => 'api.logout', 'uses' => 'CustomerAuthController@logout']);
    });

    // Registration
    Route::group(['namespace' => 'Modules\Registration\Controllers'], function()
    {
        Route::post('/register', ['as' => 'api.register', 'uses' => 'RegistrationController@register']);
    });

    // Product
    Route::group(['namespace' => 'Api\Product\Controllers'], function()
    {
        Route::get('/home', ['as' => 'api.home', 'uses' => 'ProductController@index']);

        Route::get('/product/{id}', ['as' => 'api.product.show', 'uses' => 'ProductController@show']);
        Route::get('/bidding-products', ['as' => 'api.bidding-products', 'uses' => 'ProductController@getAllBiddingProducts']);
    });

    // Search by Tag
    Route::group(['namespace' => 'Api\Tag\Controllers'], function()
    {
        Route::get('/tag', ['as' => 'api.tag', 'uses' => 'TagController@search']);

        Route::get('/all-tag', ['as' => 'api.all-tag', 'uses' => 'TagController@index']);
    });

    // User Account Information
    Route::group(['namespace' => 'Api\UserDetail\Controllers'], function()
    {
        Route::get('/user/account-info/{id}', ['as' => 'api.user.account-info', 'uses' => 'UserDetailController@getAccountInfoById']);
    });

    // Cart
    Route::group(['namespace' => 'Api\Cart\Controllers'], function()
    {
        Route::get('/cart/{id}', ['as' => 'api.cart.show', 'uses' => 'CartController@showCart']);
        Route::post('/cart/{id}', ['as' => 'api.cart.store', 'uses' => 'CartController@storeCart']);
        Route::delete('/cart', ['as' => 'api.cart.destroy', 'uses' => 'CartController@destroyCart']);
    });

    // Cart
    Route::group(['namespace' => 'Api\Order\Controllers'], function()
    {
        Route::post('/checkout/{user_id}', ['as' => 'api.checkout', 'uses' => 'OrderController@checkout']);
    });

});
