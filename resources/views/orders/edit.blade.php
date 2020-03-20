@extends('layout')

@section('title', "Pedido {$order->id}")

@section('content')

    <h1>Pedido {{ $order->id }}</h1>
    
    <form method="POST" class="d-inline" action="{{ url("pedidos/{$order->id}") }}">
                
        {{ method_field('PUT') }}
        
        @include('orders._fields')

        <input type="submit" class="btn btn-success" value="Guardar cambios">
    
    </form>

    <form method="POST" class="d-inline" action="{{ url("pedidos/{$order->id}/cancelar") }}">
                
        {{ method_field('POST') }}
        {{ csrf_field() }}
        
        <input type="submit" class="btn btn-warning" value="Cancelar pedido">        
    </form>

    <form method="POST" class="d-inline" action="{{ url("pedidos/{$order->id}/finalizar") }}">
                
        {{ method_field('POST') }}
        {{ csrf_field() }}
        
        <input type="submit" class="btn btn-warning" value="Finalizar pedido">
        <a class="btn btn-outline-primary" href="{{ route('orders.index') }}">Regresar al listado de pedidos</a>
        
    </form>
  
@endsection