@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card login">
                <div class="card-header login_header">Menu of the day</div>
                <div class="card-body">
                @include('shared._flash-message')

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group px-5">
                            <label for="email" >Correo electrónico:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group px-5">
                            <label for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group px-5 mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Recuérdame</label>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row px-3 mt-4">
                                <div class="col-8"></div>
                                <div class="col-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            ¿Ha olvidado la contraseña?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
