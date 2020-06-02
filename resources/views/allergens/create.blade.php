@extends('layout')

@section('title', 'Nuevo alérgeno')

@section('content')
    <h1>Nuevo alérgeno.</h1>

    <form action="{{ route('allergens.create') }}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('allergens._fields')
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Crear alérgeno</button>
            <a href="{{ route('allergens') }}" class="btn my-btn-other"><i class="fas fa-arrow-left"></i> Volver al listado de alérgenos</a>
        </div>
    </form>
@endsection
