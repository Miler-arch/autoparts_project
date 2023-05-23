@extends('layouts.admin')

@section('title', 'Editar Medida')
    
@section('options')
    {{-- <li class="nav-item nav-settings d-none d-lg-block">
        <a href="#" class="nav-link">
            <i class="fa fa-elipsis-h"></i>
        </a>
    </li> --}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div >

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('medidas.index') }}">Categoria</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div>
        <div class="container ">
            <div class="abs-center">
                <div class="card card-primary">
                    <div class="card-header" style="background-color:rgb(57, 62, 66); color:white">
                        <h1 style="text-align:center">EDITAR MEDIDA</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::model($medida, ['route' => ['medidas.update', $medida], 'method' => 'PUT']) !!}

                          <div class="form-group">
                            <label for="name">Nombre :</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $medida->name }}" placeholder="" required>
                          </div>

                          <div class="text-center card-footer">
                            <button type="submit" class="btn btn-success mr-2">Actualizar</button>
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
    
@endsection