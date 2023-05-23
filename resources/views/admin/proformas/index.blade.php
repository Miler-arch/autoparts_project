@extends('layouts.admin')
@section('title', 'Gestion de ventas')
@section('style')
	<style type="text/css">
		.unstyled-button {
			border: none;
			padding: 0;
			background: none;
			cursor: pointer;
		}
	</style>
@endsection

@section('content')

	<div class="content-wrapper">
	  <div class="page-header">
		    <h3 class="page-title">
		      Proformas
		    </h3>
		    <nav aria-label="breadcrumb">
		  	<ol class="breadcrumb">
		  		<li class="breadcrumb-item"><a href="#">Panel| Administrador</a></li>
		  		<li class="breadcrumb-item active" aria-current="page">Proformas</li>
		  	</ol>
		  </nav>
	  </div>
	  	  <div class="row">
	    <div class="col-md-12 grid-margin stretch-card">
	      <div class="card">
	        <div class="card-body">
				<div class="d-flex justify-content-between mb-4">
					<h4 class="card-title">Proformas</h4>
					{{--<div>
						<div>
							<a href="{{ route('proformas.create') }}" class="btn btn-success">+ Nueva Proforma</a>
						</div>
					</div>--}}
				</div>

				<div class="table-responsive">
					<table id="detalle" class="table">
						<thead class="bg-dark text-white">
							<tr>
								<th>ID</th>
								<th>Fecha</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Acciones</th>
	          				</tr>
	          		</thead>

	          		<tbody>
	          			@foreach($proformas as $proforma)
	          				<tr>
	          					<th scope="row">{{ $proforma->id }}</th>

	          					<td>
									{{ date('d-m-Y', strtotime($proforma->sale_date)) }}
	          					</td>

	          					<td>
	          						{{ $proforma->total }}
	          					</td>
	          					<td>
	          						@if ($proforma->status == 'VALID' )
	          						<a href="{{ route('sales.change.status', $proforma) }}" class="jsgrid-button btn btn-sm btn-success" title="Activo">
		          							Validado <i class="fas fa-check"></i>
		          					</a>
	          						@else
	          						<a href="{{ route('sales.change.status', $proforma) }}" class="jsgrid-button btn btn-sm btn-danger" title="Desactivado">
		          							Desactivado <i class="fas fa-times"></i>
		          					</a>
	          						@endif
	          					</td>

	          					<td style="width: 100px;">
	          						{!! Form::open(['route' =>['sales.destroy', $proforma], 'method' => 'DELETE']) !!}

		          					<!--	<a href="" class="jsgrid-button jsgrid-edit-button" title="Editar">
		          							<i class="far fa-edit"></i>
		          						</a> -->
		          						<a href="{{ route('proformas.show', $proforma) }}" class="btn btn-info p-2" title="ver"><i class="far fa-eye"></i></a>
		          						<a href="{{ route('proformas.pdf', $proforma) }}" target="_blank" class="btn btn-warning p-2"  title="pdf"><i class="fas fa-print"></i></a-->
		          						<!--a href="#" class="jsgrid-button" title="imprimir"><i class="far fa-file-pdf"></i></a-->

		          						<!--button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Eliminar">
		          							<i class="far fa-trash-alt"></i>
		          						</button> -->

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
@endsection
