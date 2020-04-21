@extends('layout')

<!--Hago cambios en función si el listado es de pedidios pendientes o es el historial de pedidos-->

@if($route == "record")
    @section('title', "Historial de pedidos")
@else
    @section('title', "Pedidos pendientes")
@endif

@section('content')

    @if($route == "record")
        <h1>Historial de pedidos</h1>
    @else
        <h1>Pedidos pendientes</h1>
    @endif

    @if($route != "record")
        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-2 mb-3">Nuevo pedido</a>
    @else
        <a href="{{ route('orders.excel') }}" class="btn btn-success mt-2 mb-3">Descargar excel</a>
    @endif
    <!--Relleno la tabla con los datos de los pedidios-->
    @if(!$orders->isEmpty())

        <table class="table table-bordered data-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hora de recogida</th>
                    <th scope="col">Fecha del pedido</th>
                    @if($route == "record")
                        <th scope="col">Estado</th>
                    @endif
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->estimated_time }}</td>
                        <td>{{ $order->order_date }}</td>
                        @if($route == "record")
                            @if($order->state == "finished")
                                <td>Finalizado</td>
                            @else
                                <td>Cancelado</td>
                            @endif
                        @endif
                        <td>
                            <a class='btn btn-primary' href="{{ route('orders.show', ['order' => $order]) }}"><i class='fas fa-eye'></i></a>
                            @if($route != 'record')
                                <a class='btn btn-primary ml-1' href="{{ route('orders.edit', ['order' => $order]) }}"><i class='fas fa-edit'></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-3">No hay pedidos pendientes</p>
    @endif

@endsection

@section('datatable')
<!--Datatables-->
<script>
$(document).ready(function(){

	$('.data-table').DataTable( {
        "bSort": false, //Quito la ordenación por defecto, puesto que ya ordeno manualmente por fecha
		"stateSave": true,
		"pageLength": 10,
        "lengthChange": false,
		"language": {
				"sProcessing":    "Procesando...",
				"sLengthMenu":    "Mostrar _MENU_ registros",
				"sZeroRecords":   "No se encontraron resultados",
				"sEmptyTable":    "Ningún dato disponible en esta tabla",
				"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":   "",
				"sSearch":        "Buscar:",
				"sUrl":           "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":    "Último",
					"sNext":    " ",
					"sPrevious": " "
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
	});

});
</script>

@endsection

