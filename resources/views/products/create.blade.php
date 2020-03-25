@extends('layout')

@section('title', 'Nuevo producto')

@section('content')
    <form action="{{ route('products.create') }}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('products._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Crear producto">
            <a href="{{ route('products') }}" class="btn btn-secondary">Volver al listado de productos</a>
        </div>
    </form>
@endsection

