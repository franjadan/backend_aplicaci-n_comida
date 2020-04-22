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

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', 'IndexController@index')->name('index')->middleware('auth');;

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
    
    Route::prefix('/pedidos')->group(function () {
        Route::get('/', 'OrderController@index')->name('orders.index'); //Ruta listado
        
        Route::get('/historial', 'OrderController@orderRecord')->name('orders.record'); //Ruta historial de pedidos
    
        Route::get('/historial/excel', function () {
            return Excel::download(new App\Exports\OrdersExport, 'historial.xlsx'); //Ruta para descargar el excel
        })->name('orders.excel');
    
        Route::get('/{order}', 'OrderController@show')->where('order', '[0-9]+')->name('orders.show'); //Ruta detalle pedido
    
        Route::get('/nuevo', 'OrderController@create')->name('orders.create'); //Ruta de la página para crear el pedido
    
        Route::post('/crear', 'OrderController@store'); //Ruta para realizar la creación del pedido
    
        Route::get('/{order}/editar', 'OrderController@edit') //Ruta de la página para editar el pedido
            ->name('orders.edit');
    
        Route::put('/{order}', 'OrderController@update'); //Ruta para realizar la edición del pedido
    
        Route::post('/{order}/finalizar', 'OrderController@finish'); //Ruta para finalizar el pedido
    
        Route::post('/{order}/cancelar', 'OrderController@cancel'); //Ruta para cancelar el pedido
    
    
    });
    
    Route::prefix('/ingredientes')->group(function () {
        Route::get('/', 'IngredientController@index')->name('ingredients.index'); 
    
        Route::get('/nuevo', 'IngredientController@create')->name('ingredients.create');
    
        //Route::post('/crear', 'IngredientController@store')->name('ingredients.store');
    
        Route::get('/{ingredient}/editar', 'IngredientController@edit')->name('ingredients.edit');
    
        //Route::put('/{ingredient}', 'IngredientController@update')->name('ingredients.update'); 
    
        Route::delete('/{ingredient}', 'IngredientController@destroy')->name('ingredients.destroy');
    
    });
    
    Route::prefix('/productos')->group(function () {
        Route::get('/', 'ProductController@index')->name('products');
    
        Route::get('/nuevo', 'ProductController@create')->name('products.create');
    
        Route::post('/nuevo', 'ProductController@store')->name('products.create');
    
        Route::get('/{product}/editar', 'ProductController@edit')->name('products.edit');
    
        Route::put('/{product}/editar', 'ProductController@update')->name('products.edit');
    
        Route::delete('/{product}', 'ProductController@destroy')->name('products.destroy');
    });
    
    Route::prefix('/comentarios')->group(function () {
        Route::get('/', 'CommentController@index')->name('comments');
    
        Route::get('/{comment}', 'CommentController@show')->name('comments.show');
    
        Route::delete('/{comment}', 'CommentController@destroy')->name('comments.destroy');
    });
    
    Route::prefix('/perfil')->group(function () {
        Route::get('/', 'ProfileController@index')->name('profile.index'); //Ruta para mostrar datos del perfil
    
        Route::get('/{user}/editar', 'ProfileController@edit')->name('profile.edit'); //Ruta para cambiar la contraseña
    
        Route::put('/{user}/editar', 'ProfileController@update');
    
    });
});

Auth::routes([
    'register' => false, //Para eliminar la ruta de registro
    'reset' => false, //Para eliminar la ruta de restaurar contraseña
    'verify' => false, //Para eliminar la ruta de verificación
]);