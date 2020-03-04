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

    Route::delete('/{user}', 'UserController@disable') //Ruta para deshabilitar el usuario
        ->name('users.disable');
});

Route::prefix('/categories')->group(function () {
    Route::get('/', 'CategoryController@index')->name('categories');
});
