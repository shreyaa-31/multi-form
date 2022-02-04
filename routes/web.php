<?php

use Illuminate\Support\Facades\Route;


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


Route::get('/', [App\Http\Controllers\users\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/attemptLogin', [App\Http\Controllers\users\LoginController::class, 'attemptLogin'])->name('attemptLogin');

Route::get('/dashboard', [App\Http\Controllers\users\DashboardController::class, 'showdashboard'])->name('dashboard');

Route::get('/register', [App\Http\Controllers\users\RegisterController::class, 'stepOneForm'])->name('stepOneForm');
Route::post('/step-one', [App\Http\Controllers\users\RegisterController::class, 'storeStepOne'])->name('step-one');

Route::get('/stepTwoForm', [App\Http\Controllers\users\RegisterController::class, 'stepTwoform'])->name('stepTwoForm');
Route::post('/step-two', [App\Http\Controllers\users\RegisterController::class, 'storeStepTwo'])->name('step-two');

Route::get('/stepThreeForm', [App\Http\Controllers\users\RegisterController::class, 'stepThreeform'])->name('stepThreeForm');
Route::post('/step-three', [App\Http\Controllers\users\RegisterController::class, 'storeStepThree'])->name('step-three');

Route::get('/stepFourForm', [App\Http\Controllers\users\RegisterController::class, 'stepFourForm'])->name('stepFourForm');
Route::post('/step-four', [App\Http\Controllers\users\RegisterController::class, 'storeStepFour'])->name('step-four');

// Route::get('/backToPage', [App\Http\Controllers\users\RegisterController::class, 'backToPage'])->name('backToPage');
