@extends('layout')

@section('title', 'Listado de comentarios')

@section('scripts')
    <script src="{{ asset('js/modify_styles_datatables.js')}}"></script>
@endsection

@section('content')
    <h1>Listado de comentarios</h1>
    <div>
        @if ($comments->isNotEmpty())

            <table class="table table-bordered data-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ substr($comment->comment, 0, 40)}}...</td>
                            <td>
                                <div>
                                    <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('comments.show', $comment) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        <button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt'></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @else
            <p>No hay comentarios registrados.</p>
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
