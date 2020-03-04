{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Nombre:</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $category->name) }}">
    @if($errors->has('name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputDiscount">Descuento:</label>
    <input type="text" class="form-control" id="inputDiscount" name="discount" value="{{ old('name', $category->discount) }}">
    @if($errors->has('discount'))
        <div class="alert alert-danger mt-2">{{ $errors->first('discount') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputImage">Imagen:</label>
    <input type="file" accept="image/*" name="image" class="form-control-file">
    @if($errors->has('image'))
        <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
    @endif
</div>
