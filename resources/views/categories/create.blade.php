@extends('layout')

@section('title', 'Nueva categoría')

@section('content')
    <form action="{{ route('categories.create')}}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('categories._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Crear categoría">
            <a href="{{ route('categories') }}" class="btn btn-secondary">Volver al listado de categorías</a>
        </div>
    </form>
@endsection
