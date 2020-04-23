@extends('layout')

@section('title', 'Editar producto')

@section('content')
    <form action="{{ route('products.edit', $product) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('products._fields')
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 mt-4 p-3 card-image">
                <div class="card w-75 shadow">
                    <img src="{{ asset($product->image) }}" alt="" class="card-image-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">Imagen actual</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Modificar producto">
            <a href="{{ route('products') }}" class="btn btn-secondary">Volver al listado de productos</a>
        </div>
    </form>
@endsection
