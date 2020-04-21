@extends('layout')

@section('title', "Perfil")

@section('content')

    <h1 class="mb-5">Perfil</h1>

    <h5 class="mt-5 info_field_title">Nombre</h5>
    <p>{{ $user->first_name }} {{ $user->last_name }}</p>

    <h5 class="mt-5 info_field_title">Email</h5>
    <p>{{ $user->email }}</p>

    <h5 class="mt-5 info_field_title">Teléfono</h5>
    <p>{{ $user->phone }}</p>

    <h5 class="mt-5 info_field_title">Dirección</h5>
    <p>{{ $user->address }}</p>

    <a class="btn btn-warning mt-3" href="{{ route('profile.edit', $user) }}">Cambiar contraseña</a>
    
@endsection