<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function () {
    # Login Routes
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@attemptLogin')->name('attemptLogin');
    Route::post('logout',   'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/dashboard',                   'DashboardController@showDashboard')->name('dashboard');

    
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/',                           'CategoryController@index')->name('categories');
        Route::post('/store',                           'CategoryController@store')->name('store');
        Route::post('/edit',                           'CategoryController@edit')->name('edit');
        Route::post('/update',                           'CategoryController@update')->name('update');
        Route::post('/delete',                           'CategoryController@delete')->name('delete');

    });

    Route::group(['prefix' => 'skill', 'as' => 'skill.'], function () {
        Route::get('/',                           'SkillController@index')->name('skills');
        Route::post('/store',                           'SkillController@store')->name('store');
        Route::post('/edit',                           'SkillController@edit')->name('edit');
        Route::post('/update',                           'SkillController@update')->name('update');
        Route::post('/delete',                           'SkillController@delete')->name('delete');

    });
});