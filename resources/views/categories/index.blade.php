@extends('layout')

@section('scripts')
    <script src="{{ asset('js/add_animation_to_hover.js') }}"></script>
    <script src="{{ asset('js/confirm_modal.js') }}"></script>
@endsection

@section('title', 'Listado de categorías')

@section('content')
    <h1>Listado de categorías</h1>
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
                ¿Estas seguro de eliminar el comentario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="acceptButton" class="btn btn-success">Aceptar</button>
            </div>
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">Nueva Categoría</a>
    </div>
    @include('categories._filters')
    <div>
        @if ($categories->isNotEmpty())

            <div class="card-container">
                @foreach ($categories as $category)
                    <div class="card mb-5 mt-3" id="card-category-{{ $category->id }}">
                        <img class="card-img-top" src="{{ asset($category->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <div class="card-options my-3" id="card-options-{{ $category->id }}">
                               <div class="container">
                                   <div class="row my-3">
                                        <div class="col">
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary d-block" id="card-option-edit-{{ $category->id }}"><i class="fas fa-edit"></i></a>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col">
                                            <button data-id="{{ $category->id }}" data-toggle="modal" data-target="#confirmModal" class='btn btn-danger showModalConfirmBtn w-100' type='button'><i class='fas fa-trash-alt'></i></button>
                                        </div>
                                   </div>
                               </div>
                                <form action="{{ route('categories.destroy', $category) }}" method="post" id="deleteForm-{{ $category->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{ $categories->links() }}

        @else
            <p>No hay categorías registradas.</p>
        @endif
    </div>
@endsection
