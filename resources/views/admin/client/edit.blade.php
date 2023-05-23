@extends('layouts.admin')

@section('title', 'Editar Cliente')
    
@section('options')
    {{-- <li class="nav-item nav-settings d-none d-lg-block">
        <a href="#" class="nav-link">
            <i class="fa fa-elipsis-h"></i>
        </a>
    </li> --}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Editar Cliente
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Cliente</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div>
        <div class="container ">
            <div class="abs-center">
                <div class="card card-primary">
                    <div class="card-header" style="background-color:rgb(57, 62, 66); color:white">
                        <h1 style="text-align:center">EDITAR CLIENTE</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::model($client, ['route' => ['clients.update', $client], 'method' => 'PUT']) !!}

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
                          </div>
                          
                          <div class="form-group">
                            <label for="dni">Carnet de identidad</label>
                            <input type="text" name="dni" id="dni" class="form-control" value="{{ $client->dni }}" required>
                          </div>
                          
                    
                          <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $client->address }}">
                          </div>
                          
                          <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $client->phone }}">
                          </div>
                          
                          <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}">
                          </div>
                          <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success mr-2">Actualizar</button>
                            <a href="{{ route('clients.index') }}" class="btn btn-info">Cancelar</a>
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