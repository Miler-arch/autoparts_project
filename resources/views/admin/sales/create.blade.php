@extends('layouts.admin')

@section('title', 'Registrar Venta')
    
@section('styles')
     {!! Html::style('select/dist/css/bootstrap-select.min.css') !!}
@endsection

@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                <li class="breadcrumb-item active">Nueva Venta</li>
            </ol>
        </nav>
   

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div>
                        <h4 class="card-header text-center mb-2 bg-dark text-white">NUEVA VENTA</h4>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'sales.store', 'method' => 'POST', 'onsubmit="return checkForm()"', 'class' => 'ingreso']) !!}

                            @include('admin.sales._form')

                            <button type="submit" id="btn_enviar" class="btn btn-success mr-2">+ Registrar</button>
                            <a href="{{ route('sales.index') }}" class="btn btn-warning">Cancelar</a>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}
<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>
@if (session('registro') == 'ok')
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Venta realizada con éxito',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
<script>

    $(document).ready(function() {
        $("#agregar").click(function () {
            agregar();
        });
    });

    var cont = 0;
    total = 0;
    subtotal = [];

    $("#tabla_detalles").hide();
    $("#btn_enviar").hide();
	$("#product_id").change(mostrarValores);

	function mostrarValores() {
		datosProducto = document.getElementById('product_id').value.split('_');
		$("#price").val(datosProducto[2]);
		$("#stock").val(datosProducto[1]);
	}

    var product_id = $('#product_id');
        product_id.change(function(){
            $.ajax({
                url:"{{route('get_products_by_id') }}",
                method: 'GET',
                data: {
                    product_id: product_id.val(),
                },
                success: function(data){
                    $("#price").val(data.price);
                    $("#stock").val(data.stock);
                    $("#codigo").val(data.codigo);
                }
            });
        });



   
    $(obtener_registro());
    function obtener_registro(codigo){
        $.ajax({
            url:"{{route('get_products_by_barcode')}}",
            type: 'GET',
            data: {
                codigo:codigo
            },
            success:function(data){
                $("#price").val(data.price);
                $("#stock").val(data.stock);
            }
        });
    }
    $(document).on('keyup','#codigo', function(){
        var valorResultado = $(this).val();
        if(valorResultado!=""){
            obtener_registro(valorResultado);
        }else{
            obtener_registro();
        }
    })

    function agregar() {
        datosProducto = document.getElementById('product_id').value.split('_');
        product_id = datosProducto[0];
        
        producto = $("#product_id option:selected").text();
        quantity = $("#quantity").val();
        // discount = $("#discount").val();
        price = $("#price").val();
        stock = $("#stock").val();
        // impuesto = $("#tax").val();
        warehouse = $("#warehouse_id").val();
        
        if (product_id != "" && quantity != "" && price != "" && stock != "" && warehouse) {
            if (parseInt(stock) >= parseInt(quantity)) {
                subtotal[cont] = (quantity * price);
                // subtotal[cont] = (quantity * price) - (quantity * price * discount / 100);
                total = total + subtotal[cont];
                var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="warehouse[]" value="'+ warehouse +'"><input type="hidden" name="product_id[]" value="' + product_id + '">' + producto + '</td><td><input type="hidden" name="price[]" value="' + parseFloat(price).toFixed(2) + '"><input class="form-control" type="number"  value="' + parseFloat(price).toFixed(2) + '" disabled></td><input class="form-control" type="number" value="' + parseFloat + '" disabled></td><td><input type="hidden"  name="quantity[]" value="' + quantity + '"><input class="form-control" type="number" value="' + quantity + '" disabled></td><td align="right"> Bs. ' + parseFloat(subtotal[cont].toFixed(2)) + '</td></tr>';

                // <td><input type="hidden" name="discount[]" value="' + parseFloat + '">
                // '" disabled></td><td><input type="hidden" name="discount[]" value="' + parseFloat(discount) + '"> <input class="form-control" type="number" value="' + parseFloat(discount) + '" disabled></td><td><input type="hidden"  name="quantity[]" value="' + 
                cont ++;
                limpiar();
                totales();
                evaluar();
                $('#detalles').append(fila);
            } else {
                alert('Error: La cantidad supera el stock actual');
            }
        } else {
            alert('Error: Debe rellenar todos los campos');
        }
    }

    function limpiar() {
        $("#quantity").val("");
        $("#price").val("");
    }

    function totales() {
        $("#total").html("Bs. " + total.toFixed(2));
        // total_impuesto = total * impuesto /100;
        // total_impuesto = total;
        // total_pagar = total + total_impuesto;
        total_pagar = total;
        // $("#total_impuesto").html("Bs. " + total_impuesto.toFixed(2));
        $("#total_pagar_html").html("Bs. " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
    }
    
    function evaluar() {
        if (total > 0) {
            $("#tabla_detalles").show();
            $("#btn_enviar").show();
        }else{
            $("#tabla_detalles").hide();
            $("#btn_enviar").hide();
        }
    }

    function checkForm() {
        let client_id = $("#client_id").val();
        let total_0 = (total > 0);
        
        if(!client_id) { 
            alert("No se seleccionó ningún cliente.");
            return false;
        }
        
        if(!total) {
            alert("El total de venta debe ser mayor que 0.");
            return false;
        }
        
        return true;
    }

    function eliminar(index) {
        total = total - subtotal[index];
        // total_impuesto = total * impuesto /100;
        total_pagar_html = total;
        // total_pagar_html = total + total_impuesto;
        $("#total").html("Bs." + total);
        // $("#total_impuesto").html("Bs. " + total_impuesto);
        $("#total_pagar_html").html("Bs. " + total_pagar_html);
        $("#total").val(total_pagar_html.toFixed(2));
        $("#fila" + index).remove();
        evaluar();
    }
    </script>
    
@endsection
