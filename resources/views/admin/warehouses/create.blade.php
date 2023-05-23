@extends('layouts.admin')

@section('title', 'Registrar Almacen')
    
@section('content')
    <div class="content-wrapper">
        <div >
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Almacenes</a></li>
                    <li class="breadcrumb-item active">Registrar Almacen</li>
                </ol>
            </nav>
        </div>
        <div class="container ">
            <div class="abs-center">
                <div class="card card-primary">
                    <div class="card-header bg-dark">
                        <h1 class="text-center text-white">REGISTRAR NUEVO ALMACEN</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'warehouses.store', 'method' => 'POST']) !!}

                            @include('admin.warehouses._form')

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">+ Registrar</button>
                                <a href="{{ route('warehouses.index') }}" class="btn btn-info">Cancelar</a>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection