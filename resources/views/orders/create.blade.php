@extends('layout')

@section('title', "Nuevo pedido")

@section('scripts')
    <script src="{{ asset('js/show_guest_data.js') }}"></script>
@endsection

@section('content')

    <h1>Nuevo pedido.</h1>

    <form method="POST" action="{{ url('pedidos/crear') }}">

        @include('orders._fields')

        <div class="my-custom-panel my-5 shadow-sm p-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar cambios</button>
            <a class="btn my-btn-other" href="{{ route('orders.index') }}"><i class="fas fa-arrow-left"></i> Regresar al listado de pedidos</a>
        </div>

    </form>

@endsection
