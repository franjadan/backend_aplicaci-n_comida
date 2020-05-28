<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.verify']], function() {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::post('pedidos/favoritos/nuevo', 'OrderController@storeFavoriteOrder');

    Route::post('pedidos/favoritos/cancelar', 'OrderController@cancelFavoriteOrder');

    Route::get('pedidos/favoritos', 'OrderController@listFavoriteOrders');

    Route::post('comentarios/nuevo', 'CommentController@new');
});

Route::post('login', 'UserController@login');

Route::post('registro', 'UserController@register');

Route::post('pedidos/nuevo', 'OrderController@storeAPI');

Route::get('pedidos/ultimos', 'OrderController@lastOrders');

Route::post('pedidos/cancelar', 'OrderController@cancelOrderAPI');

Route::get('categorias', 'CategoryController@categories');

Route::get('productos/{category}', 'ProductController@productsByCategory');

Route::get('productos', 'ProductController@products');

Route::get('comentarios', 'CommentController@comments');

Route::get('pedidos', 'OrderController@refresh');

Route::post('generar_contrasenia', 'UserController@api_generatePassword');

Route::get('alergenos', 'ProductController@allergens');