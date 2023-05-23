@extends('layouts.admin')

@section('title', 'Información Producto')

@section('style')
@endsection

@section('content')

	<div class="content-wrapper">
	  <div >
		    <nav aria-label="breadcrumb">
		  	<ol class="breadcrumb">
		  		<li class="breadcrumb-item"><a href="#">Panel| Administrador</a></li>
		  		<li class="breadcrumb-item"><a href="{{ route('providers.index') }}">Productos</a></li>
		  		<li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
		  	</ol>
		  </nav>
	  </div>
	  	  <div class="row">

	   <div class="col-md-12 grid-margin stretch-card">
	      <div class="card">
	        <div class="card-body">
						<div>
							<h4 class="card-header text-center mb-2" style="background-color: rgb(39, 47, 47); color:white">INFORMACIÓN DEL ARTÍCULO</h4>
						</div>
	        	<div class="row">

	        		<div class="col-lg-4">
	        			<div class="border-bottom text-center pb-4">

	        				@if (isset($product->image))
	        					<img src="{{ asset('image/'.$product->image) }}" alt="profile" class="img-lg rounded-circle mb-3">
	        				@endif

	        				<h3>{{ $product->name }}</h3>
	        				<div class="d-flex justify-content-between">
	        				</div>
	        			</div>

	        			<div class="border-bottom py-4">
	        				<div class="list-group">

	        					@if ($product->status == 'ACTIVE')
	        						<button class="btn btn-block btn-success">Activo</button>
	        					@else
	        						<button class="btn btn-block btn-danger">Desactivado</button>
	        					@endif
	        				</div>
	        			</div>

	        		</div>

	        		<div class="col-lg-8 pl-lg-5">
								
<!-- 'code', 'name', 'stock', 'image', 'sell_price', 'category_id', 'provider_id' -->
	        			<div class="profile-feed">
	        				<div class="d-flex align-items-start profile-feed-item">

	        					<div class="form-group col-md-6">

	        						<strong><i class="fab fa-product-hunt mr-1"></i>Código</strong>
	        						<p class="text-muted">{{ $product->codigo }}</p>
	        						<hr>

	        						<strong><i class="far fa-id-card mr-1"></i>Nombre</strong>
	        						<p class="text-muted">{{ $product->name }}</p>
	        						<hr>

	        						<strong><i class="fas fa-dolly mr-1"></i>Stock</strong>
	        						<p class="text-muted">{{ $product->stock }}</p>
	        						<hr>
											
											{{-- <strong><i class="fas fa-map-marked-alt mr-1"></i>Código de Barras</strong> --}}
	        						{{-- <p class="text-muted">
												{!!DNS1D::getBarcodeHTML($product->code, 'EAN13') !!}
											</p> --}}
	        					</div>


	        					<div class="form-group col-md-6">
	        						<strong><i class="fas fa-money-bill mr-1"></i>Precio de Venta</strong>
	        						<p class="text-muted">{{ $product->price }} Bs.</p>
	        						<hr>

	        						<strong><i class="fas fa-truck mr-1"></i>Proveedor</strong>
	        						<p class="text-muted">{{ $product->provider->name }}</p>
	        						<hr>

											<strong><i class="fas fa-box mr-1"></i>Categoria</strong>
	        						<p class="text-muted">{{ $product->category->name }}</p>
	        						<hr>
	        					</div>
										
	        				</div>
	        			</div>
	        		</div>

	        	</div>

	        </div>

	        <div class="card-footer text-muted">
	        	<a href="{{ route('products.index') }}" class="btn btn-info float-right">Regresar</a>
	        </div>

	      </div>
	    </div>

	  </div>
@endsection

@section('script')
@endsection