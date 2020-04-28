@extends('layout')

@section('title', "Nuevo pedido")

@section('content')

    <h1>Nuevo pedido</h1>

    <form method="POST" action="{{ url('pedidos/crear') }}">

        @include('orders._fields')

        <input type="submit" class="btn btn-success" value="Crear pedido">
        <a class="btn btn-outline-primary" href="{{ route('orders.index') }}">Regresar al listado de pedidos</a>

    </form>

@endsection
