<?php

use Illuminate\Http\Request;
// use Illuminate\Routing\RouteBinding;

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

Route::post('user-create','UsersController@createUserByFactory');
Route::post('login-by-user','UsersController@loginByUser');

Route::middleware('auth:api')->group(function () {
    Route::post('classes-generate-by-faker','Admin\Api\ClassesApiController@generateClasses');
    Route::post('class-package-store-with-faker','Admin\Api\ClassPackagesApiController@classpackageGenerate');
    Route::get('class-packages-lists','Admin\Api\ClassPackagesApiController@getAllLists');
    Route::post('promocode-generate','Admin\Api\ClassPackagesApiController@promocodeGenerate');
    Route::post('order-submit','Admin\Api\ClassPackagesApiController@orderSubmit');
});