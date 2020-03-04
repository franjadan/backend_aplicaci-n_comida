@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

    <h1>Usuario {{ $user->id }}</h1>
    
    <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
                
        {{ method_field('PUT') }}
        
        @include('users._fields')

        <input type="submit" class="btn btn-success" value="Guardar cambios">
        
        <a class="btn btn-outline-primary" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>

    </form>

    <form method="POST" class="mt-1" action="{{ url("usuarios/{$user->id}/status") }}">
                
        {{ method_field('POST') }}
        {{ csrf_field() }}
        
        <input type="submit" class="btn btn-warning" @if ($user->active) value="Deshabilitar usuario" @else value="Habilitar usuario" @endif>
        
    </form>
  
@endsection