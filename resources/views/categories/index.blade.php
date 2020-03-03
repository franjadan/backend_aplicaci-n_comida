@extends('layout')

@section('title', "Listado de categorías")

@section('content')
        <h1>Listado de categorías</h1>
        <div>
            <a href="#" class="btn btn-secondary mt-2">Nueva Categoría</a>
        </div>
        <div>
            @if ($categories->isNotEmpty())
                <table class="table table-striped table-bordered mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td scope="row">{{ $category->id }}</td>
                                <td scope="row">{{ $category->name }}</td>
                                <td scope="row">
                                    @if ($category->discount == 0)
                                        Sin descuento
                                    @else
                                        {{ $category->discount }}
                                    @endif
                                </td>
                                <td scope="row">
                                    <div>
                                        <a href="#"><i class="fas fa-edit"></i></a>
                                        <a href="#"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay categorías registradas.</p>
            @endif
        </div>
@endsection
