@extends('layouts.admin')
@section('title', 'Gestión de ventas')

@section('content')

	<div class="content-wrapper">
		<h3 class="page-title text-center">
			Gestión de Ventas
		</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Panel| Administrador</a></li>
				<li class="breadcrumb-item active" aria-current="page">Gestión de Ventas</li>
			</ol>
		</nav>

	  	  <div class="row">
	    <div class="col-md-12 grid-margin stretch-card">
	      <div class="card">
	        <div class="card-body">
				<div class="d-flex justify-content-between mb-4">
					<h4 class="list">Ventas</h4>
					<div>
						<div>
							<a href="{{ route('sales.create') }}" class="btn btn-success">+ Nueva Venta</a>
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
								<th style="width: 100px;"></th>
	          				</tr>
	          		</thead>

	          		<tbody>
	          			@foreach($sales as $sale)
	          				<tr>
	          					<th scope="row">{{ $sale->id }}</th>

	          					<td>
									{{ date('d-m-Y [H:i:s]', strtotime($sale->sale_date)) }}
	          					</td>

	          					<td>
	          						{{ $sale->total }}
	          					</td>
	          					<td>
	          						@if ($sale->status == 'VALID' )
	          						<a href="{{-- route('sales.change.status', $sale) --}}" class="jsgrid-button btn btn-sm btn-success" title="Activo">
		          							Validado <i class="fas fa-check"></i>
		          					</a>
	          						@else
	          						<a href="{{-- route('sales.change.status', $sale) --}}" class="jsgrid-button btn btn-sm btn-danger" title="Desactivado">
		          							Cancelado <i class="fas fa-times"></i>
		          					</a>
	          						@endif
	          					</td>

	          					<td style="width: 100px;">
	          						{!! Form::open(['route' =>['sales.destroy', $sale], 'method' => 'DELETE', 'onsubmit'=>'return confirm("¿Eliminar venta?")']) !!}

		          						<a href="{{ route('sales.show', $sale) }}" class="btn btn-info p-2" title="ver"><i class="far fa-eye"></i></a>
		          						<a href="{{ route('sales.pdf', $sale) }}" class="btn btn-warning p-2" title="pdf"><i class="fas fa-print"></i></a>

		          						<button class="btn btn-danger p-2" type="submit" title="Eliminar">
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
@endsection

@section('scripts')
    @if (session('registro') == 'ok')
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Venta realizada con éxito.',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    @endif
@endsection
