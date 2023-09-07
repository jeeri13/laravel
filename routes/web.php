<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('simple-ui');
});

// Route::get('/simple-ui', 'discountController@showSimpleUI')->name('showSimpleUI');
Route::post('/process-form', 'discountController@processForm')->name('processForm');

