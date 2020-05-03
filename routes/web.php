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

Route::get('/','WelcomeController@index')->name('welcome');




Auth::routes();
Route::get('blogpost/{post}/show','PostsController@show')->name('blog.show');


Route::middleware(['auth'])->group(function(){


Route::get('blogcate/{category}','PostsController@category')->name('category');
Route::get('blogtag/{tag}','PostsController@tag')->name('tag');

  Route::get('/home', 'HomeController@index')->name('home');
  Route::resource('categories','CategoryController');
  Route::resource('posts','PostController');
  Route::get('trashed.posts','PostController@trashed')->name('trashed.posts');
  Route::get('trashed.categories','CategoryController@trashed')->name('trashed.categories');
  Route::put('restored.posts/{post}','PostController@restored')->name('restored.posts');
  Route::resource('tags','TagController');
  Route::get('trashed.tags','TagController@trashed')->name('trashed.tags');
  Route::get('user.Profile','UserController@profile')->name('user.profile');
Route::get('user.edit','UserController@edit')->name('user.edit');
Route::put('user.update','UserController@updateprofile')->name('user.update');
Route::put('restore/{tag}','TagController@restore')->name('restored.tags');

});

Route::middleware(['auth','admin'])->group(function(){
  Route::get('users','UserController@index')->name('users.index');
  Route::put('users/{user}/update','UserController@update')->name('users.update');
});
