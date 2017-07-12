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
        // Route::group(['prefix' => 'customer'], function()
        // {
            Route::post('/login', ['as' => 'api.login', 'uses' => 'CustomerAuthController@authenticate']);

            Route::post('/logout', ['as' => 'api.logout', 'uses' => 'CustomerAuthController@logout']);
        // });
    });

    // Registration
    Route::group(['namespace' => 'Modules\Registration\Controllers'], function()
    {
        Route::post('/register', ['as' => 'api.register', 'uses' => 'RegistrationController@register']);
    });
});