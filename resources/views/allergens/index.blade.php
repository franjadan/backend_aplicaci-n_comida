@extends('layout')

@section('scripts')
    <script src="{{ asset('js/confirm_modal.js') }}"></script>
@endsection

@section('title', 'Listado de alérgenos')

@section('content')
    <h1>Listado de alérgenos.</h1>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">¡ATENCIÓN!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea eliminar el alérgeno?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="acceptButton" class="btn btn-success">Aceptar</button>
            </div>
            </div>
        </div>
    </div>
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
                            <th class="text-center" scope="col">Nombre</th>
                            <th class="text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allergens as $allergen)
                            <tr>
                                <td class="text-center">{{ $allergen->id }}</td>
                                <td class="text-center">{{ $allergen->name }}</td>
                                <td class="text-center">
                                <form action="{{ route('allergens.destroy', $allergen) }}" method="POST" id="deleteForm-{{ $allergen->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="btn-group">
                                            <a class="btn my-btn-primary" href="{{ route('allergens.edit', $allergen) }}"><i class="fas fa-edit"></i></a>
                                            <button data-id="{{ $allergen->id }}" data-toggle="modal" data-target="#confirmModal" class='btn my-btn-danger showModalConfirmBtn' type='button'><i class='fas fa-trash-alt'></i></button>
                                        </div>
                                    </form>
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
        "columnDefs": [
            { "bSortable": false, "aTargets": [ 2 ] },
        ],		"stateSave": true,
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
