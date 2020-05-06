@extends('layout')

@section('title', 'Editar categoría')

@section('content')
    <h1>Categoría {{ $category->id }}.</h1>

    <form action="{{ route('categories.edit', $category) }}" class="mt-3" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('categories._fields')
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 mt-4 p-3 card-image">
                <div class="card w-75 shadow">
                    <img src="{{ asset($category->min) }}" alt="" class="card-image-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">Imagen actual</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Modificar categoría</button>
            <a href="{{ route('categories') }}" class="btn my-btn-other"><i class="fas fa-arrow-left"></i> Volver al listado de categorías</a>
        </div>
    </form>
@endsection
