<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/', '/articles', 301);
Route::redirect('/home', '/articles', 301);
Auth::routes();

Route::get('/articles', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/articles', '\App\Http\Controllers\HomeController', ['except'=>['show']]);
Route::get('/articles/search', ['as'=>'articles.search', 'uses'=>'\App\Http\Controllers\HomeController@search']);

Auth::routes();
Route::resource('topics', '\App\Http\Controllers\TopicController');
Route::get('/topics/{topic}/assign', '\App\Http\Controllers\TopicController@assign')->name('topics.assign');
Route::get('/topics/{topic}/detach', '\App\Http\Controllers\TopicController@detach')->name('topics.detach');

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show']]);


});
