{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Nombre:</label>
    <input type="text" class="form-control" id="inputName" name="name">
    @if($errors->has('name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputDescription">Descripción:</label>
    <textarea name="description" id="inputDescription" cols="5" rows="5" class="form-control"></textarea>
    @if($errors->has('description'))
        <div class="alert alert-danger mt-2">{{ $errors->first('description') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputPrice">Precio:</label>
    <input type="text" class="form-control" id="inputPrice" name="price">
    @if($errors->has('price'))
        <div class="alert alert-danger mt-2">{{ $errors->first('price') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputDiscount">Descuento:</label>
    <input type="text" class="form-control" id="inputDiscount" name="discount">
    @if($errors->has('discount'))
        <div class="alert alert-danger mt-2">{{ $errors->first('discount') }}</div>
    @endif
</div>
<div class="form-group">
    <p>¿Está disponible?</p>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="available" id="available_yes" value="yes">
        <label for="form-check-label" for="available_yes">Sí</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="available" id="available_no" value="no">
        <label for="form-check-label" for="available_no">No</label>
    </div>
    @if($errors->has('available'))
        <div class="alert alert-danger mt-2">{{ $errors->first('available') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="selectCategories">Categorías:</label>
    @if ($categories->isNotEmpty())
        <select name="categories[]" id="selectCategories" class="form-control" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    @else
        <p>No hay categorías registradas.</p>
    @endif
    @if($errors->has('categories'))
        <div class="alert alert-danger mt-2">{{ $errors->first('categories') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="selectIngredients">Ingredientes:</label>
    @if ($ingredients->isNotEmpty())
        <select name="ingredients[]" id="selectIngredients" class="form-control" multiple>
            @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
            @endforeach
        </select>
    @else
        <p>No hay ingredientes registrados.</p>
    @endif
    @if($errors->has('ingredients'))
        <div class="alert alert-danger mt-2">{{ $errors->first('ingredients') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="inputImage">Imagen:</label>
    <input type="file" accept="image/*" name="image" class="form-control-file">
    @if($errors->has('image'))
        <div class="alert alert-danger mt-2">{{ $errors->first('image') }}</div>
    @endif
</div>
