@extends('layout')

@section('title', 'Listado de categorías')

@section('content')
    <h1>Listado de categorías</h1>
    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2 mb-3">Nueva Categoría</a>
    </div>
    <div>
        @if ($categories->isNotEmpty())

            <table class="table table-bordered data-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        @else
            <p>No hay categorías registradas.</p>
        @endif
    </div>
@endsection

@section('datatable')

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
        ajax: "{{ route('categories') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'discount', name: 'discount'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });

    $(".dataTables_filter input")
    .unbind() // Unbind previous default bindings
    .bind("input", function(e) { // Bind our desired behavior
		// If the length is 2 or more characters, search
		if(this.value.length >= 2) {
            // Call the API search function
            table.search(this.value).draw();
        }
        // Ensure we clear the search if they backspace far enough
        if(this.value == "") {
            table.search("").draw();
        }
        return;
    });
  });
  </script>

@endsection
