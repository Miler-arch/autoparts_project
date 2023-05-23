@extends('layouts.admin')

@section('title', 'Gestión de Clientes')
    
@section('content')
    <div class="content-wrapper">
        <div >
            <h3 class="page-title text-center">
                Gestión de Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Cliente</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="list">Clientes</h4>
                            <div>
                                <div>
                                    <a href="{{ route('clients.create') }}" class="btn btn-success">+ Agregar Cliente</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table id="detalle" class="table">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Carnet de identidad</th>
                                        <th>Teléfono / Celular</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <th scope="row">{{ $client->id }}</th>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->dni }}</td>
                                            <td>{{ $client->phone }}</td>
                                            <td>
                                                {!! Form::open(['route' => ['clients.destroy',$client], 'method' => 'DELETE']) !!}

                                                    <a href="{{ route('clients.edit', $client) }}" title="Editar" class="btn btn-warning p-2">
                                                        <i class="far fa-edit" style="color: black"></i>
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
        title: 'Cliente registrado con éxito',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif
@endsection
