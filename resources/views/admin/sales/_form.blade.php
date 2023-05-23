<div class="row">
	<div class="form-group col-6 col-md-6">
        <label for="client_id">Cliente :</label>
        <select class="form-control selectpicker" data-live-search="true" name="client_id" id="client_id" required>
          <option disabled selected>== Seleccione el Cliente ==</option>
          @foreach ($clients as $client)
              <option value="{{ $client->id }}">{{ $client->name }}</option>        
          @endforeach
        </select>
    </div>


    <div class="form-group col-6 col-md-6">
        <label for="encargado">Responsable :</label>
        <input type="text" name="encargado" id="encargado" class="form-control" required>
    </div>

    {{-- <div class="form-group col-12 col-md-2">
        <label for="codigo">Código del itém :</label>
        <input type="text" name="codigo" id="codigo" class="form-control">
    </div> --}}
    
    {{-- <div class="form-group col-12 col-md-5">
        <label for="tax">Impuesto</label>
        <input type="number" name="tax" id="tax" value="0" class="form-control">
    </div> --}}

    <div class="form-group col-12 col-md-2">
        <label for="number_box">N° de Caja :</label>
        <input type="number" name="number_box" id="number_box" class="form-control" required>
    </div>

    <div class="form-group col-12 col-md-2">
        <label for="transport">Transporte :</label>
        <input type="text" name="transport" id="transport" class="form-control" required>
    </div>

    <div class="form-group col-12 col-md-2">
        <label for="fech_venc">Fecha de Vencimiento :</label>
        <input type="date" name="fech_venc" id="fech_venc" class="form-control" required>
    </div>

    <div class="form-group col-12 col-md-3">
        <label for="credit_days">Crédito :</label>
        <select class="form-control" name="credit_days" id="credit_days">
            <option selected>Seleccione una opción</option>
            <option value="Contado">Contado</option>
            <option value="Crédito (15 dias)">Crédito (15 dias)</option>
            <option value="Crédito (20 dias)">Crédito (20 dias)</option>
            <option value="Crédito (30 dias)">Crédito (30 dias)</option>
            <option value="Crédito (45 dias)">Crédito (45 dias)</option>
        </select>
    </div>

    <div class="form-group col-12 col-md-3">
        <label for="warehouse_id">Almacén :</label>
        <select class="form-control" name="warehouse_id" id="warehouse_id" required>
          <option>== Seleccione Almacen ==</option>
          @foreach ($warehouses as $wh)
              <option value="{{ $wh->id }}">{{ $wh->name }} </option>        
          @endforeach
        </select>
    </div>
    

    <div class="form-group col-6 col-md-6">
        <label for="product_id">Producto / Código Ítem :</label>
        <select class="form-control selectpicker" data-live-search="true" name="product_id" id="product_id" required>
            <option disabled selected>== Seleccione el Producto ==</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}_{{ $product->stock }}_{{ $product->price }}">{{ $product->name }} - {{ $product->codigo }}</option>        
            @endforeach
        </select>
    </div>
    
    
    <div class="form-group col-12 col-md-6">
        <label for="stock">Stock :</label>
        <input type="number" name="stock" id="stock" class="form-control" disabled>
    </div>

        <div class="form-group col-12 col-md-2">
        <label for="price" >Precio :</label>
        <input type="number" name="price" id="price" class="form-control">
    </div>  
    
    <div class="form-group col-12 col-md-2">
        <label for="quantity">Cantidad :</label>
        <input type="number" name="quantity" id="quantity" value="0" class="form-control">
    </div>
    
    {{-- <div class="form-group col-12 col-md-6">
        <label for="discount">Porcentaje de descuento</label>
        <input type="number" name="discount" id="discount" value="0" class="form-control">
    </div> --}}


    <div class="form-group  col-6 col-md-2">
        <label for="destino">Destino :</label>
        <input type="text" name="destino" id="destino" class="form-control">
    </div>
    
    <div class="form-group  col-6 col-md-2">
        <label for="talonario">Talonario :</label>
        <input type="text" name="talonario" id="talonario" class="form-control">
    </div>
    
	<div class="form-group col-12 col-md-6">
		<button type="button" id="agregar" class="btn btn-info btn-block mt-4">+ Agregar Producto</button>
	</div>

</div>

<hr>

<div class="form-group" id="tabla_detalles">
    <h4>Detalle de venta</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">

            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    {{-- <th>Descuento</th> --}}
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
                        <p align="right"><span id="total">Bs. 0.00</span></p>
                    </th>
                </tr>
                {{-- <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ 0.00</span></p>
                    </th>
                </tr> --}}
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
            <tbody>
            </tbody>
        </table>
    </div>
</div>
