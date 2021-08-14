<?php

use App\Facade\BaseResponse;
use Illuminate\Http\JsonResponse;
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

Route::get('', function(): JsonResponse {
    return BaseResponse::ok(new DateTime('now'), env('APP_NAME'), 200);
});

Route::group(['prefix' => 'uma'], function() {

    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', 'Api\AuthenticationController@login');
        Route::get('me', 'Api\AuthenticationController@me');
    });

    Route::group(['prefix' => 'user'], function() {
        Route::post('', 'Api\UserController@register');
        Route::post('otp', 'Api\UserController@inputOTP');
    });


});
