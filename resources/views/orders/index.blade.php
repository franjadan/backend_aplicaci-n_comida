@extends('layout')

@if($rute == "record")
    @section('title', "Historial de pedidos")
@else
    @section('title', "Pedidos pendientes")
@endif

@section('content')

    @if($rute == "record")
        <h1>Historial de pedidos</h1>
    @else
        <h1>Pedidos pendientes</h1>
    @endif

    @if($rute != "record")
        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-2 mb-3">Nuevo pedido</a>
    @else
        <a href="{{ route('orders.excel') }}" class="btn btn-success mt-2 mb-3">Descargar excel</a>
    @endif

    @if(!$orders->isEmpty())

        <table class="table table-bordered data-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hora de recogida</th>
                    <th scope="col">Fecha del pedido</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        
    @else
        <p class="mt-3">No hay pedidos pendientes</p>
    @endif

@endsection

@section('datatable')

@if($rute == "record")
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
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
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.record') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'estimated_time', name: 'estimated_time'},
            {data: 'order_date', name: 'order_date'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });
    
  });
  </script>
@else
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
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
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'estimated_time', name: 'estimated_time'},
            {data: 'order_date', name: 'order_date'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });
    
  });
  </script>
@endif


  
@endsection

