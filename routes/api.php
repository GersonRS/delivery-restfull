<?php

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
Route::namespace('API')->name('api.')->group(function () {
//  Route for register
    Route::post('register', 'UserController@store')->name('register');

//  Route group
    Route::middleware('auth:api')->group(function () {
//      Routes for address
        Route::resource('addresses', 'AddressController')
            ->except([
                'create', 'edit', 'index', 'show'
            ]);
        Route::get('addresses/{relationships?}', 'AddressController@index')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('addresses.index');
        Route::get('addresses/{id}/{relationships?}', 'AddressController@show')
            ->where(['id' => '[0-9]+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('addresses.show');

//      Routes for categories
        Route::resource('categories', 'CategoryController')
            ->except([
                'create', 'edit', 'index', 'show'
            ]);
        Route::get('categories/{relationships?}', 'CategoryController@index')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('categories.index');
        Route::get('categories/{id}/{relationships?}', 'CategoryController@show')
            ->where(['id' => '[0-9]+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('categories.show');

//      Routes for establishments
        Route::resource('establishments', 'EstablishmentController')
            ->except([
                'create', 'edit', 'show'
            ]);
        Route::get('establishments/paginate/{relationships?}', 'EstablishmentController@paginate')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('establishments.paginate');
//        Route::get('establishments/{relationships?}', 'EstablishmentController@index')
//            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
//            ->name('establishments.index');
        Route::get('establishments/{id}/{relationships?}', 'EstablishmentController@show')
            ->where(['id' => '[0-9]+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('establishments.show');
        Route::get('establishments/paginate/{ordenation}', 'EstablishmentController@ordenation')
            ->where('ordenation', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('establishments.ordenation');


//      Routes for orders
        Route::resource('orders', 'OrderController')
            ->except([
                'create', 'edit', 'index', 'show'
            ]);
        Route::get('orders/{relationships?}', 'OrderController@index')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('orders.index');
        Route::get('orders/{id}/{relationships?}', 'OrderController@show')
            ->where(['id' => '[0-9]+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('orders.show');

//      Routes for products
        Route::resource('products', 'ProductController')
            ->except([
                'create', 'edit', 'index', 'show'
            ]);
        Route::get('products/{relationships?}', 'ProductController@index')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('products.index');
        Route::get('products/{id}/{relationships?}', 'ProductController@show')
            ->where(['id' => '[0-9]+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('products.show');

//      Routes for users
        Route::resource('users', 'UserController')
            ->except([
                'create', 'edit', 'index', 'show', 'store'
            ]);
        Route::get('users/{relationships?}', 'UserController@index')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('users.index');
        Route::get('users/{id}/{relationships?}', 'UserController@show')
            ->where(['id' => '[0-9]+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('users.show');
        Route::get('user/current/{relationships?}', 'UserController@current')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('user.current');

//      Routes for promotions
        Route::get('promotions', 'ProductController@promotions')
            ->name('promotions');

//      Routes for specialties
        Route::apiResource('specialties', 'SpecialtyController')
            ->except([
                'index', 'store', 'show'
            ]);
        Route::get('specialties/{id}/{relationships?}', 'SpecialtyController@show')
            ->where(['id' => '^\d+', 'relationships' => '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*'])
            ->name('specialties.show');
        Route::get('specialties/{relationships?}', 'SpecialtyController@index')
            ->where('relationships', '^\w+((?:(?:\-)?)|(?:(?:\.)?)\w+)*')
            ->name('specialties.index');
    });

});
