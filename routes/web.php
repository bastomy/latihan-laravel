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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/registrasi', 'UsersController@registrasi_post')->name('registrasi');
Route::post('/login-app', 'UsersController@login_post')->name('login_post');
Route::group(['middleware' => 'auth'], function(){
	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/add', 'HomeController@add_course')->name('add');
	Route::post('/get-data', 'HomeController@get_course')->name('get');
	Route::post('/edit', 'HomeController@edit')->name('edit');
	Route::get('/delete/{id}', 'HomeController@delete')->name('delete');
	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
});
Auth::routes();