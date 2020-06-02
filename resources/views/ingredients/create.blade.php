@extends('layout')

@section('title', 'Nuevo ingrediente')

@section('content')
    <form action="{{ route('ingredients.create')}}" method="post" class="mt-3" enctype="multipart/form-data">
        @include('ingredients._fields')
        <div class="form-group mt-5">
            <div class="my-custom-panel my-4 shadow-sm p-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Crear ingrediente</button>
                <a class="btn my-btn-other" href="{{ route('ingredients.index') }}"><i class="fas fa-arrow-left"></i> Regresar al listado de ingredientes</a>
            </div>
        </div>
    </form>
@endsection
