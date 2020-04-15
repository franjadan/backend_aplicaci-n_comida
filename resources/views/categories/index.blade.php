@extends('layout')

@section('scripts')
    <script src="{{ asset('js/add_animation_to_hover.js') }}"></script>
    <script src="{{ asset('js/show_alert.js') }}"></script>
@endsection

@section('title', 'Listado de categorías')

@section('content')
    <h1>Listado de categorías</h1>
    <div class="p-4 my-custom-alert shadow-lg">
        <h5>¿Está seguro que desea eliminar la categoría?</h5>
        <div class="container mt-3">
            <div class="row">
                <div class="col-2 btn btn-success mr-2 option-accept">Aceptar</div>
                <div class="col-2 btn btn-danger"><a href="" class="option-cancel">Cancelar</a></div>
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2 mb-3">Nueva Categoría</a>
    </div>
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
                                            <div class="btn btn-danger d-block show-alert" id="card-option-delete-{{ $category->id }}"><i class="fas fa-trash"></i></div>
                                        </div>
                                   </div>
                               </div>
                                <form action="{{ route('categories.destroy', $category) }}" method="post" id="card-form-{{ $category->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <p>No hay categorías registradas.</p>
        @endif
    </div>
@endsection
