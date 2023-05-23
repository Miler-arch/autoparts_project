@extends('layouts/admin')

@section('title', 'Detalles de venta')

@section('style')
@endsection

@section('content')

	<div class="content-wrapper">
	  <div class="page-header">
		    <h3 class="page-title">
		      Detalles de Proforma
		    </h3>
		    <nav aria-label="breadcrumb">
		  	<ol class="breadcrumb">
		  		<li class="breadcrumb-item"><a href="#">Panel| Administrador</a></li>
		  		<li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Venta</a></li>
		  		<li class="breadcrumb-item active" aria-current="page">Detalles de Venta</li>
		  	</ol>
		  </nav>
	  </div>
	  	  <div class="row">

	   <div class="col-md-12 grid-margin stretch-card">
	      <div class="card">
	        <div class="card-body">
	        	<div class="row">

	        		<div class="col-md-4 text-center">
						<label class="form-control-label">Cliente</label>
						<p>{{ $proforma->client->name }}</p>
					</div>
					<div class="col-md-4 text-center">
						<label class="form-control-label">Vendedor</label>
						<p>{{ $proforma->user->name }}</p>
					</div>
					<div class="col-md-4 text-center">
						<label class="form-control-label">Número Venta</label>
						<p>{{$proforma->id}}</p>
					</div>

					<br><br>

					<div class="col-md-12">
						<h4 class="card-title text-center">Detalle de la venta</h4>
						<div class="table-responsive col-md-12">
							<table id="saleDetails" class="table">
								<thead>
									<tr>
										<th>Producto</th>
										<th>Precio</th>
										<th>Descuento</th>
										<th>Cantidad</th>
										<th>SubTotal</th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<th colspan="4">
											<p align="right">SUBTOTAL:</p>
										</th>
										<th>
											<p align="right">Bs. {{ number_format($subtotal,2) }}</p>
										</th>
									</tr>

									<tr>
										<th colspan="4">
											<p align="right">TOTAL IMPUESTO {{ $proforma->tax}}%:</p>
										</th>
										<th>
											<p align="right">Bs. {{ number_format($subtotal * $proforma->tax/100,2) }}</p>
										</th>
									</tr>
									<tr>
										<th colspan="4">
											<p align="right">TOTAL:</p>
										</th>
										<th>
											<p align="right">Bs. {{number_format($proforma->total,2)}}</p>
										</th>
									</tr>
								</tfoot>

								<tbody>
									@foreach($saleDetails as $saleDetail)
										<tr>
											<td>{{ $saleDetail->product->name }}</td>
											<td>Bs. {{ $saleDetail->price }}</td>
											<td>Bs. {{ $saleDetail->discount }}%</td>
											<td>{{ $saleDetail->quantity }}</td>
											<td>Bs. {{ number_format($saleDetail->quantity * $saleDetail->price - $saleDetail->quantity * $saleDetail->price * $saleDetail->discount/100,2) }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

	        	</div>
	        </div>

	        <div class="card-footer text-muted">
	        	<a href="{{ route('sales.index') }}" class="btn btn-info float-right">Regresar</a>
	        </div>

	      </div>
	    </div>

	  </div>
@endsection

@section('script')
@endsection