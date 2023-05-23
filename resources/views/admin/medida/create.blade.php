@extends('layouts.admin')

@section('title', 'Registrar Medida')
    
@section('content')
    <div class="content-wrapper">
        <div >

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('medidas.index') }}">Medida</a></li>
                    <li class="breadcrumb-item active">Registrar Medida</li>
                </ol>
            </nav>
        </div>

        <div class="container ">
            <div class="abs-center">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h1 class="text-center">REGISTRAR NUEVA MEDIDA</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'medidas.store', 'method' => 'POST', 'class' => 'registro']) !!}

                            @include('admin.medida._form')
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">+ Registrar</button>
                                <a href="{{ route('medidas.index') }}" class="btn btn-info">Cancelar</a>
                            </div>

                        {!! Form::close() !!}

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
@endsection