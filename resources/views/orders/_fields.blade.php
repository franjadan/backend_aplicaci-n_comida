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
        <?php 
            $number = 1;

            if(old('num') != null){
                
                $number = old('num');
            }

            if(count($order->products) > 0){
                $number = count(array_unique($order->products->pluck('id')->toArray()));
            }
            
        ?>
        <?php  for ($i = 1; $i <= $number; $i++): ?>
            <div class="d-flex">
                <input type="hidden" name="num" id="num" value="<?php echo $i ?>">
                <select name="<?php echo "product_$i" ?>" id="<?php echo "product_$i" ?>" class="form-control">
                
                @foreach ($products as $product)
                    @if(old('num') != null)
                        <option {{ old("product_$i") == $product->id ? 'selected': '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                    @elseif(count($order->products) > 0)
                        <option {{ array_values(array_unique($order->products->pluck('id')->toArray()))[$i-1] == $product->id ? 'selected': '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                    @else
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endif

                @endforeach
                </select>

                @if(old('num') != null)
                    <input style="width: 20%;" type="number" name="<?php echo "cant_$i" ?>" id="<?php echo "cant_$i" ?>" class="form-control" value="<?php echo old("cant_$i") ?>">
                @elseif(count($order->products) > 0)
                    <input style="width: 20%;" type="number" name="<?php echo "cant_$i" ?>" id="<?php echo "cant_$i" ?>" class="form-control" value="<?php echo array_values(array_count_values($order->products->pluck('id')->toArray()))[$i-1] ?>">
                @else
                    <input style="width: 20%;" type="number" name="<?php echo "cant_$i" ?>" id="<?php echo "cant_$i" ?>" class="form-control" value="1">
                @endif
            </div>
        <?php endfor; ?>
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