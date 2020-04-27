@extends('layout')

@section('title', 'Nuevo producto')

@section('content')
    <h1>Nuevo producto</h1>

    <form action="{{ route('products.create') }}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('products._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Crear producto">
            <a href="{{ route('products') }}" class="btn btn-outline-primary">Volver al listado de productos</a>
        </div>
    </form>
@endsection

