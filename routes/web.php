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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//admin routes
Route::group(['prefix' => '/dashboard/admin-panel', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('series', 'SeriesController');
    Route::resource('episodes', 'EpisodeController');
    Route::resource('users', 'UserController')->only('index');
});

//user routes
Route::group(['prefix'=>'/user','middleware' =>['auth']],function () {
    Route::get('/home', 'HomeController@index')->name('user-home');
    Route::get('/search','HomeController@search');
    Route::get('/random-series', 'HomeController@random_series');
    Route::get('view/series/{id}', 'SeriesController@view');
    Route::get('/episode/{id}/like','UserController@like');
    Route::get('/episode/{id}/dislike','UserController@dislike');
    Route::get('/series/{id}/follow','UserController@follow');
    Route::get('/series/{id}/unfollow','UserController@unfollow');
});
