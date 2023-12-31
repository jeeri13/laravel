<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\discountController;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    if (session()->has('email')) {
        return view('simple-ui');
    } else {
        return view('auth.login');
    }
});

Route::get('/simple-ui', [discountController::class, 'showSimpleUI'])->name('showSimpleUI');
Route::post('/process-form', [discountController::class, 'processForm'])->name('processForm');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'],'/logout', [AuthController::class, 'logout'])->name('logout');
