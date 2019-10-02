<?php
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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
});
Route::get('/admin', 'API\UserController@adminIndex');

//Product API routes
Route::apiResources([
    'products' => 'API\ProductController',
    'customers' => 'API\CostumerController',
    'roles' => 'API\RoleController',
    'users' => 'API\UserController',
    'purchased_products' => 'API\PurchasedProductController',
    'settings' => 'API\SettingsController',
    'payments' => 'API\PaymentController'
]);

Route::get('/admins', 'API\UserController@index');

Route::post('/{purchased_product}/app_details', 'API\PurchasedProductController@setAppDetails');

Route::post('/{purchased_product}/app_requirements', 'API\PurchasedProductController@setRequirements');

Route::get('/{user}/get_purchase', 'API\CostumerController@getPurchasedProducts');
