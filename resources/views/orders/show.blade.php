@extends('layout')

@section('title', "Detalle Pedido {$order->id}")

@section('content')

    <h1 class="mb-5">Pedido {{ $order->id }}</h1>

    @if($order->user != null)
        <h5 class="mt-5 info_field_title">Usuario</h5>
        <p>{{ $order->user->first_name }}, {{ $order->user->last_name }}</p>
    @else
        <h5 class="mt-5 info_field_title">Nombre Invitado</h5>
        <p>{{ $order->guest_name }}</p>
        <h5 class="mt-5 info_field_title">Dirección Invitado</h5>
        <p>{{ $order->guest_address }}</p>
        <h5 class="mt-5 info_field_title">Teléfono Invitado</h5>
        <p>{{ $order->guest_phone }}</p>
    @endif

    <h5 class="mt-5 info_field_title">Fecha pedido</h5>
    <p>{{ $order->order_date }}</p>

    <h5 class="mt-5 info_field_title">Productos</h5>
    <ul>
        @foreach (array_count_values($order->products->pluck('name')->toArray()) as $product => $quantity)
            <li>{{ $product }} x{{ $quantity }}</li>
        @endforeach
    </ul>

    @if(!empty($order->comment))
        <h5 class="mt-5 info_field_title">Observaciones</h5>
        <p>{{ $order->comment }}</p>
    @endif

    <h5 class="mt-5 info_field_title">Hora de recogida estimada</h5>
    <p>{{ $order->estimated_time }}</p>

    @if($order->real_time != null)
        <h5 class="mt-5 info_field_title">Hora de recogida real</h5>
        <p>{{ $order->real_time }}</p>
    @endif

    <h5 class="mt-5 info_field_title">Estado del pedido</h5>
    @if($order->state == "pending")
        <p>Pendiente</p>
    @elseif($order->state == "finished")
        <p>Finalizado</p>
    @else
        <p>Cancelado</p>
    @endif

    <h5 class="mt-5 info_field_title">¿Está pagado?</h5>
    @if($order->paid)
        <p>Sí</p>
    @else
        <p>No</p>
    @endif

    <h5 class="mt-5 info_field_title">Total</h5>
    <p>{{ $order->total }}€</p>

    @if($order->state == "pending")
        <a class="btn btn-outline-primary mt-3" href="{{ route('orders.index') }}">Regresar al listado de pedidos</a>
    @else
        <a class="btn btn-outline-primary mt-3" href="{{ route('orders.record') }}">Regresar al listado de pedidos</a>
    @endif
  
@endsection