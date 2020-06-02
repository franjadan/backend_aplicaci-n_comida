@section('scripts')
    <script src="{{ asset('js/multi-select.js') }}"></script>
@endsection

{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Nombre*</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $ingredient->name) }}">
    @if($errors->has('name'))
        <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="selectAllergens">Alérgenos</label>
    @if ($allergens->isNotEmpty())
        <select name="allergens[]" id="selectAllergens" class="form-control select-categories multi-select" multiple>
            @foreach ($allergens as $allergen)
                <option value="{{ $allergen->id }}" {{ collect(old('allergens', $ingredient->allergens->pluck('id')->toArray()))->contains($allergen->id) ? 'selected': '' }}>{{ $allergen->name }}</option>
            @endforeach
        </select>
    @else
        <p>No hay alérgenos registrados.</p>
    @endif
    @if($errors->has('allergens'))
        <div class="alert alert-danger mt-2">{{ $errors->first('allergens') }}</div>
    @endif
</div>
