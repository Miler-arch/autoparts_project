@extends('layouts.admin')

@section('title', 'Gestión de Articulos')

@section('content')
    <div class="content-wrapper">
        <h3 class="page-title text-center">
            Gestión de Artículos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                <li class="breadcrumb-item active">Artículos</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="list">Lista de Artículos</h4>
                            <div class="form-group  col-12 col-md-4">
                                <select class="form-control" name="warehouse_id" id="warehouse_id">
                                <option>== TODOS los Almacenes ==</option>
                                @foreach ($warehouses as $wh)
                                    <option value="{{ $wh->id }}">{{ $wh->name }} </option>        
                                @endforeach
                                </select>
                            </div>
                            <div>
                                    <a href="{{ route('products.create') }}" class="btn btn-success">+ Agregar Artículo</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="detalle" class="table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Stock<br>Consolidado</th>
                                        <th>Almacen</th>
                                        <th>Stock x<br>Almacen</th>
                                        <th>Estado</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>
                                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ $product->codigo }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->wh_id }} - {{ $product->wh_name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                @if ($product->status == 'ACTIVE' )
                                                    <a href="{{ route('products.change.status', $product) }}" class="btn btn-success p-1" title="Activo">
                                                            Activo <i class="fas fa-check"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('products.change.status', $product) }}" class="btn btn-danger p-1" title="Desactivado">
                                                            Desactivado <i class="fas fa-times"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{asset('image/'.$product->image )}}"  class="img-lg rounded-circle">
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['products.destroy',$product], 'method' => 'DELETE', 'class' => 'form-eliminar']) !!}
                                                    @if (isset($product->wh_id))
                                                        <a href="{{ route('products.pdf', ['product' => $product, 'warehouse_id' => $product->wh_id]) }}" title="Kardex x Almacen" class="btn btn-primary p-2" target="_blank">
                                                            <i class="fas fa-clipboard" style="color: white"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('products.pdf_all', ['product' => $product]) }}" title="Kardex Consolidado" class="btn btn-primary p-2" target="_blank">
                                                        <i class="fas fa-clipboard-list" style="color: white"></i>
                                                    </a>
                                                    <a href="{{ route('products.edit', $product) }}" title="Editar" class="btn btn-warning p-2">
                                                        <i class="far fa-edit" style="color: white"></i>
                                                    </a>

                                                    <button type="submit" title="Eliminar" class="btn btn-danger p-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>

                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
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

    @if (session('mensaje') == 'ok')
    <script>
        Swal.fire({
        icon: 'error',
        title: 'La categoría no puede ser eliminada porque tiene artículos asociados.',
        })
    </script>
    @endif

    <script>
        $('.form-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: '¿Esta seguro?',
        text: "La categoría se eliminará definitivamente.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.value) {
        this.submit();
        }
    })
    });
    </script>

@endsection