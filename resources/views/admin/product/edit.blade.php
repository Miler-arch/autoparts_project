@extends('layouts.admin')

@section('title', 'Editar Artículo')
    
@section('options')
    {{-- <li class="nav-item nav-settings d-none d-lg-block">
        <a href="#" class="nav-link">
            <i class="fa fa-elipsis-h"></i>
        </a>
    </li> --}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div>
<a href="https://www.instagram.com/arnez_milerr/?hl=es">Sigueme papu</a>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Producto</a></li>
                    <li class="breadcrumb-item active">Editar Artículo</li>
                </ol>
            </nav>
        </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header" style="background-color:rgb(57, 62, 66); color:white">
                            <h1 style="text-align:center">EDITAR ARTÍCULO</h1>
                        </div>
                        <div class="card-body">

                        {!! Form::model($product, ['route' => ['products.update', $product], 'method' => 'PUT', 'files' => true]) !!}
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Nombre : </label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="codigo">Código : </label>
                                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="" value="{{ $product->codigo }}" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="code">Código de Barras :</label>
                                <input type="text" name="code" id="code" class="form-control" aria-describedby="helpId" value="{{ $product->code }}">
                                <small id="helpId" class="text-muted">(Campo opcional)</small>
                              </div>
                            
                            <div class="form-group col-6">
                                <label for="price">Precio de Venta: </label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="stock">Stock Actual : </label>
                                <input type="number" name="stock" id="stock" class="form-control" placeholder="" value="{{ $product->stock }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="provider_id">Proveedor : </label>
                                <select class="form-control" name="provider_id" id="provider_id">
                                    <option> == Seleccione un Proveedor == </option>
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}" 
                                        @if ($provider->id == $product->provider_id)
                                            selected
                                        @endif>
                                            {{ $provider->name }}
                                        </option>                                      
                                    @endforeach
                                </select>
                            </div>

                            
                            <div class="form-group col-6">
                              <label for="category_id">Categoria : </label>
                              <select class="form-control" name="category_id" id="category_id">
                                  <option> == Seleccione una Categoria == </option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($category->id == $product->category_id)
                                            selected
                                        @endif
                                        >
                                        {{ $category->name }}
                                    </option>                                      
                                  @endforeach
                              </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="medida_id">Medida : </label>
                                <select class="form-control" name="medida_id" id="medida_id">
                                    <option> == Seleccione una Medida == </option>
                                    @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id }}" @if ($medida->id == $product->medida_id)
                                        selected
                                        @endif>{{ $medida->nombre }}</option>                                      
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="marca_id">Marca : </label>
                                <select class="form-control" name="marca_id" id="marca_id">
                                    <option> == Seleccione una Marca == </option>
                                    @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}" @if ($marca->id == $product->marca_id)
                                        selected
                                        @endif>{{ $marca->nombre }}</option>                                      
                                    @endforeach
                                </select>
                            </div>

                                   
                            {{-- <div class="form-group col-6">
                                <label for="image">Imagen : </label>
                                <div class="custom-file mb-4 ">
                                    <input type="file" class="custom-file-input" id="image" name="image" lang="es">
                                    <label for="image" class="custom-file-label">Seleccionar Archivo</label>
                                </div>
                            </div> --}}

                            <div class="card-body">
                                <h4 class="card-title d-flex">Imagen :
                                    <small class="ml-auto align-self-end">
                                        <a href="#" class="font-weight-light"
                                        >Seleccionar Archivo
                                        </a>
                                    </small>
                                </h4>
                                <input type="file" class="dropify" name="image" id="image">
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Lista de Almacenes</h3>
                                        </div>
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
                                                        <td><input type="checkbox" id="warehouses_checkbox_{{$w->id}}" class="warehouse_class" name="warehouses_id[]" value="{{$w->id}}"></td>
                                                        <td>{{ $w->name }}</td>
                                                        <td><input type="text" required id="warehouses_id_{{$w->id}}" disabled name="warehouse_{{$w->id}}" class="form-control"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>    
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">Actualizar</button>
                                <a href="{{ route('products.index') }}" class="btn btn-info">Cancelar</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('melody/js/dropify.js') !!}
    <script>
        $(document).ready(function(){
            @foreach($warehouses_selected as $ws)
                $("#warehouses_checkbox_{{$ws->warehouse_id}}").attr("checked","checked");
                $("#warehouses_id_{{ $ws->warehouse_id }}").val("{{ $ws->quantity }}").attr("disabled",false);
            @endforeach

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
@endsection