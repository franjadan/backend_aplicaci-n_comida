<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Order;
use App\User;
use App\Product;
use DataTables;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::query()
        ->where('state', 'pending')
        ->orderByDesc('estimated_time')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($orders)
                ->addColumn('actions', function($row){
                    $actions = "<a class='btn btn-primary' href=" . route('orders.show', ['order' => $row]) . "><i class='fas fa-eye'></i></a><a class='btn btn-primary ml-1' href='" . route('orders.edit', ['order' => $row]) . "'><i class='fas fa-edit'></i></a>";
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('orders.index', [
            'rute' => "index",
            'orders' => $orders
        ]);
    }

    public function create() 
    {
        $order = new Order;
        $users = User::query()
        ->orderBy('first_name')
        ->get();
        $products = Product::query()
        ->orderBy('name')
        ->get();
        return view('orders.create', [
            'order' => $order,
            'users' => $users,
            'products' => $products
        ]);
    }

    public function store(CreateOrderRequest $request)
    {
        $error = $request->createOrder();

        if(!empty($error)){
            return back()->with('error', $error);
        }else{
            return redirect()->route('orders.index')->with('success', 'Se han creado el pedido con éxito');
        }
    }

    public function edit(Order $order) 
    {
        $users = User::query()
        ->orderBy('first_name')
        ->get();
        $products = Product::query()
        ->orderBy('name')
        ->get();
        return view('orders.edit', [
            'order' => $order,
            'users' => $users,
            'products' => $products
        ]);  
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $error = $request->updateOrder($order);

        if(!empty($error)){
            return back()->with('error', $error);
        }else{
            return redirect()->route('orders.edit', ['order' => $order])->with('success', 'Se han guardado los cambios');
        }
    }

    public function finish(Order $order){

        $order->state = 'finished';
        $order->paid = true;

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Se han finalizado el pedido');
    }

    public function cancel(Order $order){

        $order->state = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Se han cancelado el pedido');
    }

    public function show(Order $order) 
    {
        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function orderRecord(Request $request) 
    {
        $orders = Order::query()
        ->where('state', '<>', 'pending')
        ->orderByDesc('estimated_time')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($orders)
                ->addColumn('actions', function($row){
                    $actions = "<a class='btn btn-primary' href=" . route('orders.show', ['order' => $row]) . "><i class='fas fa-eye'></i></a><a class='btn btn-primary ml-1' href='" . route('orders.edit', ['order' => $row]) . "'><i class='fas fa-edit'></i></a>";
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('orders.index', [
            'rute' => "record",
            'orders' => $orders
        ]);
    }
}