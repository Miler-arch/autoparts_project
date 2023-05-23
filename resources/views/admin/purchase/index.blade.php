@extends('layouts.admin')

@section('title', 'Gestión de Compras')
    
@section('content')
    <div class="content-wrapper">
     
		    <h3 class="page-title text-center">
                Gestión de Compras
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Compras</li>
                </ol>
            </nav>
   

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="list">Compras</h4>
                            <div>
                                <div>
                                    <a href="{{ route('purchases.create') }}" class="btn btn-success">+ Nueva Compra</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="detalle" class="table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Proveedor</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <th scope="row">{{ $purchase->id }}</th>
                                            <td>{{ $purchase->provider->name }}</td>
                                            <td>{{ date('d-m-Y [H:i:s]', strtotime($purchase->purchase_date)) }}</td>
                                            <td>{{ $purchase->total }}</td>
                                            <td>
                                                @if ($purchase->status == 'VALID' )
                                                <a href="{{-- route('purchases.change.status', $purchase) --}}" class="jsgrid-button btn btn-sm btn-success" title="Activo">
                                                        Validado <i class="fas fa-check"></i>
                                                </a>
                                                @else
                                                <a href="{{-- route('purchases.change.status', $purchase) --}}" class="jsgrid-button btn btn-sm btn-danger" title="Desactivado">
                                                        Cancelado <i class="fas fa-times"></i>
                                                </a>
	          						            @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['purchases.destroy',$purchase], 'method' => 'DELETE', 'onsubmit'=>'return confirm("¿Eliminar compra?")']) !!}

                                           
                                                    <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-info p-2"  title="ver"><i class="far fa-eye"></i></a>
                                                    <a href="{{ route('purchases.pdf', $purchase) }}" target="_blank" class="btn btn-warning p-2" title="pdf"><i class="fas fa-print"></i></a>
                                                    <button type="submit" title="Eliminar" class="btn btn-danger p-2" >
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
            position: 'top right',
            icon: 'success',
            title: 'Compra realizada con éxito.',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    @endif
@endsection