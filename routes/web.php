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
    return redirect()->route('login');
});
Auth::routes();


Route::group(['prefix' => 'dashboard','middleware' => ['auth','prevent-back-history']], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::resource('sites','SitesController');
});