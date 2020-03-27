<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Order;
use App\User;
use App\Product;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DateTime;


class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::query()
        ->where('state', 'pending')
        ->orderByDesc('order_date')
        ->orderByDesc('estimated_time')
        ->get();

        return view('orders.index', [
            'route' => "index",
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

    public function store(Request $request)
    {

        $rules = [
            'user_id' => ['nullable', 'present', Rule::exists('users', 'id')],
            'guest_name' => ['nullable', 'present'],
            'guest_address' => ['nullable', 'present'],
            'guest_phone' => ['nullable', 'present', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            'estimated_time' => ['required', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'real_time' => ['nullable', 'present', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'comment' => ['nullable', 'present'],
            'paid' => ['required', 'boolean']
        ];

        $messages = [
            'user_id.present' => 'El campo usuario debe esta presente',
            'user_id.exists' => 'El campo usuario debe ser válido',
            'guest_name.present' => 'El campo nombre del invitado debe estar presente',
            'guest_address.present' => 'El campo dirección del invitado debe estar presente',
            'guest_phone.present' => 'El campo teléfono del invitado debe estar presente',
            'estimated_time.required' => 'El campo hora de recogida es obligatorio',
            'estimated_time.regex' => 'El campo hora de recogida debe ser válido',
            'estimated_time.present' => 'El campo hora de recogida real debe estar presente',
            'estimated_time.regex' => 'El campo hora de recogida real debe ser válido',
            'comments.present' => 'El campo observaciones debe estar presente',
            'paid.required' => 'El campo pagado es obligatorio',
            'paid.boolean' => 'El campo pagado no es válido'
        ];

        $num = 1;
        $products = [];

        while($request->get('product_' . $num) != null){
            $rules["product_$num"] = [Rule::exists('products', 'id')];
            $rules["cant_$num"] = ['numeric'];
            $messages["product_$num.exists"] = 'El producto debe ser válido';
            $messages["cant_$num.numeric"] = 'La cantidad debe ser un número';

            if($request->get('cant_' . $num) > 0 && is_numeric($request->get('cant_' . $num))){
                for ($i = 0; $i < $request->get('cant_' . $num); $i++) {
                    array_push($products, $request->get('product_' . $num));
                }
            }

            $num++;
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) { 

            return redirect(route('orders.create'))->withErrors($validator)->withInput();;

        } else {

            if(count($products) == 0){
                $validator->getMessageBag()->add('product_1', 'Debe haber mínimo un pedido');
                return back()->withErrors($validator)->withInput();
            }

            if($request->get('user_id') != null){
                if(!empty($request->get('guest_name')) || !empty($request->get('guest_address')) || !empty($request->get('guest_phone'))){
                    $validator->getMessageBag()->add('guest_phone', 'El pedido sólo podrá realizarse con un usuario registrado o invitado');
                    return back()->withErrors($validator)->withInput();                
                }
            }else{
                if(empty($request->get('guest_name')) || empty($request->get('guest_address')) || empty($request->get('guest_phone'))){
                    $validator->getMessageBag()->add('guest_phone', 'Debe haber un usuario registrado o datos de invitado');
                    return back()->withErrors($validator)->withInput();                
                }
            }
            
            $order = new Order();
            $dt = new DateTime();

            $order->forceFill([
                'user_id' => $request->get('user_id'),
                'guest_name' => $request->get('guest_name'),
                'guest_address' => $request->get('guest_address'),
                'guest_phone' => $request->get('order_date'),
                'order_date' => $dt->format('Y-m-d H:i:s'),
                'estimated_time' => $request->get('estimated_time'),
                'state' => 'pending',
                'real_time' => $request->get('real_time'),
                'comment' =>$request->get('comment'),
                'paid' => $request->get('paid'),
            ]);
        
            $order->save();

            $order->products()->attach($products);

            return redirect()->route('orders.index')->with('success', 'Se han guardado los cambios');
        }
    }

    public function edit(Order $order) 
    {
        if($order->state != "pending"){
            return redirect()->route('orders.index')->with('error', 'No puedes acceder a este pedido');
        }

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

    public function update(Request $request, Order $order)
    {
        $rules = [
            'user_id' => ['nullable', 'present', Rule::exists('users', 'id')],
            'guest_name' => ['nullable', 'present'],
            'guest_address' => ['nullable', 'present'],
            'guest_phone' => ['nullable', 'present', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            'estimated_time' => ['required', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'real_time' => ['nullable', 'present', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'comment' => ['nullable', 'present'],
            'paid' => ['required', 'boolean']
        ];

        $messages = [
            'user_id.present' => 'El campo usuario debe esta presente',
            'user_id.exists' => 'El campo usuario debe ser válido',
            'guest_name.present' => 'El campo nombre del invitado debe estar presente',
            'guest_address.present' => 'El campo dirección del invitado debe estar presente',
            'guest_phone.present' => 'El campo teléfono del invitado debe estar presente',
            'estimated_time.required' => 'El campo hora de recogida es obligatorio',
            'estimated_time.regex' => 'El campo hora de recogida debe ser válido',
            'estimated_time.present' => 'El campo hora de recogida real debe estar presente',
            'estimated_time.regex' => 'El campo hora de recogida real debe ser válido',
            'comments.present' => 'El campo observaciones debe estar presente',
            'paid.required' => 'El campo pagado es obligatorio',
            'paid.boolean' => 'El campo pagado no es válido'
        ];

        $num = 1;
        $products = [];

        while($request->get('product_' . $num) != null){
            $rules["product_$num"] = [Rule::exists('products', 'id')];
            $rules["cant_$num"] = ['numeric'];
            $messages["product_$num.exists"] = 'El producto debe ser válido';
            $messages["cant_$num.numeric"] = 'La cantidad debe ser un número';

            if($request->get('cant_' . $num) > 0 && is_numeric($request->get('cant_' . $num))){
                for ($i = 0; $i < $request->get('cant_' . $num); $i++) {
                    array_push($products, $request->get('product_' . $num));
                }
            }

            $num++;
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) { 

            return redirect(route('orders.edit', ['order' => $order]))->withErrors($validator)->withInput();

        } else {

            if(count($products) == 0){
                $validator->getMessageBag()->add('product_1', 'Debe haber mínimo un pedido');
                return back()->withErrors($validator)->withInput();
            }

            if($request->get('user_id') != null){
                if(!empty($request->get('guest_name')) || !empty($request->get('guest_address')) || !empty($request->get('guest_phone'))){
                    $validator->getMessageBag()->add('guest_phone', 'El pedido sólo podrá realizarse con un usuario registrado o invitado');
                    return back()->withErrors($validator)->withInput();                
                }
            }else{
                if(empty($request->get('guest_name')) || empty($request->get('guest_address')) || empty($request->get('guest_phone'))){
                    $validator->getMessageBag()->add('guest_phone', 'Debe haber un usuario registrado o datos de invitado');
                    return back()->withErrors($validator)->withInput();                
                }
            }

            $order->forceFill([
                'user_id' => $request->get('user_id'),
                'guest_name' => $request->get('guest_name'),
                'guest_address' => $request->get('guest_address'),
                'guest_phone' => $request->get('order_date'),
                'estimated_time' => $request->get('estimated_time'),
                'real_time' => $request->get('real_time'),
                'comment' =>$request->get('comment'),
                'paid' => $request->get('paid'),
            ]);
        
            $order->save();

            $order->products()->detach();
            $order->products()->attach($products);

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
        ->orderByDesc('order_date')
        ->orderByDesc('estimated_time')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($orders)
                ->addColumn('actions', function($row){
                    $actions = "<a class='btn btn-primary' href=" . route('orders.show', ['order' => $row]) . "><i class='fas fa-eye'></i></a>";
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('orders.index', [
            'route' => "record",
            'orders' => $orders
        ]);
    }

    public function storeAPI(Request $request)
    {
        $rules = [
            'user_id' => ['nullable', Rule::exists('users', 'id')],
            'guest_name' => ['nullable'],
            'guest_address' => ['nullable'],
            'guest_phone' => ['nullable', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            'guest_token' => ['nullable'],
            'products' => ['required', 'array', Rule::exists('products', 'id')],
            'estimated_time' => ['required', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'comment' => ['nullable'],
            'paid' => ['required', 'boolean']
        ];

        $messages = [
            'user_id.exists' => 'El campo usuario debe ser válido',
            'products.required' => 'El campo productos es obligatorio',
            'products.exists' => 'El campo productos debe ser válido',
            'estimated_time.required' => 'El campo hora de recogida es obligatorio',
            'estimated_time.regex' => 'El campo hora de recogida debe ser válido',
            'estimated_time.present' => 'El campo hora de recogida real debe estar presente',
            'estimated_time.regex' => 'El campo hora de recogida real debe ser válido',
            'paid.required' => 'El campo pagado es obligatorio',
            'paid.boolean' => 'El campo pagado no es válido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) { 
            return response()->json(["response" => ["code" => -1, "data" => $validator->errors()]], 400);         

        } else {

            if($request->get('user_id') != null){
                if(!empty($request->get('guest_name')) || !empty($request->get('guest_address')) || !empty($request->get('guest_phone')) || !empty($request->get('guest_token'))){
                    return response()->json(["response" => ["code" => -1, "data" => "El pedido sólo podrá realizarse con un usuario registrado o invitado"]], 422);         
                }
            }else{
                if(empty($request->get('guest_name')) || empty($request->get('guest_address')) || empty($request->get('guest_phone')) || empty($request->get('guest_token'))){
                    return response()->json(["response" => ["code" => -1, "data" => "Debe haber un usuario registrado o datos de invitado"]], 422);         
                }
            }
            
            $order = new Order();
            $dt = new DateTime();

            $order->forceFill([
                'user_id' => $request->get('user_id'),
                'guest_name' => $request->get('guest_name'),
                'guest_address' => $request->get('guest_address'),
                'guest_phone' => $request->get('order_date'),
                'guest_token' => $request->get('guest_token'),
                'order_date' => $dt->format('Y-m-d H:i:s'),
                'estimated_time' => $request->get('estimated_time'),
                'state' => 'pending',
                'comment' =>$request->get('comment'),
                'paid' => $request->get('paid'),
            ]);
        
            $order->save();

            $order->products()->attach($request->get('products'));

            return response()->json(["response" => ["code" => 1, "data" => $order->id]], 201);
        }
    }

    public function storeFavoriteOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', Rule::exists('orders', 'id')],
            'favourite_order_name' => ['required']
        ], [
            'order_id.required' => 'El pedido es obligatorio',
            'order_id.exists' => 'El pedido debe ser válido',
            'favourite_order_name.required' => 'El campo nombre del pedido favorito es obligatorio'
        ]);

        if ($validator->fails()) { 
            return response()->json(["response" => ["code" => -1, "data" => $validator->errors()]], 400);
        } else {
            $order = Order::query()
            ->where('id', $request->get('order_id'))
            ->first();

            $order->favourite_order_name = $request->get('favourite_order_name');
            $order->save();

            return response()->json(["response" => ["code" => 1, "data" => $order]], 200);
        }
    }

    public function listFavoriteOrders(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['nullable', Rule::exists('users', 'id')],
            'guest_token' => ['nullable', Rule::exists('orders', 'guest_token')]
        ], [
            'user_id.exists' => 'El campo usuario debe ser válido',
            'guest_token.exists' => 'El campo token del invitado debe ser válido',
        ]);

        if ($validator->fails()) { 
            return response()->json(["response" => ["code" => -1, "data" => $validator->errors()]], 400);
        } else {

            if($request->get('guest_token') != null){
                $orders = Order::query()
                    ->where('guest_token', $request->get('guest_token'))
                    ->whereNotNull('favourite_order_name')
                    ->get();

                    return response()->json(["response" => ["code" => 1, "data" => $orders]], 200);
            }else{
                if($request->get('user_id') != null){
                    $orders = Order::query()
                        ->where('user_id', $request->get('user_id'))
                        ->whereNotNull('favourite_order_name')
                        ->get();

                    return response()->json(["response" => ["code" => 1, "data" => $orders]], 200);
                }else{
                    return response()->json(["response" => ["code" => 1, "data" => []]], 200);
                }
            }
        }
    }

    public function lastOrders(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['nullable', Rule::exists('users', 'id')],
            'guest_token' => ['nullable', Rule::exists('orders', 'guest_token')]
        ], [
            'user_id.exists' => 'El campo usuario debe ser válido',
            'guest_token.exists' => 'El campo token del invitado debe ser válido',
        ]);

        if ($validator->fails()) { 
            return response()->json(["response" => ["code" => -1, "data" => $validator->errors()]], 400);
        } else {

            if($request->get('guest_token') != null){
                $orders = Order::query()
                    ->where('guest_token', $request->get('guest_token'))
                    ->where('state', 'pending')
                    ->get();

                    return response()->json(["response" => ["code" => 1, "data" => $orders]], 200);
            }else{
                if($request->get('user_id') != null){
                    $orders = Order::query()
                        ->where('user_id', $request->get('user_id'))
                        ->where('state', 'pending')
                        ->get();

                        return response()->json(["response" => ["code" => 1, "data" => $orders]], 200);
                }else{
                    return response()->json(["response" => ["code" => 1, "data" => []]], 200);
                }
            }
        }
    }
    
}