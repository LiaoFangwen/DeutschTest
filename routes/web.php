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

Route::get('/home', 'HomeController@showChart')->name('home');
Route::get('/test', 'TestController@index');
Route::get('test/{id}', 'TestController@showTest');
Route::get('/userRecord', 'UserRecordController@showRecord');
Route::post('test/testResult/{id}', 'TestController@showResult');

    Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'Admin\LoginController@login');
    Route::get('admin/register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('admin/register', 'Admin\RegisterController@register');
    Route::post('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('admin/adminFunction', 'AdminController@showAdminFunction');
    Route::get('admin', 'AdminController@index')->name('admin.home');

    Route::get('admin/adminEditTest', 'AdminController@showTestCatalog');
    Route::get('admin/editTestContent/{id}', 'AdminController@editTestContent');
    Route::post('admin/editTestOptions/{id}', 'AdminController@editTestOptions');
    Route::post('admin/saveTestEdit/{id}', 'AdminController@saveTestEdit');

