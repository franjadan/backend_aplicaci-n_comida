@extends('layout')

@section('title', 'Nuevo producto')

@section('content')
    <h1>Nuevo producto.</h1>

    <form action="{{ route('products.create') }}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('products._fields')
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar cambios</button>
            <a href="{{ route('products') }}" class="btn my-btn-other"><i class="fas fa-arrow-left"></i> Volver al listado de productos</a>
        </div>
    </form>
@endsection

