@extends('layout')

@section('titile', "Detalle Comentario {$comment->id}")

@section('content')
    <h1 class="mb-5">Comentario {{ $comment->id }}.</h1>
    <p>Autor: {{ $comment->user->first_name}} {{$comment->user->last_name }} ({{ $comment->user->email }}).</p>
    <p>Comentario: {{ $comment->comment }}</p>
    <a href="{{ route('comments') }}" class="btn btn-secondary">Volver al listado de comentarios</a>
@endsection

