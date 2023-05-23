<div class="row">
    <div class="form-group  col-12 col-md-6">
        <label for="nro_compra">N°. Compra:</label>
        <input type="text" name="nro_compra" id="nro_compra" value="0" class="form-control">
    </div>
      
    <div class="form-group  col-12 col-md-6">
        <label for="provider_id">Proveedor :</label>
        <select class="form-control" name="provider_id" id="provider_id" required>
          <option disabled>== Seleccione el Proveedor ==</option>
          @foreach ($providers as $purchase)
              <option value="{{ $purchase->id }}">{{ $purchase->name }}</option>        
          @endforeach
        </select>
    </div>
      
    <div class="form-group  col-12 col-md-6">
        <label for="tax">Impuesto :</label>
        <input type="number" name="tax" id="tax" value="0" class="form-control">
    </div>

    <div class="form-group  col-12 col-md-4">
        <label for="warehouse_id">Almacen :</label>
        <select class="form-control" name="warehouse_id" id="warehouse_id" required>
          <option disabled>== Seleccione Almacen ==</option>
          @foreach ($warehouses as $wh)
              <option value="{{ $wh->id }}">{{ $wh->name }} </option>        
          @endforeach
        </select>
    </div>
      
    <div class="form-group  col-12 col-md-6">
        <label for="product_id">Artículo :</label>
        <select class="form-control" name="product_id" id="product_id">
          <option disabled>== Seleccione el Artículo ==</option>
          @foreach ($products as $product)
              <option value="{{ $product->id }}">{{ $product->name }} </option>        
          @endforeach
        </select>
    </div>
      
    <div class="form-group  col-12 col-md-2">
        <label for="quantity">Cantidad</label>
        <input type="number" name="quantity" id="quantity" value="0" class="form-control">
    </div>
      
    <div class="form-group  col-12 col-md-6">
        <label for="price">Precio :</label>
        <input type="number" name="price" id="price" class="form-control">
    </div>

    <div class="form-group col-12 col-md-6">
		<button type="button" id="agregar" class="btn btn-info btn-block mt-4">+ Agregar Producto</button>
	</div>
</div>

<hr>
<hr>

<div class="form-group" id="tabla_detalles">
    <h4 class="card-title">Detalle de compra</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">

            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span></p>
                    </th>
                </tr>
                <tr id="dvOcultar">
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ 0.00</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span>
                            <input type="hidden" name="total" id="total_pagar">
                        </p>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>