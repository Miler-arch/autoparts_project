@extends('layouts.admin')

@section('title', 'Registrar Transferencia')
    
@section('content')
    <div class="content-wrapper">
        <div >
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('transfers.index') }}">Transferencias</a></li>
                    <li class="breadcrumb-item active">Registrar Transferencia</li>
                </ol>
            </nav>
        </div>
        <div class="container ">
            <div class="abs-center">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 class="text-center text-white">REGISTRAR NUEVA TRANSFERENCIA DE INVENTARIO</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'transfers.store', 'method' => 'POST', 'id'=>'send_create', 'onsubmit' => 'return checkForm()', 'class' => 'registro']) !!}

                            @include('admin.transfer_products._form')

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">+ Transferir</button>
                                <a href="{{ route('transfers.index') }}" class="btn btn-info">Cancelar</a>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#warehouse_from_id").change(function(){
                let data = JSON.parse($("#warehouse_from_id option:selected").attr("data-products"));
                console.log(data);
                $("#product_id").empty();
                $("#product_id").append("<option value=''>Selecciona</option>");
                $.each(data, function(v,e){
                    $("#product_id").append("<option data-quantity='"+e.pivot.quantity+"' value='"+e.id+"'>"+e.name+" ("+e.pivot.quantity+")</option>");
                });
            });

            $("body").on('change','#product_id', function(){
                let quantity = $("#product_id option:selected").attr("data-quantity");
                $("#current_quantity").val(quantity);
            });

            
        });
        
        
    </script>
    
    <script>
        function checkForm() {
            let from = $("#warehouse_from_id").val();
            let to = $("#warehouse_to_id").val();
            let quantity_id = parseFloat($("#quantity").val());
            let product_id = $("#product_id").val();
        
            if(!product_id) {
                alert("Debe seleccionar un producto."); 
                return false; 
            }
        
            if(!from) { 
                alert("Debe seleccionar un almacén de origen"); 
                return false; 
            }
                
            if(!to) {
                alert("Debe seleccionar un almacén de destino"); 
                return false; 
            }
                
            if(!quantity_id) {
                alert("La cantidad debe ser mayor a 0."); 
                return false; 
            }
                
            let quantity_selected = parseInt($("#current_quantity").val());
            let quantity = parseInt($("#quantity").val());
            if(quantity > quantity_selected){
                alert("No puedes transferir un monto mayor a la existencia");
                return false;
            }
            
            return true;
        }
    
    </script>

    
    @if (session('registro') == 'ok')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Transferencia registrada con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    
@endsection
