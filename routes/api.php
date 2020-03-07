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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1', 'namespace' => 'api\v1'], function () {
    Route::post('/sign-up', 'AccountController@sign_up');
    Route::post('/sign-in', 'AccountController@sign_in');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1', 'namespace' => 'api\v1'], function () {

    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'PlayerController@me');
        Route::get('/teams', 'PlayerController@teams');
    });

    Route::group(['prefix' => 'players'], function () {
        Route::get('/', 'PlayerController@index');
        Route::get('/{id}', 'PlayerController@show');
    });

    Route::group(['prefix' => 'teams'], function () {
        Route::get('/', 'TeamController@index');
        Route::post('/', 'TeamController@store');
        Route::get('/{id}', 'TeamController@show');
    });

    Route::group(['prefix' => 'teams/{id}/members'], function () {
        Route::get('/', 'TeamMemberController@index');
        Route::post('/', 'TeamMemberController@store');
    });

});