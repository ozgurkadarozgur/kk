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
    });

    Route::group(['prefix' => 'player-skills'], function (){
        Route::get('/', 'PlayerSkillController@index')->name('admin.player.skill.index');
        Route::post('/', 'PlayerSkillController@store')->name('admin.player.skill.store');
    });

    Route::group(['prefix' => 'players'], function (){
        Route::get('/', 'PlayerController@index')->name('admin.player.index');
    });

});