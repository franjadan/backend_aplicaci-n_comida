{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Nombre:</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $ingredient->name) }}">
    @if($errors->has('name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
    @endif
</div>
