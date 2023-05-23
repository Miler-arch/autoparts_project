@extends('layouts.admin')

@section('title', 'Registrar Proveedor')
    
@section('content')
    <div class="content-wrapper">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('providers.index') }}">Proveedor</a></li>
                    <li class="breadcrumb-item active">Registrar Proveedor</li>
                </ol>
            </nav>
        </div>

          <div class="container ">
            <div class="abs-center">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 class="text-white text-center">REGISTRAR NUEVO PROVEEDOR</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'providers.store', 'method' => 'POST', 'class' => 'registro']) !!}

                            <div class="form-group">
                                <label for="name">Nombre :</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                            <div class="text-center card-footer">
                                <button type="submit" class="btn btn-success mr-2">+ Registrar</button>
                                <a href="{{ route('providers.index') }}" class="btn btn-info">Cancelar</a>
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