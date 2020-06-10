@extends('layout')

@section('title', 'Editar producto')

@section('content')
    <h1>Producto {{ $product->id }}.</h1>

    <form action="{{ route('products.edit', $product) }}" method="post" class="d-inline" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('products._fields')
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 mt-4 p-3 card-image">
                <div class="card w-75 shadow">
                    <img src="{{ asset($product->min) }}" alt="" class="card-image-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">Imagen actual</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar cambios</button>
    </form>

    <form action="{{ route('products.available', $product) }}" class="d-inline" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="available" value="{{ $product->available ? 'no': 'yes' }}">
        <button type="submit" class="btn {{ $product->available ? 'my-btn-danger': 'btn-success' }}">@if($product->available) <i class="fas fa-times"></i> Deshabilitar @else <i class="fas fa-check"></i> Habilitar @endif producto</button>
        <a href="{{ route('products') }}" class="btn my-btn-other"><i class="fas fa-arrow-left"></i> Volver al listado de productos</a></div>
    </form>

@endsection
