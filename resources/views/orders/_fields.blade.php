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
    <label for="selectProducts">Productos: <button class="btnAdd btn btn-success">+</button></label>

    @if ($products->isNotEmpty())
        <div class="selects">
            <div class="d-flex">
                <input type="hidden" name="num" id="num" value="1">
                <select name="product_1" id="product_1" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
                </select>
                <input style="width: 20%;" type="number" name="cant_1" id="cant_1" class="form-control" value="1">
            </div>
        </div>
        @if ($errors->has('product_1'))
            <div class="alert alert-danger mt-2">{{ $errors->first('product_1') }}</div>
        @endif
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

<script>

$getProducts = false;
$products = "";

$.ajax({
    url: "{{ route('products') }}",
    type: 'get',
    dataType: 'json',
    success: function(response){
        $products = response["data"];
        $products.sort(sortByName);
        $getProducts = true;
    }
});

$('.btnAdd').click(function(event) {
    event.preventDefault();
    
    if($getProducts){

        $num = $("#num").val();
        $num++;

        $html = '<div class="d-flex"><select name="product_' + $num +'" id="product_'+ $num +'" class="form-control">';

        $.each($products, function(index, value){
            $html += '<option value="' + value["id"] + '">' +  value["name"] + '</option>';
        });

        $html += ' </select><input style="width:20%;" type="number" name="cant_'+ $num +'" id="cant_'+ $num +'" class="form-control" value="1"></div>';

        $('.selects').append($html);

        $("#num").val($num);    
    }
});

function sortByName(a, b){
  var aName = a.name.toLowerCase();
  var bName = b.name.toLowerCase(); 
  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}

</script>