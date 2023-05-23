@extends('layouts.admin')
@section('title', 'Reporte de ventas')
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
		      Reporte de ventas
		    </h3>
		    <nav aria-label="breadcrumb">
		  	<ol class="breadcrumb">
		  		<li class="breadcrumb-item"><a href="#">Panel| Administrador</a></li>
		  		<li class="breadcrumb-item active" aria-current="page">Reporte de ventas</li>
		  	</ol>
		  </nav>
	  </div>
	  	  <div class="row">
	    <div class="col-md-12 grid-margin stretch-card">
	      <div class="card">
	        <div class="card-body">
				<div class="row">
					<div class="col-12 col-md-4 text-center">
						<span>Fecha de consulta: </span>
						<div class="form-group">
							<strong>{{\Carbon\Carbon::now()->format('d/m/Y')}}</strong>
						</div>
					</div>
					<div class="col-12 col-md-4 text-center">
						<span>Cantidad de registros: </span>
						<div class="form-group">
							<strong>{{ $sales->count() }}</strong>
						</div>
					</div>

					<div class="col-12 col-md-4 text-center">
						<span>Total de ingreso: </span>
						<div class="form-group">
							<strong>Bs. {{ $total }}</strong>
						</div>
					</div>
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
	          			@foreach($sales as $sale)
	          				<tr>
	          					<th scope="row">{{ $sale->id }}</th>
	          					<td>									
	          						{{ date('d-m-Y', strtotime($sale->sale_date)) }}
	          					</td>
	          					<td>
	          						{{ $sale->total }}
	          					</td>
	          					<td>
	          						{{ $sale->status }}
	          					</td>
	          					<td >
									<a href="{{ route('sales.show', $sale) }}" class="btn btn-info p-2"  title="ver"><i class="far fa-eye"></i></a>
									<a href="{{ route('sales.excel', $sale) }}" class="btn btn-success p-2"  title="excel"><i class="fas fa-file-excel"></i></a>
	          					</td>
	          				</tr>
	          			@endforeach
	          		</tbody>

	          	</table>
	          </div>
	        </div>
	        <div class="card-footer text-muted">

	        </div>
	      </div>
	    </div>

	  </div>

@endsection
