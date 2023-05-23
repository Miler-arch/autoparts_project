@extends('layouts.admin')

@section('title', 'Registrar Cliente')
    
@section('content')
    <div class="content-wrapper">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Cliente</a></li>
                    <li class="breadcrumb-item active">Registrar Cliente</li>
                </ol>
            </nav>
        </div>

        <div class="container ">
            <div class="abs-center">
                <div class="card card-primary">
                    <div class="card-header" style="background-color:rgb(57, 62, 66); color:white">
                        <h1 style="text-align:center">REGISTRAR NUEVO CLIENTE</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'clients.store', 'method' => 'POST', 'class' => 'regitro']) !!}

                            @include('admin.client._form')
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">+ Registrar</button>
                                <a href="{{ route('clients.index') }}" class="btn btn-info">Cancelar</a>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')    @if (session('registro') == 'ok')
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