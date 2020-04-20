@extends('layout')

@section('title', "Listado de usuarios")

@section('content')
    <h1>Listado de usuarios</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mt-2 mb-3">Nuevo usuario</a>

    @if(!$users->isEmpty())

        <table class="table table-bordered data-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <!--Relleno la tabla con los datos de los usuarios-->
            @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><h5>{{ $user->name }} @if ($user->isAdmin()) (Admin) @endif @if ($user->active) <span class="status st-active"></span> @else <span class="status st-inactive"></span> @endif</h5></td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td>
                            <form class="" action="{{ route('users.destroy', $user) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user]) }}"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger" type="submit" onclick="return confirm('¿Estas seguro de que quieres eliminar este usuario?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    @else
        <p class="mt-3">No hay usuarios</p>
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
		"pageLength": 50,
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
			}
	});

});
</script>
@endsection

