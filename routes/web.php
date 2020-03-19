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

Route::prefix('/usuarios')->group(function () {
    Route::get('/', 'UserController@index')->name('users.index'); //Ruta listado

    Route::get('/nuevo', 'UserController@create') //Ruta de la página para crear el usuario
        ->name('users.create');

    Route::post('/crear', 'UserController@store'); //Ruta para realizar la creación del usuario

    Route::get('/{user}/editar', 'UserController@edit') //Ruta de la página para editar el usuario
        ->name('users.edit');

    Route::put('/{user}', 'UserController@update'); //Ruta para realizar la edición del usuario

    Route::post('/{user}/estado', 'UserController@changeStatus'); //Ruta para habilitar o deshabilitar el usuario

    Route::delete('/{user}', 'UserController@destroy') //Ruta para realizar la eliminación el usuario
        ->name('users.destroy');
});

Route::prefix('/categorias')->group(function () {
    Route::get('/', 'CategoryController@index')->name('categories');

    Route::get('/nueva', 'CategoryController@create')->name('categories.create');

    Route::post('/nueva', 'CategoryController@store')->name('categories.create');

    Route::get('/{category}/editar', 'CategoryController@edit')->name('categories.edit');

    Route::put('/{category}/editar', 'CategoryController@update')->name('categories.edit');

    Route::delete('/{category}', 'CategoryController@destroy')->name('categories.destroy');
});

Route::prefix('/productos')->group(function () {
    Route::get('/', 'ProductController@index')->name('products');

    Route::get('/nuevo', 'ProductController@create')->name('products.create');

    Route::post('/nuevo', 'ProductController@store')->name('products.create');
});
