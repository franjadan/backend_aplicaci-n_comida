{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Nombre*</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $category->name) }}" placeholder="Hamburguesas">
    @if($errors->has('name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputImage">Imagen*</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" accept="image/*" name="image" class="form-control-file" id="inputImage">
            <label for="inputImage" class="custom-file-label">Seleciona una imagen...</label>
        </div>
    </div>
    @if($errors->has('image'))
        <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
    @endif
</div>
