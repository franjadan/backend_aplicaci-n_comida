<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use DB;

class IndexController extends Controller
{
    function index(){

        $now = Carbon::now(); //Para la fecha actual
        
        //Mes actual para mostrar datos por defecto, descomentar para mes anterior
        //$now->modify('-1 month');

        $products = DB::select(DB::raw("SELECT name, count(*) as number FROM order_products JOIN products 
        ON order_products.product_id = products.id where EXTRACT(MONTH FROM order_products.created_at) = :month 
        and EXTRACT(YEAR FROM order_products.created_at) = :year GROUP BY name
        "), array(
            'month' => $now->month,
            'year' => $now->year,
        )); //Consulta para obtener los productos vendidos de este mes

        $categories = DB::select(DB::raw("SELECT categories.name as name, count(*) as number FROM order_products 
        JOIN products ON order_products.product_id = products.id JOIN product_categories ON products.id = product_categories.product_id 
        JOIN categories ON product_categories.category_id = categories.id 
        where EXTRACT(MONTH FROM order_products.created_at) = :month and EXTRACT(YEAR FROM order_products.created_at) = :year GROUP BY name
        "), array(
            'month' => $now->month,
            'year' => $now->year,
        )); //Consulta para obtener las categorías vendidos de este mes

        $months = DB::select(DB::raw("SELECT EXTRACT(MONTH FROM order_date) as month, count(*) as number 
        FROM orders where EXTRACT(YEAR FROM order_date) = :year GROUP BY month"), array(
            'year' => $now->year,
        )); //Consulta para obtener los pedidos que se han realizado por meses

        $defaultMonths = ["Enero" => 0, "Febrero" => 0, "Marzo" => 0, "Abril" => 0, "Mayo" => 0, "Junio" => 0, "Julio" => 0, "Agosto" => 0,
        "Septiembre" => 0, "Octubre" => 0, "Noviembre" => 0, "Diciembre" => 0]; //Meses y pedidos por defecto

        if(count($months) != 0){
            foreach($months as $key => $value){
                //Si hay alguna venta este año cambio el array por defecto
                $defaultMonths[array_keys($defaultMonths)[$value->month - 1]] = $value->number;
            }
        }
        
        //Relleno los arrays que voy a mandarle al gráfico
        $productsArray[] = ['Productos', 'Ventas']; //Título (aunque en este caso no se ve en el gráfico)
        foreach($products as $key => $value)
        {
            $productsArray[++$key] = [$value->name, $value->number];
        }

        $categoriesArray[] = ['categorias', 'Ventas']; //Título (aunque en este caso no se ve en el gráfico)
        foreach($categories as $key => $value)
        {
            $categoriesArray[++$key] = [$value->name, $value->number];
        }


        $monthsArray[] = ['Meses', 'Pedidos']; //Título (aunque en este caso sólo se ve Pedidos en el gráfico)
        $number = 0;
        foreach($defaultMonths as $key => $value)
        {
            $monthsArray[++$number] = [$key, $value];
        }

        //Envío los datos a la plantilla, donde se van a generar los gráficos
        return view('index', [
            'year' => $now->year,
            'month' => $now->month,
            'products' => json_encode($productsArray),
            'categories' => json_encode($categoriesArray),
            'months' => json_encode($monthsArray),
        ]);
    }
}
