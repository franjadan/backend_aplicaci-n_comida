dd("hola")
@extends('layout')

@section('title', 'Nuevo ingrediente')

@section('content')
    <form action="{{ route('ingredients.create')}}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('ingredients._fields')
        <div class="form-group mt-5">
            <input type="submit" class="btn btn-success" value="Crear ingrediente">
            <a href="{{ route('ingredients') }}" class="btn btn-secondary">Volver al listado de ingredientes</a>
        </div>
    </form>
@endsection
