@extends('layout')

@section('title', "Usuario {$user->id}")

@section('scripts')
    <script src="{{ asset('js/confirm_modal.js') }}"></script>
@endsection

@section('content')

    <h1>Usuario {{ $user->id }}.</h1>

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

    <!--Modal generar contraseña-->
    <div class="modal fade" id="generatePassModal" tabindex="-1" role="dialog" aria-labelledby="generatePassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generatePassModal">¡ATENCIÓN!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea generar una nueva contraseña?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="generatePassButton" class="btn btn-success">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <form method="POST" class="d-inline mt-3" action="{{ url("usuarios/{$user->id}") }}">

        {{ method_field('PUT') }}

        @include('users._fields')

        <div class="my-custom-panel my-4 shadow-sm p-4">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar cambios</button>

    </form>

    <form id="deleteForm-{{ $user->id }}" method="POST" class="d-inline" action="{{ url("usuarios/{$user->id}/estado") }}">

        {{ method_field('POST') }}
        {{ csrf_field() }}

        <button data-id="{{ $user->id }}" data-toggle="modal" data-target="#confirmModal" class="btn my-btn-danger showModalConfirmBtn">@if ($user->active) <i class="fas fa-user-times"></i> Deshabilitar usuario @else <i class="fas fa-user-check"></i> Habilitar usuario @endif</button>

    </form>

    <form id="generatePassForm-{{ $user->id }}" method="POST" class="d-inline" action="{{ route('users.generatePassword', $user) }}">

        {{ method_field('POST') }}
        {{ csrf_field() }}

        <button data-id="{{ $user->id }}" data-toggle="modal" data-target="#generatePassModal" class="btn my-btn-primary showModalConfirmBtn"><i class="fas fa-lock"></i> Generar contraseña</button>
        <a class="btn my-btn-other" href="{{ route('users.index') }}"><i class="fas fa-arrow-left"></i> Regresar al listado de usuarios</a>
    </form>

@endsection
