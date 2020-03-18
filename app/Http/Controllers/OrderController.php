<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
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
            'orders' => $orders
        ]);
    }
}
