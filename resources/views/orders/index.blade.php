@extends('layout')

<!--Hago cambios en función si el listado es de pedidios pendientes o es el historial de pedidos-->

@if($route == "record")
    @section('title', "Historial de pedidos")
@else
    @section('title', "Pedidos pendientes")
@endif

@section('content')

    @if($route == "record")
        <h1>Historial de pedidos.</h1>
    @else
        <h1>Pedidos pendientes.</h1>
    @endif

    @if($route != "record")
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <a href="{{ route('orders.create') }}" class="btn my-btn-primary"><i class="fas fa-plus"></i> Nuevo pedido</a>
        </div>
    @elseif(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <a href="{{ route('orders.excel') }}" class="btn my-btn-primary"><i class="fas fa-file-download"></i> Descargar excel</a>
        </div>
    @endif
    <!--Relleno la tabla con los datos de los pedidios-->
    @if(!$orders->isEmpty())

        <div class="table-responsive">
            <table class="table table-bordered data-table">
                <thead class="thead">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Hora de recogida</th>
                        <th class="text-center" scope="col">Fecha del pedido</th>
                        @if($route == "record")
                            <th class="text-center" scope="col">Estado</th>
                        @endif
                        <th class="text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center">{{ $order->estimated_time }}</td>
                            <td class="text-center">{{ $order->order_date->format('d/m/Y H:i:s') }}</td>
                            @if($route == "record")
                                @if($order->state == "finished")
                                    <td class="text-center">Finalizado</td>
                                @else
                                    <td class="text-center">Cancelado</td>
                                @endif
                            @endif
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class='btn my-btn-primary' href="{{ route('orders.show', ['order' => $order]) }}"><i class='fas fa-eye'></i></a>
                                    @if($route != 'record')
                                        <a class='btn my-btn-other' href="{{ route('orders.edit', ['order' => $order]) }}"><i class='fas fa-edit'></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-secondary">
            <p class="mt-3">No hay pedidos registrados.</p>
       </div>
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

