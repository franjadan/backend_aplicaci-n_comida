@extends('layout')

@section('title', 'Editar ingrediente')

@section('content')
    <form action="{{ route('ingredients.edit', $ingredient) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('ingredients._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Modificar ingrediente">
            <a href="{{ route('ingredients') }}" class="btn btn-secondary">Volver al listado de ingredientes</a>
        </div>
    </form>
@endsection
