@extends('layouts.admin')

@section('title', 'Editar Marca')
    
@section('content')
    <div class="content-wrapper">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('marcas.index') }}">Categoria</a></li>
                    <li class="breadcrumb-item active">Editar Categoría</li>
                </ol>
            </nav>
        </div>

        <div class="container ">
            <div class="abs-center">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 class="text-center text-white">EDITAR MARCA</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::model($marca, ['route' => ['marcas.update', $marca], 'method' => 'PUT']) !!}

                          <div class="form-group">
                            <label for="name">Nombre :</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $marca->name }}" required>
                          </div>
                          <div class="text-center card-footer">
                            <button type="submit" class="btn btn-success mr-2">Actualizar</button>
                            <a href="{{ route('marcas.index') }}" class="btn btn-info">Cancelar</a>
                          </div>
                    

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
