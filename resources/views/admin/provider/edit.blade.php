@extends('layouts.admin')

@section('title', 'Editar Proveedor')

@section('content')
    <div class="content-wrapper">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Proveedor</a></li>
                    <li class="breadcrumb-item active">Editar Proveedor</li>
                </ol>
            </nav>
        </div>

        <div class="container ">
            <div class="abs-center">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 class="text-center text-white">EDITAR PROVEEDOR</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::model($provider, ['route' => ['providers.update', $provider], 'method' => 'PUT']) !!}
                            <div class="form-group">
                                <label for="name">Nombre :</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ $provider->name }}" required>
                            </div>      

                            <div class="text-center card-footer">
                                <button type="submit" class="btn btn-success mr-2">Actualizar</button>
                                <a href="{{ route('providers.index') }}" class="btn btn-info">Cancelar</a>
                            </div>
                  
                        {!! Form::close() !!}
                    </div>
                   
                </div>
            </div>
        </div>

    </div>
@endsection
