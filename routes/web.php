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

Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'], function () {

    Route::get('/', 'HomeController@index')->name('admin.home');

    Route::group(['prefix' => 'facilities'], function () {
        Route::get('/', 'FacilityController@index')->name('admin.facility.index');
        Route::get('/create', 'FacilityController@create')->name('admin.facility.create');
        Route::post('/', 'FacilityController@store')->name('admin.facility.store');
        Route::get('/{id}', 'FacilityController@show')->name('admin.facility.show');
        Route::post('/{id}/store-astroturf', 'FacilityController@store_astroturf')->name('admin.facility.astroturf.store');
    });

    Route::group(['prefix' => 'astroturf-services'], function () {
        Route::get('/', 'AstroturfServiceController@index')->name('admin.astroturf.services.index');
        Route::post('/', 'AstroturfServiceController@store')->name('admin.astroturf.services.store');
    });

    Route::group(['prefix' => 'astroturfs'], function () {
        Route::get('/', 'AstroturfController@index')->name('admin.astroturf.index');
        Route::get('/{id}', 'AstroturfController@show')->name('admin.astroturf.show');
        Route::patch('/{id}', 'AstroturfController@update')->name('admin.astroturf.update');
        Route::post('/{id}/calendar', 'AstroturfController@store_calendar')->name('admin.astroturf.calendar.store');
        Route::delete('/{id}/calendar', 'AstroturfController@destroy_calendar')->name('admin.astroturf.calendar.destroy');
        Route::delete('/{id}/subscribed-calendar', 'AstroturfController@destroy_subscribed_calendar')->name('admin.astroturf.subscribed-calendar.destroy');
    });

    Route::group(['prefix' => 'player-skills'], function (){
        Route::get('/', 'PlayerSkillController@index')->name('admin.player.skill.index');
        Route::post('/', 'PlayerSkillController@store')->name('admin.player.skill.store');
    });

    Route::group(['prefix' => 'players'], function (){
        Route::get('/', 'PlayerController@index')->name('admin.player.index');
        Route::get('/{id}', 'PlayerController@show')->name('admin.player.show');
    });

    Route::group(['prefix' => 'teams'], function () {
        Route::get('/', 'TeamController@index')->name('admin.team.index');
        Route::get('/{id}', 'TeamController@show')->name('admin.team.show');
    });

    Route::group(['prefix' => 'vs'], function () {
        Route::get('/', 'VSController@index')->name('admin.vs.index');
        Route::get('/{id}', 'VSController@show')->name('admin.vs.show');
    });

    /*
    Route::group(['prefix' => 'tournaments'], function () {
        Route::get('/', 'TournamentController@index');
    });
    */

    Route::group(['prefix' => 'eliminations'], function () {
        Route::get('/', 'EliminationController@index')->name('admin.elimination.index');
        Route::get('/create', 'EliminationController@create')->name('admin.elimination.create');
        Route::post('/', 'EliminationController@store')->name('admin.elimination.store');
        Route::get('/{id}', 'EliminationController@show')->name('admin.elimination.show');
        Route::get('/{id}/edit', 'EliminationController@edit')->name('admin.elimination.edit');
        Route::patch('/{id}/update', 'EliminationController@update')->name('admin.elimination.update');
        Route::delete('/{id}', 'EliminationController@destroy')->name('admin.elimination.destroy');
        Route::post('/{id}/start', 'EliminationController@start')->name('admin.elimination.start');
        Route::get('/{id}/matches', 'EliminationController@matches')->name('admin.elimination.matches');
        Route::post('/{id}/next-level', 'EliminationController@next_level')->name('admin.elimination.matches.next_level');
    });

    Route::group(['prefix' => 'elimination-matches'], function () {
        Route::patch('/{id}', 'EliminationMatchController@update_partial')->name('admin.elimination.match.update');
    });

});