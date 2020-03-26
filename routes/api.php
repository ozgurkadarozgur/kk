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

Route::group(['domain' => 'api.'.env('APP_MAIN_URL'), 'middleware' => 'api', 'prefix' => 'v1', 'namespace' => 'api\v1'], function () {
    Route::post('/sign-up', 'AccountController@sign_up');
    Route::post('/sign-up-validate-1', 'AccountController@sign_up_validate_1');
    Route::post('/sign-up-validate-2', 'AccountController@sign_up_validate_2');

    Route::post('/forgot-password', 'AccountController@forgot_password');

    Route::post('/sign-in', 'AccountController@sign_in');

    Route::get('/cities', 'CityController@index');
    Route::get('/cities/{id}/districts', 'CityController@districts');
    Route::get('/player-skills', 'PlayerSkillController@index');
    Route::get('/player-positions', 'PlayerPositionController@index');
});

Route::group(['domain' => 'api.'.env('APP_MAIN_URL'), 'middleware' => 'auth:api', 'prefix' => 'v1', 'namespace' => 'api\v1'], function () {

    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'PlayerController@me');
        Route::post('/verify-phone', 'AccountController@verify_phone');
        Route::get('/teams', 'PlayerController@teams');
        Route::get('/incoming-vs-requests', 'PlayerController@incoming_vs_requests');
        Route::get('/outgoing-vs-requests', 'PlayerController@outgoing_vs_requests');
    });

    Route::group(['prefix' => 'players'], function () {
        Route::get('/', 'PlayerController@index');
        Route::get('/{id}', 'PlayerController@show');
    });

    Route::group(['prefix' => 'teams'], function () {
        Route::get('/', 'TeamController@index');
        Route::post('/', 'TeamController@store');
        Route::get('/{id}', 'TeamController@show');
        Route::delete('/{id}', 'TeamController@destroy');
        Route::post('/{id}/set-image', 'TeamController@set_image');
    });

    Route::group(['prefix' => 'teams/{id}/members'], function () {
        Route::get('/', 'TeamMemberController@index');
        Route::post('/', 'TeamMemberController@store');
    });

    Route::delete('/team-members/{id}', 'TeamMemberController@destroy');

    Route::group(['prefix' => 'astroturfs'], function () {
        Route::get('/', 'AstroturfController@index');
        Route::get('/{id}', 'AstroturfController@show');
        Route::post('/{id}/reservations', 'PlayerAstroturfReservationController@store');
        Route::get('/{id}/reservations/{date}', 'AstroturfController@reservations');
    });

    Route::group(['prefix' => 'vs'], function () {
        Route::post('/', 'VSController@vs_request');
        Route::post('/{id}/invited-approve', 'VSController@invited_approve');
        Route::post('/{id}/invited-reject', 'VSController@invited_reject');
        Route::post('/{id}/inviter-approve', 'VSController@inviter_approve');
        Route::post('/{id}/inviter-cancel', 'VSController@inviter_cancel');
    });

    Route::group(['prefix' => 'eliminations'], function () {
        Route::get('/', 'EliminationController@index');
        Route::post('/{id}/apply', 'EliminationController@apply');
        Route::get('/{id}', 'EliminationController@show');
    });

    Route::group(['prefix' => 'leagues'], function () {
        Route::get('/', 'LeagueController@index');
        Route::post('/{id}/apply', 'LeagueController@apply');
        Route::get('/{id}', 'LeagueController@show');
    });

});