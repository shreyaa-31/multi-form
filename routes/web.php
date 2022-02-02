<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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





Route::get('/', [App\Http\Controllers\users\RegisterController::class, 'showForm'])->name('register');
Route::post('/step-one', [App\Http\Controllers\users\RegisterController::class, 'storeStepOne'])->name('step-one');

Route::get('/stepTwoForm', [App\Http\Controllers\users\RegisterController::class, 'stepTwoform'])->name('stepTwoForm');
Route::post('/step-two', [App\Http\Controllers\users\RegisterController::class, 'storeStepTwo'])->name('step-two');

