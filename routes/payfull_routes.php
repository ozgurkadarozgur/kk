<?php

Route::group(['domain' => 'payment.' . env('APP_MAIN_URL'), 'namespace' => 'Payment'], function () {
    Route::post('/payfull-response', 'PayfullController@handle_response')->name('payment.payfull.handle_response');
});