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
    return view('index');
});

Route::get('/usuarios', 'UserController@index')->name('users.index');

Route::prefix('/categorias')->group(function () {

    Route::get('/', 'CategoryController@index')->name('categories');

    Route::get('/nueva', 'CategoryController@create')->name('categories.create');

    Route::post('/nueva', 'CategoryController@store')->name('categories.create');

    Route::get('/{category}/editar', 'CategoryController@edit')->name('categories.edit');

    Route::put('/{category}/editar', 'CategoryController@update')->name('categories.edit');
});
