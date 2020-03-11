@extends('layout')

@section('title', 'Editar categoría')

@section('content')
    <img src="{{ asset($category->image) }}" alt="" id="categories_image" class="mb-3">
    <form action="{{ route('categories.edit', $category) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('categories._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Modificar categoría">
            <a href="{{ route('categories') }}" class="btn btn-secondary">Volver al listado de categorías</a>
        </div>
    </form>
@endsection
