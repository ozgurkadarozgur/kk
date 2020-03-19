<?php


 Route::group(['domain' => 'saha.' . env('APP_MAIN_URL'), 'namespace' => 'Facility'], function () {
    Route::get('/', 'HomeController@index')->name('facility.home');

     Route::get('login', 'AuthController@login')->name('facility.auth.login');
     Route::post('login', 'AuthController@login_attempt')->name('facility.auth.login_attempt');
     Route::post('logout', 'AuthController@logout')->name('facility.auth.logout');

    Route::group(['prefix' => 'astroturfs'], function () {
        Route::get('/create', 'AstroturfController@create')->name('facility.astroturf.create');
        Route::get('/{id}', 'AstroturfController@show')->name('facility.astroturf.show');
        Route::patch('/{id}', 'AstroturfController@update')->name('facility.astroturf.update');
        Route::post('/{id}/calendar', 'AstroturfController@store_calendar')->name('facility.astroturf.calendar.store');
        Route::delete('/{id}/calendar', 'AstroturfController@destroy_calendar')->name('facility.astroturf.calendar.destroy');
        Route::delete('/{id}/subscribed-calendar', 'AstroturfController@destroy_subscribed_calendar')->name('facility.astroturf.subscribed-calendar.destroy');
    });

     Route::group(['prefix' => 'teams'], function () {
         Route::get('/', 'TeamController@index')->name('facility.team.index');
         Route::get('/{id}', 'TeamController@show')->name('facility.team.show');
     });

     Route::group(['prefix' => 'eliminations'], function () {
         Route::get('/', 'EliminationController@index')->name('facility.elimination.index');
         Route::get('/create', 'EliminationController@create')->name('facility.elimination.create');
         Route::post('/', 'EliminationController@store')->name('facility.elimination.store');
         Route::get('/{id}', 'EliminationController@show')->name('facility.elimination.show');
         Route::get('/{id}/edit', 'EliminationController@edit')->name('facility.elimination.edit');
         Route::patch('/{id}/update', 'EliminationController@update')->name('facility.elimination.update');
         Route::delete('/{id}', 'EliminationController@destroy')->name('facility.elimination.destroy');
         Route::post('/{id}/start', 'EliminationController@start')->name('facility.elimination.start');
         Route::get('/{id}/matches', 'EliminationController@matches')->name('facility.elimination.matches');
         Route::post('/{id}/next-level', 'EliminationController@next_level')->name('facility.elimination.matches.next_level');
     });

     Route::group(['prefix' => 'leagues'], function () {
         Route::get('/', 'LeagueController@index')->name('facility.league.index');
         Route::get('/create', 'LeagueController@create')->name('facility.league.create');
         Route::post('/', 'LeagueController@store')->name('facility.league.store');
         Route::get('/{id}', 'LeagueController@show')->name('facility.league.show');
         Route::post('/{id}/start', 'LeagueController@start')->name('facility.league.start');
         Route::get('/{id}/fixture', 'LeagueController@fixture')->name('facility.league.fixture');
     });

     Route::group(['prefix' => 'league-fixtures'], function () {
         Route::patch('/{id}', 'LeagueFixtureController@update_partial')->name('facility.league.fixture.update');
     });

});
