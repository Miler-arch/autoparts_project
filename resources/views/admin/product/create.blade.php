@extends('layouts.admin')

@section('title', 'Registrar Artículo')
    
@section('content')
    <div class="content-wrapper">
        <div >
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Lista de Artículos</a></li>
                    <li class="breadcrumb-item active">Registrar Artículo</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="row justify-content-center">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h1 class="text-center text-white">REGISTRAR NUEVO ARTÍCULO</h1>
                        </div>
                        <div class="card-body">
                            
                            {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'files' => true, 'class' => 'registro']) !!} 
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Nombre : </label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    <div class="mt-2">
                                        @if ($errors->has('name'))
                                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                         
                                </div>
                           

                                <div class="form-group col-6">
                                    <label for="codigo">Código : </label>
                                    <input type="text" name="codigo" id="codigo" class="form-control">
                                    <div class="mt-2">
                                        @if ($errors->has('codigo'))
                                            <div class="alert alert-danger">{{ $errors->first('codigo') }}</div>
                                        @endif
                                    </div> 
                                </div>
                          

                                <div class="form-group col-6">
                                  <label for="code">Código de Barras :</label>
                                  <input type="text" name="code" id="code" class="form-control">
                                  <small id="helpId" class="text-muted">(Campo opcional)</small>
                                </div>

                                <div class="form-group col-6">
                                    <label for="price">Precio de Venta : </label>
                                    <input type="number" name="price" id="price" class="form-control">
                                    <div class="mt-2">
                                        @if ($errors->has('price'))
                                            <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                                        @endif
                                    </div>
                                </div>
                             
                                
                                <div class="form-group col-6">
                                    <label for="stock">Stock Actual : </label>
                                    <input type="number" name="stock" id="stock" class="form-control">
                                </div>
                          
                                <div class="form-group col-6">
                                    <label for="provider_id">Proveedor : </label>
                                    <select class="form-control" name="provider_id" id="provider_id">
                                        <option> == Seleccione un Proveedor == </option>
                                        @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>                                      
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        @if ($errors->has('provider_id'))
                                            <div class="alert alert-danger">{{ $errors->first('provider_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                        
                                <div class="form-group col-6">
                                    <label for="category_id">Categoria : </label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option> == Seleccione una Categoria == </option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>                                      
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        @if ($errors->has('category_id'))
                                            <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                                        @endif
                                    </div>
                                </div>
          
                                <div class="form-group col-6">
                                    <label for="medida_id">Medida : </label>
                                    <select class="form-control" name="medida_id" id="medida_id">
                                        <option> == Seleccione una Medida == </option>
                                        @foreach ($medidas as $medida)
                                        <option value="{{ $medida->id }}">{{ $medida->name }}</option>                                      
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        @if ($errors->has('medida_id'))
                                            <div class="alert alert-danger">{{ $errors->first('medida_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                        
                                <div class="form-group col-6">
                                    <label for="marca_id">Marca : </label>
                                    <select class="form-control" name="marca_id" id="marca_id">
                                        <option> == Seleccione una Marca == </option>
                                        @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->name }}</option>                                      
                                        @endforeach
                                    </select>
                                    <div class="mt-2">
                                        @if ($errors->has('marca_id'))
                                            <div class="alert alert-danger">{{ $errors->first('marca_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                          
                                <div class="card-body">
                                    <h4 class="card-title d-flex">Imagen :
                                        <small class="ml-auto align-self-end text-info">
                                           Seleccionar Archivo
                                        </small>
                                    </h4>
                                    <input class="dropify" type="file" id="picture" name="picture">
                                    <div class="mt-2">
                                        @if ($errors->has('picture'))
                                            <div class="alert alert-danger">{{ $errors->first('picture') }}</div>
                                        @endif
                                    </div>
                                </div>
          
                                    
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="list">Lista de Almacenes</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <th>Selecciona</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($warehouses as $w)
                                                        <tr>
                                                            <td><input type="checkbox" class="warehouse_class" name="warehouses_id[]" value="{{$w->id}}"></td>
                                                            <td>{{ $w->name }}</td>
                                                            <td><input type="text" required id="warehouses_id_{{$w->id}}" disabled name="warehouse_{{$w->id}}" class="form-control"></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">+ Registrar</button>
                                <a href="{{ route('products.index') }}" class="btn btn-info">Cancelar</a>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
            </div>
        </div>
        </div>

    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/dropify.js') !!}
    <script>
        $(document).ready(function(){
            $(".warehouse_class").click(function(){
                let id = $(this).val();
                if($(this).is(":checked")){
                    $("#warehouses_id_"+id).attr("disabled",false);
                }else{
                    $("#warehouses_id_"+id).val("").attr("disabled",true);
                }
            });
        });
    </script>

    @if (session('registro') == 'ok')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Artículo registrado con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

@endsection