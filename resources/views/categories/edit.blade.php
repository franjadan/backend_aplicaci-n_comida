@extends('layout')

@section('title', 'Editar categoría')

@section('content')
    <h1>Categoría {{ $category->id }}</h1>

    <form action="{{ route('categories.edit', $category) }}" class="mt-3" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('categories._fields')
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 mt-4 p-3 card-image">
                <div class="card w-75 shadow">
                    <img src="{{ asset($category->image) }}" alt="" class="card-image-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">Imagen actual</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Modificar categoría">
            <a href="{{ route('categories') }}" class="btn btn-outline-primary">Volver al listado de categorías</a>
        </div>
    </form>
@endsection
