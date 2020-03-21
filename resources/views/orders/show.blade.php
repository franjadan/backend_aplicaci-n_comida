@extends('layout')

@section('title', "Detalle Pedido {$order->id}")

@section('content')

    <h1 class="mb-5">Pedido {{ $order->id }}</h1>

    @if($order->user != null)
        <h5>Usuario</h5>
        <p>{{ $order->user->first_name }}, {{ $order->user->last_name }}</p>
    @else
        <h5>Nombre Invitado</h5>
        <p>{{ $order->guest_name }}</p>
        <h5>Dirección Invitado</h5>
        <p>{{ $order->guest_address }}</p>
        <h5>Teléfono Invitado</h5>
        <p>{{ $order->guest_phone }}</p>
    @endif

    <h5>Fecha pedido</h5>
    <p>{{ $order->order_date }}</p>


    <h5>Productos</h5>
    <ul>
        @foreach ($order->products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>

    @if(!empty($order->comment))
        <h5>Observaciones</h5>
        <p>{{ $order->comment }}</p>
    @endif

    <h5>Hora de recogida estimada</h5>
    <p>{{ $order->estimated_time }}</p>

    @if($order->real_time != null)
        <h5>Hora de recogida real</h5>
        <p>{{ $order->real_time }}</p>
    @endif

    <h5>Estado del pedido</h5>
    @if($order->state == "pending")
        <p>Pendiente</p>
    @elseif($order->state == "finished")
        <p>Finalizado</p>
    @else
        <p>Cancelado</p>
    @endif

    <h5>¿Está pagado?</h5>
    @if($order->paid)
        <p>Sí</p>
    @else
        <p>No</p>
    @endif
  
@endsection