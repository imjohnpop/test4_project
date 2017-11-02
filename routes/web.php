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
Route::post('/books/{id}', 'BooksController@edit');
Route::get('/books/{id}', 'BooksController@destroy');

Route::get('/authors', 'AuthorsController@list')->middleware('auth');
Route::post('/authors', 'AuthorsController@store');
Route::post('/authors/{id}', 'AuthorsController@edit');
Route::get('/authors/{id}', 'AuthorsController@destroy');


Auth::routes();

Route::get('/homepage', function () {
    return redirect('/');
});
Route::get('/home', function () {
    return redirect('/');
});
