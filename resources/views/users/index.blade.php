@extends('layout')

@section('title', "Listado de usuarios")

@section('scripts')
    <script src="{{ asset('js/confirm_modal.js') }}"></script>
@endsection

@section('content')
    <h1>Listado de usuarios.</h1>

    <!--Modal deshabilitar usuario-->
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
                ¿Está seguro de que desea cambiar el estado del usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="acceptButton" class="btn btn-success">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="my-custom-panel my-4 shadow-sm p-4">
        <a href="{{ route('users.create') }}" class="btn my-btn-primary"><i class="fas fa-plus"></i> Nuevo usuario</a>
        @if($route == 'index')
            <a href="{{ route('users.trash') }}" class="btn my-btn-danger"><i class="fas fa-trash"></i> Ver usuarios deshabilitados</a>
        @else
            <a href="{{ route('users.index') }}" class="btn my-btn-success"><i class="fas fa-user-check"></i> Ver usuarios habilitados</a>
        @endif
        </div>
    @if(!$users->isEmpty())
        <div class="table-responsive">
            <table class="table table-bordered data-table">
                <thead class="thead">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <!--Relleno la tabla con los datos de los usuarios-->
                @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center"><h5>@if ($user->isAdmin()) Admin @else @if ($user->isOperator()) Operario @else {{ $user->name }} @endif @endif @if ($user->active) <span class="status st-active"></span> @else <span class="status st-inactive"></span> @endif</h5></td>
                            <td class="text-muted text-center">{{ $user->email }}</td>
                            <td class="text-center">
                                <form id="deleteForm-{{ $user->id }}" method="POST" class="d-inline" action="{{ url("usuarios/{$user->id}/estado") }}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}

                                    <div class="btn-group">
                                        <a class="btn my-btn-primary" href="{{ route('users.edit', ['user' => $user]) }}"><i class="fas fa-edit"></i></a>
                                        @if($user->active)
                                            <button data-id="{{ $user->id }}" data-toggle="modal" data-target="#confirmModal" class="btn my-btn-danger showModalConfirmBtn"><i class="fas fa-user-times"></i></button>
                                        @else
                                            <button data-id="{{ $user->id }}" data-toggle="modal" data-target="#confirmModal" class="btn my-btn-success showModalConfirmBtn"><i class="fas fa-user-plus"></i></button>
                                        @endif
                                    </div>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
       <div class="alert alert-secondary">
            <p class="mt-3">No hay usuarios registrados.</p>
       </div>
    @endif

@endsection

@section('datatable')
<!--Datatables-->
<script>
$(document).ready(function(){

	$('.data-table').DataTable( {
        "columnDefs": [{
          "targets": 3, //posición de la columna a la que afecte los cambios (empieza por 0). Puede ser un array de varias columnas
          "orderable": false,
          "searchable": false,
        }],
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

