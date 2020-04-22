{{ csrf_field() }}

<!--Aquí se encuentran los campos que comparten la creación y edición de usuarios-->

<div class="form-group">
    <label for="first_name">Nombre</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Pedro" value="{{ old('first_name', $user->first_name) }}">
    @if ($errors->has('first_name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('first_name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="last_name">Apellido</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Perez" value="{{ old('last_name', $user->last_name) }}">
    @if ($errors->has('last_name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('last_name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="pedro@example.com" value="{{ old('email', $user->email) }}">
    @if ($errors->has('email'))
        <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="password">Contraseña</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mayor a 6 caracteres">
    @if ($errors->has('password'))
        <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="address">Dirección</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Calle 123" value="{{ old('address', $user->address) }}">
    @if ($errors->has('address'))
        <div class="alert alert-danger mt-2">{{ $errors->first('address') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="phone">Teléfono</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="622622622" value="{{ old('phone', $user->phone) }}">
    @if ($errors->has('phone'))
        <div class="alert alert-danger mt-2">{{ $errors->first('phone') }}</div>
    @endif
</div>

<div class="form-group">
    <label>Rol</label>
    @foreach($roles as $role => $name)
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" {{ old('role', $user->role) == $role ? 'checked' : '' }} class="form-check-input" value="{{ $role }}" id="role_{{ $role }}" name="role"> {{ $name }}
            </label>
        </div>
    @endforeach
    @if ($errors->has('role'))
        <div class="alert alert-danger mt-2">{{ $errors->first('role') }}</div>
    @endif
</div>
