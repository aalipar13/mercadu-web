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

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::group(['prefix' => 'admin'], function()
{
	// Auth
    Route::group(['namespace' => 'Http\Controllers\Admin\Auth\Controllers'], function()
    {
        Route::get('/login', ['as' => 'admin.login', 'uses' => 'AdminAuthController@showLoginForm', 'middleware' => 'admin.auth']);

        Route::post('/login', ['as' => 'admin.login', 'uses' => 'AdminAuthController@login']);

        Route::post('/logout', ['as' => 'admin.logout', 'uses' => 'AdminAuthController@logout']);

        Route::get('/home', ['as' => 'admin.home', 'uses' => 'AdminAuthController@home', 'middleware' => 'admin.unauth']);
        
    });

	// Category
    Route::group(['prefix' => 'category'], function()
    {
        Route::group(['namespace' => 'Modules\ArkCommerce\Category\Controllers'], function()
        {

            // Route::resource('/category', 'CategoryController');

            Route::get('/index', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);

            Route::get('/show/{id}', ['as' => 'admin.category.show', 'uses' => 'CategoryController@show']);

            Route::get('/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);

            Route::get('/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);

            Route::post('/save', ['as' => 'admin.category.save', 'uses' => 'CategoryController@save']);

            Route::put('/revise/{id}', ['as' => 'admin.category.revise', 'uses' => 'CategoryController@revise']);

            Route::delete('/destroy/{id}', ['as' => 'admin.category.destroy', 'uses' => 'CategoryController@destroy']);

        });
    });

    // Stores
    Route::group(['prefix' => 'store'], function()
    {
        Route::group(['namespace' => 'Modules\ArkCommerce\Store\Controllers'], function()
        {

            // Route::resource('/store', 'StoreController');
            Route::get('/index', ['as' => 'admin.store.index', 'uses' => 'StoreController@index']);

            Route::get('/show/{id}', ['as' => 'admin.store.show', 'uses' => 'StoreController@show']);

            Route::get('/edit/{id}', ['as' => 'admin.store.edit', 'uses' => 'StoreController@edit']);

            Route::get('/create', ['as' => 'admin.store.create', 'uses' => 'StoreController@create']);

            Route::post('/save', ['as' => 'admin.store.save', 'uses' => 'StoreController@save']);

            Route::put('/revise/{id}', ['as' => 'admin.store.revise', 'uses' => 'StoreController@revise']);

            Route::delete('/destroy/{id}', ['as' => 'admin.store.destroy', 'uses' => 'StoreController@destroy']);
            
        });

    });

    // Store Photos
    Route::group(['prefix' => 'store-photo'], function()
    {
        Route::group(['namespace' => 'Modules\ArkCommerce\StorePhoto\Controllers'], function()
        {
            Route::post('/save/{id}', ['as' => 'admin.store-photo.save', 'uses' => 'StorePhotoController@save']);

            Route::get('/photos/{id}', ['as' => 'admin.store-photo.photos', 'uses' => 'StorePhotoController@photos']);

            Route::put('/revise/{id}', ['as' => 'admin.store-photo.revise', 'uses' => 'StorePhotoController@revise']);

            Route::delete('/destroy/{id}', ['as' => 'admin.store-photo.destroy', 'uses' => 'StorePhotoController@destroy']);

        });
    });

    // Tag
    Route::group(['prefix' => 'tag'], function()
    {
        Route::group(['namespace' => 'Modules\ArkCommerce\Tag\Controllers'], function()
        {

            // Route::resource('/tag', 'TagController');

            Route::get('/index', ['as' => 'admin.tag.index', 'uses' => 'TagController@index']);

            Route::get('/show/{id}', ['as' => 'admin.tag.show', 'uses' => 'TagController@show']);

            Route::get('/edit/{id}', ['as' => 'admin.tag.edit', 'uses' => 'TagController@edit']);

            Route::get('/create', ['as' => 'admin.tag.create', 'uses' => 'TagController@create']);

            Route::post('/save', ['as' => 'admin.tag.save', 'uses' => 'TagController@save']);

            Route::put('/revise/{id}', ['as' => 'admin.tag.revise', 'uses' => 'TagController@revise']);

            Route::delete('/destroy/{id}', ['as' => 'admin.tag.destroy', 'uses' => 'TagController@destroy']);

        });
    });

    // Tag Mapping
    Route::group(['prefix' => 'tag-mapping'], function()
    {
        Route::group(['namespace' => 'Modules\ArkCommerce\TagMapping\Controllers'], function()
        {

            // Route::resource('/tag-mapping', 'TagMappingController');

            Route::get('/index', ['as' => 'admin.tag-mapping.index', 'uses' => 'TagMappingController@index']);

            Route::get('/show/{id}', ['as' => 'admin.tag-mapping.show', 'uses' => 'TagMappingController@show']);

            Route::get('/edit/{id}', ['as' => 'admin.tag-mapping.edit', 'uses' => 'TagMappingController@edit']);

            Route::get('/create', ['as' => 'admin.tag-mapping.create', 'uses' => 'TagMappingController@create']);

            Route::post('/save', ['as' => 'admin.tag-mapping.save', 'uses' => 'TagMappingController@save']);

            Route::put('/revise/{id}', ['as' => 'admin.tag-mapping.revise', 'uses' => 'TagMappingController@revise']);

            Route::delete('/destroy/{id}', ['as' => 'admin.tag-mapping.destroy', 'uses' => 'TagMappingController@destroy']);

            Route::get('/fetchTags/{storeId}', ['as' => 'admin.tag-mapping.fetch-tags', 'uses' => 'TagMappingController@fetchTags']);

            Route::get('/fetchProducts/{storeId}', ['as' => 'admin.tag-mapping.fetch-products', 'uses' => 'TagMappingController@fetchProducts']);

        });
    });

    // Product
    Route::group(['prefix' => 'product'], function()
    {
        Route::group(['namespace' => 'Modules\ArkCommerce\Product\Controllers'], function()
        {

            // Route::resource('/product', 'CategoryController');

            Route::get('/index', ['as' => 'admin.product.index', 'uses' => 'ProductController@index']);

            Route::get('/show/{id}', ['as' => 'admin.product.show', 'uses' => 'ProductController@show']);

            Route::get('/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'ProductController@edit']);

            Route::get('/create', ['as' => 'admin.product.create', 'uses' => 'ProductController@create']);

            Route::post('/save', ['as' => 'admin.product.save', 'uses' => 'ProductController@save']);

            Route::put('/revise/{id}', ['as' => 'admin.product.revise', 'uses' => 'ProductController@revise']);

            Route::delete('/destroy/{id}', ['as' => 'admin.product.destroy', 'uses' => 'ProductController@destroy']);

        });
    });
});
