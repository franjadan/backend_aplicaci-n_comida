<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Datatables;

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
                        $actions = "<form action='". route('orders.destroy', $row) . "' method='POST'>" .csrf_field() . "" . method_field('DELETE') . "<a class='btn btn-primary' href=" . route('orders.show', ['order' => $row]) . "><i class='fas fa-eye'></i></a><a class='btn btn-primary mr-1' href='" . route('orders.edit', ['order' => $row]) . "'><i class='fas fa-edit'></i></a><button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt'></i></button></form>";
                        return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('orders.index', [
            'orders' => $orders
        ]);
    }
}
