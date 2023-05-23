<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('sale_index'), 403);

        $warehouses = Warehouse::select('*')->orderBy('name', 'asc')->get();
        $sales = Sale::all();

        return view('admin.sales.index', compact('sales', 'warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('sale_create'), 403);

        $warehouses = Warehouse::select('*')->orderBy('name', 'asc')->get();
        $clients = Client::select('*')->orderBy('name', 'asc')->get();
        $products = Product::select('*')->where('status','ACTIVE')->orderBy('name', 'asc')->get();
        
        return view('admin.sales.create', compact('clients', 'products', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warehouse_id = $request['warehouse_id'];

        $user = Auth::user();

        $sale = Sale::create($request->all()+[
            'user_id' => $user->id,
            'sale_date' => Carbon::now('America/La_Paz')
        ]);

        foreach ($request->product_id as $key => $product) {
            $sale->updated_stock($request->product_id[$key], $request->quantity[$key], $warehouse_id);

            $results[] = array(
                "product_id" => $request->product_id[$key], 
                "warehouse_id" => $request->warehouse_id[$key], 
                "quantity" => $request->quantity[$key], 
                "price" => $request->price[$key], 
                // "discount" => $request->discount[$key],
                "destino" => $request->destino, //[$key]
                "talonario" => $request->talonario //[$key]
            );
        }

        $sale->saleDetails()->createMany($results);

        return redirect()->route('sales.index')->with('registro', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        abort_if(Gate::denies('sale_show'), 403);

        $saleDetails = $sale->saleDetails;

        $subtotal = 0;

        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price - $saleDetail->quantity * $saleDetail->price * $saleDetail->discount/100;
        }

        return view('admin.sales.show', compact('sale', 'saleDetails', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        abort_if(Gate::denies('sale_edit'), 403);

        return view('admin.sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->saleDetails()->delete();
        $sale->delete();
        
        return redirect()->route('sales.index');    
    }

    public function change_status(Sale $sale)
    {
        if ($sale->status = 'VALID') {
            $sale->update(['status' => 'CANCELED']);
        } else {
            $sale->update(['status' => 'VALID']);
        }
        return redirect()->back();
    }

    public function pdf(Sale $sale)
    {
        //$saleDetails = $sale->saleDetails;
        $saleDetails = DB::table('sale_details')
            ->join('sales', 'sales.id','=','sale_id')
            ->join('products', 'products.id','=','sale_details.product_id')
            ->select('sales.*', 'sale_details.*', 'products.code', 'products.codigo', 'products.name')->get();
        $subtotal = 0;
        
        foreach ($saleDetails as $key => $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price;
            $saleDetails[$key]->subtotal = $saleDetail->quantity * $saleDetail->price;
        }
        
        $pdf = \PDF::loadView('admin.sales.pdf', compact('sale', 'saleDetails', 'subtotal'));
        
        return $pdf->stream('ReporteDeVenta_'.$sale->id.'.pdf');
    }

}
