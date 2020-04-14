@extends('layout')

@section('scripts')
<script src="{{ asset('js/add_animation_to_hover.js') }}"></script>
@endsection

@section('title', 'Listado de categorías')

@section('content')
    <h1>Listado de categorías</h1>
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
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary d-block"><i class="fas fa-edit"></i></a>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col">
                                            <a href="" class="btn btn-danger d-block"><i class="fas fa-trash"></i></a>
                                        </div>
                                   </div>
                               </div>
                                <!--<form action="{{ route('categories.destroy', $category) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="container">
                                        <div class="row">
                                            <div class="col text-center btn btn-primary">
                                                <a href="{{ route('categories.edit', $category) }}" class="btn"><i class="fas fa-edit card-option"></i></a>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col text-center  btn btn-danger">
                                                <button class='btn' type='submit'><i class='fas fa-trash-alt card-option'></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>-->
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
