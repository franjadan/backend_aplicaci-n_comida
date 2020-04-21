@extends('layout')

@section('scripts')
    <script src="{{ asset('js/add_animation_to_hover.js') }}"></script>
    <script src="{{ asset('js/show_alert.js') }}"></script>
@endsection

@section('title', 'Listado de productos')

@section('content')
    <h1>Listado de productos</h1>
    <div class="p-4 my-custom-alert shadow-lg">
        <div class="model-dialog" role="document">
            <div class="model-content">
                <div class="modal-header">
                    <h5>¡ATENCIÓN!</h5>
                    <div>
                        <a href="" class="d-block option-close"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar el producto?</p>
                </div>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-2 btn btn-success mr-2 option-accept">Aceptar</div>
                        <div class="col-2 btn btn-danger option-cancel"><a href="" class="d-block option-cancel">Cancelar</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Nuevo Producto</a>
    </div>
    @include('products._filters')
    <div>
        @if(!$products->isEmpty())

            <div class="card-container">
                @foreach ($products as $product)

                    <div class="card mb-5 mt-3" id="card-product-{{ $product->id }}">
                        <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="card-options my-3" id="card-options-{{ $product->id }}">
                                <div class="container">
                                    <div class="row my-3">
                                        <div class="col">
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary d-block" id="card-option-edit-{{ $product->id }}"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="btn btn-danger d-block show-alert" id="card-option-delete-{{ $product->id }}"><i class='fas fa-trash-alt'></i></div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('products.destroy', $product) }}" method="post" id="card-form-{{ $product->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            {{ $products->links() }}

        @else
            <p class="mt-3">No hay productos registrados</p>
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

