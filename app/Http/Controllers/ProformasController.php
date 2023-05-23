<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ProformasController extends Controller
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
        abort_if(Gate::denies('sale_indexProformas'), 403);

        $proformas = Sale::all();

        return view('admin.proformas.index', compact('proformas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('sale_create'), 403);

        $clients = Client::all();
        $products = Product::all();
        
        return view('admin.proformas.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = Sale::create($request->all()+[
            'user_id' => Auth::user()->id,
            'sale_date' => Carbon::now('America/La_Paz')
        ]);

        foreach ($request->product_id as $key => $product) {

            $sale->updated_stock($request->product_id[$key], $request->quantity[$key]);

            $results[] = array(
                "product_id" => $request->product_id[$key], 
                "quantity" => $request->quantity[$key], 
                "price" => $request->price[$key], 
                "discount" => $request->discount[$key]
            );
        }

        $sale->saleDetails()->createMany($results);

        return redirect()->route('proformas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $proforma)
    {
        abort_if(Gate::denies('sale_show'), 403);

        $saleDetails = $proforma->saleDetails;

        $subtotal = 0;

        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price - $saleDetail->quantity * $saleDetail->price * $saleDetail->discount/100;
        }

        return view('admin.proformas.show', compact('proforma', 'saleDetails', 'subtotal'));
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

        return view('admin.proformas.edit', compact('sale'));
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

    public function pdf(Sale $proforma)
    {
        // $saleDetails = DB::table('sale_details')
        //     ->join('sales', 'sales.id','=','sale_id')
        //     ->where('sale_id', '=', $proforma->id)
        //     ->select('sales.*', 'sale_details.*')->get();
        $saleDetails = $proforma->saleDetails;
        
        $subtotal = 0;
        $count = 0;
        foreach ($saleDetails as $key => $saleDetail) {
            $subtotal += $saleDetail->quantity * $saleDetail->price;
            $saleDetails[$key]->subtotal = $saleDetail->quantity * $saleDetail->price;
            $saleDetails[$key]->code = $saleDetail->product->codigo; // "1234";
            $saleDetails[$key]->name = $saleDetail->product->name; // "Producto 1";
            $count++;
        }
        
        for ($i = $count; $i < 21; $i++) {
            $blanco =  new \stdClass;
            $blanco->id = "";
            $blanco->code = "";
            $blanco->quantity = "";
            $blanco->name = "";
            $blanco->price = "";
            $blanco->subtotal = "";
            $saleDetails[] = $blanco;
        }
        
        $pdf = \PDF::loadView('admin.proformas.pdf', compact('proforma', 'saleDetails', 'subtotal'));
        
        return $pdf->stream('ReporteDeCompra_'.$proforma->id.'.pdf');
    }
}
