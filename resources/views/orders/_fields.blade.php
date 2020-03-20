{{ csrf_field() }}

<div class="form-group">
    <label for="selectUser">Usuario:</label>
    @if ($users->isNotEmpty())
        <select name="user_id" id="selectUser" class="form-control">
        <option value="">Usuario invitado</option>
            @foreach ($users as $user)
                <option {{ $user->id == old('user_id', $order->user_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
            @endforeach
        </select>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
    @if($errors->has('user_id'))
        <div class="alert alert-danger mt-2">{{ $errors->first('user_id') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="guest_name">Nombre invitado</label>
    <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="Pedro" value="{{ old('guest_name', $order->guest_name) }}">
    @if ($errors->has('guest_name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('guest_name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="guest_address">Dirección invitado</label>
    <input type="text" class="form-control" id="guest_address" name="guest_address" placeholder="Calle 123" value="{{ old('guest_address', $order->guest_address) }}">
    @if ($errors->has('guest_address'))
        <div class="alert alert-danger mt-2">{{ $errors->first('guest_address') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="guest_phone">Teléfono invitado</label>
    <input type="text" class="form-control" id="guest_phone" name="guest_phone" placeholder="662662662" value="{{ old('guest_phone', $order->guest_phone) }}">
    @if ($errors->has('guest_phone'))
        <div class="alert alert-danger mt-2">{{ $errors->first('guest_phone') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="selectProducts">Productos:</label>
    @if ($products->isNotEmpty())
        <select name="products[]" id="selectProducts" class="form-control" multiple>
            @foreach ($products as $product)
                <option {{ collect(old('products', $order->products->pluck('id')->toArray()))->contains($product->id) ? 'selected':'' }} value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    @else
        <p>No hay productos registrados.</p>
    @endif
    @if($errors->has('products'))
        <div class="alert alert-danger mt-2">{{ $errors->first('products') }}</div>
    @endif
</div>


<div class="form-group">
    <label for="estimated_time">Hora de recogida</label>
    <input type="text" class="form-control" id="estimated_time" name="estimated_time" placeholder="00:00" value="{{ old('estimated_time', $order->estimated_time) }}">
    @if ($errors->has('estimated_time'))
        <div class="alert alert-danger mt-2">{{ $errors->first('estimated_time') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="real_time">Hora real de recogida</label>
    <input type="text" class="form-control" id="real_time" name="real_time" placeholder="00:00" value="{{ old('real_time', $order->real_time) }}">
    @if ($errors->has('real_time'))
        <div class="alert alert-danger mt-2">{{ $errors->first('real_time') }}</div>
    @endif
</div>


<div class="form-group">
    <label for="comment">Observaciones</label>
    <input type="text" class="form-control" id="comment" name="comment" placeholder="El pan muy tostado" value="{{ old('comment', $order->comment) }}">
    @if ($errors->has('comment'))
        <div class="alert alert-danger mt-2">{{ $errors->first('comment') }}</div>
    @endif
</div>

<div class="form-group">
    <p>¿Está pagado?</p>
    <div class="form-check">
        <input {{ old('paid', $user->paid) == 1 ? 'checked' : '' }} type="radio" class="form-check-input" name="paid" id="paid_yes" value="1">
        <label for="form-check-label" for="available_yes">Sí</label>
    </div>
    <div class="form-check">
        <input {{ old('paid', $user->paid) == 0 ? 'checked' : '' }} type="radio" class="form-check-input" name="paid" id="paid_no" value="0" >
        <label for="form-check-label" for="paid_no">No</label>
    </div>
    @if($errors->has('paid'))
        <div class="alert alert-danger mt-2">{{ $errors->first('paid') }}</div>
    @endif
</div>


