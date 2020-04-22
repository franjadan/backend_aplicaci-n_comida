@extends('layout')

@section('title', 'Editar producto')

@section('content')
    <img src="{{ asset($product->image) }}" alt="" id="products_image" class="mb-3">
    <form action="{{ auth()->user()->isAdmin() ? route('products.edit', $product): route('products.available', $product) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @if(auth()->user()->isAdmin())
            @include('products._fields')
        @else
        @include('products._fields_disabled')
        @endif
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Modificar producto">
            <a href="{{ route('products') }}" class="btn btn-secondary">Volver al listado de productos</a>
        </div>
    </form>
@endsection
