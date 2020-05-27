@extends('layout')

@section('title', 'Listado de alérgenos')

@section('content')
    <h1>Listado de alérgenos.</h1>
    <div class="my-custom-panel my-4 shadow-sm p-4">
        <a href="{{ route('allergens.create') }}" class="btn my-btn-primary"><i class="fas fa-plus"></i> Nuevo Alérgeno</a>
    </div>
    <div>
        @if ($allergens->isNotEmpty())

            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead class="thead">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allergens as $allergen)
                            <tr>
                                <td class="text-center">{{ $allergen->id }}</td>
                                <td class="text-center">{{ $allergen->name }}</td>
                                <td class="text-center">
                                    <div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No hay alérgenos registrados.</p>
        @endif
    </div>
@endsection

@section('datatable')
<!--Datatables-->
<script>
$(document).ready(function(){

	$('.data-table').DataTable( {
        "bSort": false,
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
