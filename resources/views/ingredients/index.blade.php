@extends('layout')

@section('title', 'Listado de ingredientes')

@section('content')
        <h1>Listado de ingredientes</h1>
        <div>
            <a href="{{ route('ingredients.create') }}" class="btn btn-primary mt-2">Nuevo Ingrediente</a>
        </div>
        <div>
            @if ($ingredients->isNotEmpty())
                <table class="table table-striped table-bordered mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingredients as $ingredient)
                            <tr>
                                <td scope="row">{{ $ingredient->id }}</td>
                                <td scope="row"><h5>{{ $ingredient->name }}</h5></td>
                                <td scope="row">
                                    <div>
                                        <form action="{{ route('ingredients.destroy', $ingredient) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $ingredients->links() }}
            @else
                <p>No hay ingredientes registrados.</p>
            @endif
        </div>
@endsection
