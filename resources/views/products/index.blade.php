@extends('layout')

@section('scripts')
    <script src="{{ asset('js/add_animation_to_hover.js') }}"></script>
    <script src="{{ asset('js/confirm_modal.js') }}"></script>
@endsection

@section('title', 'Listado de productos')

@section('content')
    <h1>Listado de productos</h1>
    @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
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
                    ¿Está seguro de que desea eliminar el producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="acceptButton" class="btn btn-success">Aceptar</button>
                </div>
                </div>
            </div>
        </div>
        <div class="my-custom-panel my-4 shadow-sm p-4">
            <a href="{{ route('products.create') }}" class="btn my-btn-primary"><i class="fas fa-plus"></i> Nuevo Producto</a>
        </div>
    @endif
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
                                    @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                                        <div class="row my-3">
                                            <div class="col">
                                                <a href="{{ route('products.edit', $product) }}" class="btn my-btn-other d-block" id="card-option-edit-{{ $product->id }}"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button data-id="{{ $product->id }}" data-toggle="modal" data-target="#confirmModal" class='btn my-btn-danger showModalConfirmBtn w-100' type='button'><i class='fas fa-trash-alt'></i></button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row my-3">
                                            <div class="col">
                                                <form action="{{ route('products.available', $product) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <input type="hidden" name="available" value="{{ $product->available ? 'no': 'yes' }}">
                                                    <button type="submit" class="btn {{ $product->available ? 'my-btn-danger': 'btn-success' }} w-100">@if($product->available) <i class="fas fa-times"></i> Deshabilitar @else <i class="fas fa-check"></i> Habilitar @endif producto</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('products.destroy', $product) }}" method="post" id="deleteForm-{{ $product->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                @endif
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

