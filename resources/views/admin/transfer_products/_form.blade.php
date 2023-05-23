  <input type="hidden" name="current_quantity" id="current_quantity">
  <div class="form-group col-12">
    <label for="warehouse_from_id">Almacen Origen : </label>
    <select name="warehouse_from_id" id="warehouse_from_id" class="form-control">
      <option value="">Seleccione</option>
      @foreach($warehouses as $warehouse)
        <option value="{{ $warehouse->id }}" data-products='{{$warehouse->products}}'>{{ $warehouse->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-12">
    <label for="product_id">Producto : </label>
    <select name="product_id" id="product_id" class="form-control">
      <option value="">Seleccione</option>
    </select>
  </div>
  <div class="form-group col-12">
    <label for="quantity">Cantidad : </label>
    <input type="text" name="quantity" id="quantity" class="form-control" />
  </div>
  <div class="form-group col-12">
    <label for="warehouse_to_id">Almacen Destino : </label>
    <select name="warehouse_to_id" id="warehouse_to_id" class="form-control">
      <option value="">Seleccione</option>
       @foreach($warehouses as $warehouse)
        <option value="{{ $warehouse->id }}" data-products='{{$warehouse->products}}'>{{ $warehouse->name }}</option>
      @endforeach
    </select>
  </div>