@extends('layouts.admin')

@section('title', 'Registrar Categoría')
    
@section('content')
    <div class="content-wrapper">
        <div >
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
                    <li class="breadcrumb-item active">Registrar Categoría</li>
                </ol>
            </nav>
        </div>
        <div class="container ">
            <div class="abs-center">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 class="text-center text-white">REGISTRAR NUEVA CATEGORÍA</h1>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'class' => 'registro']) !!}
                            @include('admin.category._form')
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success mr-2">+ Registrar</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-info">Cancelar</a>
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
                title: 'Categoría registrada con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection

