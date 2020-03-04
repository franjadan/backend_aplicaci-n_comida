@extends('layout')

@section('title', "Listado de usuarios")

@section('content')
    <h1>Listado de usuarios</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">Nuevo usuario</a>

    @if(!$users->isEmpty())

        <!--<p>Viendo página {{ $users->currentPage() }} de {{ $users->lastPage() }}</p>-->

        <table class="table table-bordered table-hover table-striped mt-3">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><h5>{{ $user->name }} @if ($user->isAdmin()) (Admin) @endif @if ($user->active) <span class="status st-active"></span> @else <span class="status st-inactive"></span> @endif</h5></td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td>
                            <form class="" action="#" method="POST">
                                @csrf
                                @method('PATCH')
                                <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user]) }}"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
        
    @else
        <p class="mt-3">No hay usuarios</p>
    @endif

@endsection

