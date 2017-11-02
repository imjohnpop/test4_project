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

Route::get('/', 'indexController@index');

Route::get('/books', 'BooksController@list')->middleware('auth');
Route::post('/books', 'BooksController@store');

Route::get('/authors', 'AuthorsController@list')->middleware('auth');
Route::post('/authors', 'AuthorsController@store');


Auth::routes();

Route::get('/homepage', function () {
    return redirect('/');
});
Route::get('/home', function () {
    return redirect('/');
});
