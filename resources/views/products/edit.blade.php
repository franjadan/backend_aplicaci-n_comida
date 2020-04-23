@extends('layout')

@section('title', 'Editar producto')

@section('content')
    <img src="{{ asset($product->image) }}" alt="" id="products_image" class="mb-3">
    <form action="{{ route('products.edit', $product) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('products._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Modificar producto">
            <a href="{{ route('products') }}" class="btn btn-secondary">Volver al listado de productos</a>
        </div>
    </form>
@endsection
