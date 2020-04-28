@extends('layout')

@section('titile', "Detalle Comentario {$comment->id}")

@section('content')
    <h1 class="mb-3">Comentario {{ $comment->id }}.</h1>
    <h5 class="info_field_title">Autor</h5>
    <p>{{ $comment->user->first_name}} {{$comment->user->last_name }} ({{ $comment->user->email }}).</p>
    <h5 class="mt-5 info_field_title">Comentario</h5>
    <p>{{ $comment->comment }}</p>
    <div class="my-custom-panel my-4 shadow-sm p-4">
        <a href="{{ route('comments') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Volver al listado de comentarios</a>
    </div>
@endsection

