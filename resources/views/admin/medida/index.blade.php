@extends('layouts.admin')

@section('title', 'Gestión de Medidas')
    
@section('content')
    <div class="content-wrapper">
        <div>
            <h3 class="text-center page-title">
                Gestión de Medidas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Medida</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="list">Medidas</h4>
                            <div>
                                <div>
                                    <a href="{{ route('medidas.create') }}" class="btn btn-success">+ Agregar Medida</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="detalle" class="table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        {{-- <th>Código</th> --}}
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medidas as $medida)
                                        <tr>
                                            <th scope="row">{{ $medida->id }}</th>
                                            <td>{{ $medida->name }}</td>
                                            {{-- <td>{{ $medida->codigo }}</td> --}}
                                            <td>
                                                {!! Form::open(['route' => ['medidas.destroy',$medida], 'method' => 'DELETE', 'class' => 'form-eliminar']) !!}

                                                    <a href="{{ route('medidas.edit', $medida) }}" title="Editar" class="btn btn-warning p-2">
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
                title: 'Medida registrada con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('mensaje') == 'ok')
    <script>
        Swal.fire({
        icon: 'error',
        title: 'La medida no puede ser eliminada porque tiene artículos asociados.',
        })
    </script>
    @endif

    <script>
        $('.form-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: '¿Esta seguro?',
        text: "La medida se eliminará definitivamente.",
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
