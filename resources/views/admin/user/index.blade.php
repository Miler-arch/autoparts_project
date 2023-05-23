@extends('layouts.admin')

@section('title', 'Gestion de Usuarios')
    
@section('create')
{{-- <li class="nav-item d-none d-lg-flex">
    <a class="nav-link" href="{{ route('users.create') }}">
        <span class="btn btn-primary">+ Crear Categoria</span>
    </a>
</li> --}}
@endsection

@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none
        }
    </style> 
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Gestion de Usuarios
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Usuarios</h4>
                            <div class="btn btn-success mb-4"> 
                                    <a class="text-white" href="{{ route('users.create') }}">Registrar Usuario</a>
                              
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="detalle" class="table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Correo Electronico</th>
                                        <th>Roles</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @forelse ($user->roles as $role)
                                                    <span class="badge badge-info">{{ $role->name }}</span>
                                                @empty
                                                    <span class="badge badge-danger">Sin rol asignados</span>
                                                @endforelse
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['users.destroy',$user], 'method' => 'DELETE']) !!}

                                                    <a href="{{ route('users.edit', $user) }}" title="Editar" class="btn btn-warning" style="padding:6px;">
                                                        <i class="far fa-edit"></i>
                                                    </a>

                                                    <button type="submit" title="Eliminar" class="btn btn-danger" style="padding:6px;">
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
    {!! Html::script('melody/js/data-table.js') !!}
@endsection