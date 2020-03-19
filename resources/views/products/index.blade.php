@extends('layout')

@section('title', 'Listado de productos')

@section('content')
    <h1>Listado de productos</h1>
    <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">Nuevo Producto</a>
    </div>
    <div>
        @if ($products->isNotEmpty())
            <table class="table table-striped table-bordered mt-3">
                <thead class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Acciones</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td scope="row">{{ $product->id }}</td>
                            <td scope="row"><h5>{{ $product->name }}</h5></td>
                            <td scope="row">{{ $product->price }}</td>
                            <td scope="row">
                                @if ($product->discount == 0)
                                    Sin descuento
                                @else
                                    {{ $product->discount }}
                                @endif
                            </td>
                            <td scope="row">
                                <div>
                                    <form action="{{ route('products.destroy', $product) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        @else
            <p>No hay productos registrados.</p>
        @endif
    </div>
@endsection
