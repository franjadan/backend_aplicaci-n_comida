@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

    <h1>Usuario {{ $user->id }}</h1>
    
    <form method="POST" class="d-inline" action="{{ url("usuarios/{$user->id}") }}">
                
        {{ method_field('PUT') }}
        
        @include('users._fields')

        <input type="submit" class="btn btn-success" value="Guardar cambios">
    
    </form>

    <form method="POST" class="d-inline" action="{{ url("usuarios/{$user->id}/estado") }}">
                
        {{ method_field('POST') }}
        {{ csrf_field() }}
        
        <input type="submit" class="btn btn-warning" @if ($user->active) value="Deshabilitar usuario" @else value="Habilitar usuario" @endif>
        <a class="btn btn-outline-primary" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
        
    </form>
  
@endsection