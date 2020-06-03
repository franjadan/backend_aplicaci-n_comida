@extends('layout')

@section('title', 'Editar ingrediente')

@section('content')
    <h1>Ingrediente {{ $ingredient->id }}.</h1>

    <form action="{{ route('ingredients.edit', $ingredient) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('ingredients._fields')
        <div class="form-group mt-5">
            <div class="my-custom-panel my-4 shadow-sm p-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Modificar ingrediente</button>
                <a class="btn my-btn-other" href="{{ route('ingredients.index') }}"><i class="fas fa-arrow-left"></i> Regresar al listado de ingredientes</a>
            </div>
        </div>
    </form>
@endsection
