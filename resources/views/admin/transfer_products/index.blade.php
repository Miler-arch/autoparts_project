@extends('layouts.admin')

@section('title', 'Gestión de Transferencias de Productos')
    
@section('content')
    <div class="content-wrapper">
            <h3 class="text-center page-title">
                Gestión de Transferencias de Productos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Transferencias de Productos</li>
                </ol>
            </nav>


        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="list">Lista de Transferencias de Productos</h4>
                            <div>                  
                                <div>
                                    <a href="{{ route('transfers.create') }}"  class="btn btn-success">+ Nueva Transferencia</a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <table id="detalle" class="table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Almacen Origen</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Almacen Destino</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transfers as $transfer)
                                        <tr>
                                            <th scope="row">{{ $transfer->id }}</th>
                                            <td>{{ $transfer->warehouse_from->name }}</td>
                                            <td>{{ $transfer->product->name }}</td>
                                            <td>{{ $transfer->quantity }}</td>
                                            <td>{{ $transfer->warehouse_to->name }}</td>
                                            <td>
                                                <a href="{{ route('transfers.show',$transfer->id) }}" class="btn btn-success">Ver Reporte</a>
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
                title: 'Transferencia de Producto registrada exitosamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection