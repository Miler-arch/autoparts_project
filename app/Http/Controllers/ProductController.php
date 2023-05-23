<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Category;
use App\Models\Marca;
use App\Models\Medida;
use App\Models\warehouse;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
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
        abort_if(Gate::denies('product_index'), 403);

        $products = Product::select('products.*', 'warehouses.id as wh_id', 'warehouses.name as wh_name', 'product_warehouses.quantity')
            ->leftjoin('product_warehouses','products.id', '=', 'product_warehouses.product_id')
            ->leftjoin('warehouses','warehouses.id', '=', 'product_warehouses.warehouse_id')
            ->orderBy('products.name', 'asc')
            ->get(); 

        /*$products = //Product::select('*')
            DB::table('products')
            ->leftjoin('product_warehouses','products.id', '=', 'product_warehouses.product_id')
            ->leftjoin('warehouses','warehouses.id', '=', 'product_warehouses.warehouse_id')
            //->where('product_id', $product->id)
            ->select('products.*', 'warehouses.name as warehouse', 'product_warehouses.quantity')
            ->orderBy('products.name', 'asc')->get();*/
        $warehouses = Warehouse::select('*')->orderBy('name', 'asc')->get();

        return view('admin.product.index', compact('products', 'warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('product_create'), 403);

        $categories = Category::get();
        $providers = Provider::get();
        $medidas = Medida::get();
        $marcas = Marca::get();
        $warehouses = Warehouse::select('*')->orderBy('name', 'asc')->get();

        return view('admin.product.create', compact('categories', 'providers','marcas','medidas','warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $cantidad = 0;
        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("/image"), $image_name);
        }
        $product = Product::create($request->all()+[
            'image'=>$image_name,
        ]);

        if($product){
            $ids = $request->warehouses_id;
            foreach($ids as $id){
                DB::table('product_warehouses')->insert([
                    'product_id'=>$product->id,
                    'warehouse_id'=>$id,
                    'quantity'=>$_POST['warehouse_'.$id],
                    'quantity_original'=>$_POST['warehouse_'.$id] // 777 adicione esto al ultimo
                ]);
                $cantidad+=$_POST['warehouse_'.$id];
            }

            $uproduct = Product::findOrFail($product->id);
            $uproduct->stock = $cantidad;
            $uproduct->update();
            $cantidad = 0;
        }
        
        if ($request->code == "") {
            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);

            $product->update([
                'code' => $numeroConCeros
            ]);
        }
        return redirect()->route('products.index')->with('registro', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), 403);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), 403);

        $categories = Category::all();
        $providers = Provider::all();
        $medidas = Medida::all();
        $marcas = Marca::all();
        $warehouses = Warehouse::all();
        $warehouses_selected = DB::table("product_warehouses")->select('warehouse_id','quantity')->where('product_id',$product->id)->get();

        return view('admin.product.edit', compact('product', 'categories', 'providers','marcas','medidas','warehouses','warehouses_selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        $cantidad = 0;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("/image"), $image_name);

            $product->update([
                'image' => $image_name
            ]);
        }

        if($product){
            DB::table('product_warehouses')->where('product_id',$product->id)->delete();
            $ids = $request->warehouses_id;
            foreach($ids as $id){
                DB::table('product_warehouses')->insert([
                    'product_id'=>$product->id,
                    'warehouse_id'=>$id,
                    'quantity'=>$_POST['warehouse_'.$id],
                    'quantity_original'=>$_POST['warehouse_'.$id]
                ]);
                $cantidad+=$_POST['warehouse_'.$id];
            }

            $uproduct = Product::findOrFail($product->id);
            $uproduct->stock = $cantidad;
            $uproduct->update();
            $cantidad = 0;
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      
        $product = Product::findOrFail($id);

        $product->delete();

            return redirect()->route('products.index');
    }

    public function change_status(Product $product)
    {
        if ($product->status == 'ACTIVE') {
            $product->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } else {
            $product->update(['status' => 'ACTIVE']);
        }
        return redirect()->back();
    }


    public function get_products_by_barcode(Request $request)
    {
        if($request->ajax()){
            $products = Product::where('code',$request->code)->firstOrFail();
            return response()->json($products);
        }
    }

    public function get_products_by_id(Request $request)
    {
        if($request->ajax()){
            $products = Product::findOrFail($request->product_id);
            return response()->json($products);
        }
    }

    public function pdf(Product $product, $warehouse_id)
    {
        $warehouse = Warehouse::select('warehouses.*', 
            'product_warehouses.quantity', 'product_warehouses.quantity_original')
            ->join('product_warehouses', 'product_warehouses.warehouse_id', '=', 'warehouses.id')
            //->join('products', 'products.id', '=', 'warehouses.product_id')
            ->where([['product_warehouses.warehouse_id', '=', $warehouse_id], ['product_warehouses.product_id', '=', $product->id]])->first();
        
        $compras = DB::table('purchase_details')
            ->join('purchases','purchases.id', '=', 'purchase_details.purchase_id')
            ->join('providers','providers.id', '=', 'purchases.provider_id')
            ->where([['purchase_details.product_id', $product->id], ['purchases.warehouse_id', $warehouse->id]])
            ->orderBy('purchase_details.created_at')
            ->select('quantity', 'price', 'purchase_details.created_at', 
                DB::raw("'INGRESO' AS tipo"), 
                DB::raw("' ' AS destino"), 
                DB::raw("providers.name AS cliente"), 
                DB::raw("' ' AS guia"),
                DB::raw("purchases.nro_compra AS nrocompra"), 
                DB::raw("' ' AS talonario"));
    
        $ventas = DB::table('sale_details')
            ->join('sales','sales.id', '=', 'sale_details.sale_id')
            ->join('clients','clients.id', '=', 'sales.client_id')
            ->where([['sale_details.product_id', $product->id], ['sale_details.warehouse_id', $warehouse->id]])
            ->orderBy('sale_details.created_at')
            ->select('quantity', 'price', 'sale_details.created_at', 
                DB::raw("'SALIDA' AS tipo"), 
                DB::raw("sale_details.destino AS destino"), 
                DB::raw("clients.name AS cliente"),
                DB::raw("sales.id AS guia"),
                DB::raw("' ' AS nroventa"), 
                DB::raw("sale_details.talonario AS talonario"));
             
    
        $existencias = $compras->union($ventas)
            ->orderBy('created_at')->get();

        $subtotal = 0;
        $subtotal = $warehouse->quantity_original;
        foreach ($existencias as $key => $existencia) {
            if ($existencia->tipo == 'INGRESO') {
                $subtotal = $subtotal + $existencia->quantity;
                $existencias[$key]->saldo = $subtotal;
            } else {
                $subtotal = $subtotal - $existencia->quantity;
                $existencias[$key]->saldo = $subtotal;
            }
        }
        
        // multiples almacenes
        $allWarehouses = Warehouse::select('warehouses.*', 'product_warehouses.quantity', 'product_warehouses.quantity_original')
        ->join('product_warehouses', 'product_warehouses.warehouse_id', '=', 'warehouses.id')
        ->where([['product_warehouses.product_id', '=', $product->id]])->get();
        $totalOriginal = 0;
        $totalFinal = 0;
        foreach ($allWarehouses as $wh) {
            $totalOriginal += $wh->quantity_original;
            $totalFinal += $wh->quantity;
        }
        // pasar variables al blade
        $pdf = \PDF::loadView('admin.product.pdf', compact('warehouse', 'product', 'existencias', 'subtotal', 'allWarehouses', 'totalOriginal', 'totalFinal'));
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream('ReporteDeExistencia_'.$product->id.'.pdf');
    }

    public function pdf_all(Product $product)
    {
        $warehouseTotal = Warehouse::select('warehouses.*', 
            'product_warehouses.quantity', 'product_warehouses.quantity_original')
            ->join('product_warehouses', 'product_warehouses.warehouse_id', '=', 'warehouses.id')
            ->where([['product_warehouses.product_id', '=', $product->id]])->get();
        $subtotal = 0;
        $subtotal_original = 0;
        foreach ($warehouseTotal as $wh) {
            $subtotal = $subtotal + $wh->quantity;
            $subtotal_original = $subtotal_original + $wh->quantity_original;
        }
        
        $compras = DB::table('purchase_details')
            ->join('purchases','purchases.id', '=', 'purchase_details.purchase_id')
            ->join('providers','providers.id', '=', 'purchases.provider_id')
            ->where([['purchase_details.product_id', $product->id]])
            ->orderBy('purchase_details.created_at')
            ->select('quantity', 'price', 'purchase_details.created_at', 
                DB::raw("'INGRESO' AS tipo"), 
                DB::raw("' ' AS destino"), 
                DB::raw("providers.name AS cliente"), 
                DB::raw("' ' AS guia"),
                DB::raw("purchases.nro_compra AS nrocompra"), 
                DB::raw("' ' AS talonario"));
        
        $ventas = DB::table('sale_details')
            ->join('sales','sales.id', '=', 'sale_details.sale_id')
            ->join('clients','clients.id', '=', 'sales.client_id')
            ->where([['sale_details.product_id', $product->id]])
            ->orderBy('sale_details.created_at')
            ->select('quantity', 'price', 'sale_details.created_at', 
                DB::raw("'SALIDA' AS tipo"), 
                DB::raw("sale_details.destino AS destino"), 
                DB::raw("clients.name AS cliente"), 
                DB::raw("sales.id AS guia"),
                DB::raw("' ' AS nroventa"), 
                DB::raw("sale_details.talonario AS talonario"));
        
        $existencias = $compras->union($ventas)
            ->orderBy('created_at')->get();
        
        $subtotal = $subtotal_original;
        foreach ($existencias as $key => $existencia) {
            if ($existencia->tipo == 'INGRESO') {
                $subtotal = $subtotal + $existencia->quantity;
                $existencias[$key]->saldo = $subtotal;
            } else {
                $subtotal = $subtotal - $existencia->quantity;
                $existencias[$key]->saldo = $subtotal;
            }
        }
        
        // multiples almacenes
        $allWarehouses = Warehouse::select('warehouses.*', 'product_warehouses.quantity', 'product_warehouses.quantity_original')
        ->join('product_warehouses', 'product_warehouses.warehouse_id', '=', 'warehouses.id')
        ->where([['product_warehouses.product_id', '=', $product->id]])->get();
        $totalOriginal = 0;
        $totalFinal = 0;
        foreach ($allWarehouses as $wh) {
            $totalOriginal += $wh->quantity_original;
            $totalFinal += $wh->quantity;
        }

        // pasar variables al blade
        $pdf = \PDF::loadView('admin.product.pdf_all', compact('warehouseTotal', 'product', 'existencias', 'subtotal', 'subtotal_original', 'allWarehouses', 'totalOriginal', 'totalFinal'));
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream('ReporteDeExistencia_'.$product->id.'.pdf');
    }

}
