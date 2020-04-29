@extends('layout')

@section('title', "Nuevo usuario")

@section('content')

    <h1>Nuevo usuario.</h1>

    <form method="POST" class="mt-3" action="{{ url('usuarios/crear') }}">

        @include('users._fields')

        <div class="my-custom-panel my-4 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Crear usuario</button>
            <a class="btn my-btn-other" href="{{ route('users.index') }}"><i class="fas fa-arrow-left"></i> Regresar al listado de usuarios</a>
        </div>

    </form>

@endsection
