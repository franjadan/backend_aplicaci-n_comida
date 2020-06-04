@extends('layout')

@section('title', 'Nueva categoría')

@section('content')
    <h1>Nueva categoría.</h1>

    <form action="{{ route('categories.create')}}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('categories._fields')
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar cambios</button>
            <a href="{{ route('categories') }}" class="btn my-btn-other"><i class="fas fa-arrow-left"></i> Volver al listado de categorías</a>
        </div>
    </form>
@endsection
