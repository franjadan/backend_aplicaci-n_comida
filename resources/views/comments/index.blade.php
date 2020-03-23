@extends('layout')

@section('title', 'Listado de comentarios')

@section('content')
    <h1>Listado de categorías</h1>
    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">Nuevo Comentario</a>
    </div>
    <div>
        @if ($comments->isNotEmpty())
            <table class="table table-striped table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td scope="row">{{ $comment->id }}</td>
                            <td scope="row">{{ substr($comment->comment, 0, 20) }}...</td>
                            <td scope="row">
                                <div>
                                    <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('comments.show', $comment) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $comments->links() }}
        @else
            <p>No hay comentarios registrados.</p>
        @endif
    </div>
@endsection
