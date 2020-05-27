@extends('layout')

@section('title', 'Editar alérgeno')

@section('content')
    <h1>Alérgeno {{ $allergen->id }}</h1>

    <form action="{{ route('allergens.edit', $allergen) }}" class="mt-3" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('allergens._fields')
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 mt-4 p-3 card-image">
                <div class="card w-75 shadow p-3">
                    <div class="card-image-content">
                        <img src="{{ asset($allergen->image) }}" alt="" class="card-image-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Imagen actual</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Modificar alérgeno</button>
            <a href="{{ route('allergens') }}" class="btn my-btn-other"><i class="fas fa-arrow-left"></i> Volver al listado de alérgenos</a>
        </div>
    </form>

@endsection
