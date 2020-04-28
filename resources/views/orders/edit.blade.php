@extends('layout')

@section('title', "Pedido {$order->id}")

@section('scripts')
    <script src="{{ asset('js/confirm_modal.js') }}"></script>
@endsection

@section('content')

    <h1>Pedido {{ $order->id }}.</h1>

    <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelOrderModalLabel">¡ATENCIÓN!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de cancelar el pedido?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="cancelOrderButton" class="btn btn-success">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="concludeOrderModal" tabindex="-1" role="dialog" aria-labelledby="concludeOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="concludeOrderModalLabel">¡ATENCIÓN!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estas seguro de finalizar el pedido?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="concludeOrderButton" class="btn btn-success">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <div>
    <form method="POST" class="d-inline mt-3" action="{{ url("pedidos/{$order->id}") }}">

        {{ method_field('PUT') }}

        @include('orders._fields')

        <div class="my-custom-panel my-4 shadow-sm p-4">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Modificar pedido</button>

    </form>

    <form method="POST" id="concludeForm-{{ $order->id }}" class="d-inline" action="{{ url("pedidos/{$order->id}/finalizar") }}">

        {{ method_field('POST') }}
        {{ csrf_field() }}

        <button data-id="{{ $order->id }}" data-toggle="modal" data-target="#concludeOrderModal" class="btn btn-warning showModalConfirmBtn"><i class="fas fa-check"></i> Finalizar pedido</button>

    </form>

    <form method="POST" id="cancelForm-{{ $order->id }}" class="d-inline" action="{{ url("pedidos/{$order->id}/cancelar") }}">

        {{ method_field('POST') }}
        {{ csrf_field() }}

        <button data-id="{{ $order->id }}" data-toggle="modal" data-target="#cancelOrderModal" class="btn btn-danger showModalConfirmBtn"><i class="fas fa-times"></i> Cancelar pedido</button>
        <a class="btn btn-outline-primary" href="{{ route('orders.index') }}"><i class="fas fa-arrow-left"></i> Regresar al listado de pedidos</a>

    </form>
    </div>
</div>

@endsection
