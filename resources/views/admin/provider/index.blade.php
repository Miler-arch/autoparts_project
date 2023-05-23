@extends('layouts.admin')

@section('title', 'Gestión de Proveedores')
    
@section('content')
    <div class="content-wrapper">
        <div>
            <h3 class="text-center page-title">
                Gestión de Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Proveedor</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="list">Proveedores</h4>
                            <div>
                                <div >
                                    <a href="{{ route('providers.create') }}" class="btn btn-success">+ Agregar Proveedor</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="detalle" class="table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($providers as $provider)
                                        <tr>
                                            <th scope="row">{{ $provider->id }}</th>
                                            <td>
                                                {{ $provider->name }}
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['providers.destroy',$provider], 'method' => 'DELETE', 'class' => 'form-eliminar']) !!}

                                                    <a href="{{ route('providers.edit', $provider) }}" title="Editar" class="btn btn-warning p-2">
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
                title: 'Proveedor registrado con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('mensaje') == 'ok')
    <script>
        Swal.fire({
        icon: 'error',
        title: 'El proveedor no puede ser eliminado porque tiene artículos asociados.',
        })
    </script>
    @endif

    <script>
        $('.form-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: '¿Esta seguro?',
        text: "El proveedor se eliminará definitivamente.",
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
