@extends('layout')

@section('titile', "Detalle Comentario {$comment->id}")

@section('content')
    <h1 class="mb-3">Comentario {{ $comment->id }}.</h1>
    <h5 class="info_field_title">Autor</h5>
    <p>{{ $comment->user->first_name}} {{$comment->user->last_name }} ({{ $comment->user->email }}).</p>
    <h5 class="mt-5 info_field_title">Comentario</h5>
    <p>{{ $comment->comment }}</p>
    <a href="{{ route('comments') }}" class="btn btn-outline-primary">Volver al listado de comentarios</a>
@endsection

