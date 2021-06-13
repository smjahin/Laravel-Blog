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

Route::get('/','HelloController@index');

Route::get('contact/us','HelloController@contact')->name('contact');
Route::get('about/us','HelloController@about')->name('about');

//categpry

Route::get('add/category','BoloController@addCategory')->name('add.category');
Route::post('store/category','BoloController@storeCategory')->name('store.category');
Route::get('all/category','BoloController@AllCategory')->name('all.category');
Route::get('view.category/{id}','BoloController@ViewCategory');
Route::get('delete.category/{id}','BoloController@DeleteCategory');
Route::get('edit.category/{id}','BoloController@EditCategory');
Route::post('update/category/{id}','BoloController@UpdateCategory');



//post
Route::get('write/post','PostController@writePost')->name('write.post');
Route::post('store/post','PostController@storePost')->name('store.post');
Route::get('all/post','PostController@AllPost')->name('all.post');
Route::get('view.post/{id}','PostController@ViewPost');
Route::get('edit.post/{id}','PostController@EditPost');
Route::post('update.post/{id}','PostController@UpdatePost');
Route::get('delete.post/{id}','PostController@DeletePost');
