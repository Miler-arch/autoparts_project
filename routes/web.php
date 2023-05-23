<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProformasController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\TransferProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if(auth()->check()) {
        return redirect()->route('home');
    }
    return view('auth.login2');
})->name('auth.login2');

Route::get('/prueba', function () {
    return view('prueba');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('sales/reports_day', [ReportController::class, 'reports_day'])->name('reports.day');
    Route::get('sales/reports_date', [ReportController::class, 'reports_date'])->name('reports.date');
    Route::post('sales/reports_result', [ReportController::class, 'reports_result'])->name('reports.result');

    Route::resource('users', UserController::class)->names('users');

    Route::resource('categories', CategoryController::class)->names('categories');

    Route::resource('warehouses', WarehouseController::class)->names('warehouses');

    Route::resource('transfers', TransferProductController::class)->names('transfers');

    Route::resource('marcas', MarcaController::class)->names('marcas');

    Route::resource('medidas', MedidaController::class)->names('medidas');

    Route::resource('clients', ClientController::class)->names('clients');

    Route::resource('providers', ProviderController::class)->names('providers');

    Route::resource('products', ProductController::class)->names('products');
    Route::get('products/pdf/{product}/{warehouse_id}', [ProductController::class, 'pdf'])->name('products.pdf');
    Route::get('products/pdf/{product}', [ProductController::class, 'pdf_all'])->name('products.pdf_all');
    Route::get('change_status/products/{product}', [ProductController::class, 'change_status'])->name('products.change.status');

    Route::resource('purchases', PurchaseController::class)->names('purchases');
    Route::post('change_status/purchases/{purchase}', [PurchaseController::class, 'change_status'])->name('purchases.change.status');
    Route::get('purchases/pdf/{purchase}', [PurchaseController::class, 'pdf'])->name('purchases.pdf');

    Route::resource('proformas', ProformasController::class)->names('proformas');
    Route::get('proformas/pdf/{proforma}', [ProformasController::class, 'pdf'])->name('proformas.pdf');

    Route::resource('sales', SaleController::class)->names('sales');
    Route::get('sales/pdf/{sale}', [SaleController::class, 'pdf'])->name('sales.pdf');
    Route::get('sales/excel/{sale}', [SaleController::class, 'excel'])->name('sales.excel');
    Route::post('change_status/sales/{sale}', [SaleController::class, 'change_status'])->name('sales.change.status');

    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('permissions', PermissionController::class)->names('permissions');

    Route::get('get_products_by_barcode', [ProductController::class, 'get_products_by_barcode'])->name('get_products_by_barcode');
    Route::get('get_products_by_id', [ProductController::class, 'get_products_by_id'])->name('get_products_by_id');
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

Auth::routes();
