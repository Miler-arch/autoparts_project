<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferProduct;
use App\Models\Warehouse;
use DB;

class TransferProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = TransferProduct::all();
        return view('admin.transfer_products.index', compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        return view('admin.transfer_products.create', compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tp = new TransferProduct();
        $tp->warehouse_from_id = $request->warehouse_from_id;
        $tp->product_id = $request->product_id;
        $tp->quantity = $request->quantity;
        $tp->warehouse_to_id = $request->warehouse_to_id;
        $tp->save();

        $this->add_or_sum_product_in_warehouse($request->product_id, $request->warehouse_to_id, $request->quantity);
        $this->remove_quantity($request->product_id, $request->warehouse_from_id, $request->quantity);

        return redirect()->route('transfers.index')->with('registro','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tp = TransferProduct::findOrFail($id);
        return view('admin.transfer_products.report', compact('tp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_or_sum_product_in_warehouse($product_id, $warehouse_id, $quantity){
        $current_quantity = 0;
        $new_quantity = 0;
        $in_warehouse = DB::table("product_warehouses")
        ->where('product_id', $product_id)
        ->where('warehouse_id',$warehouse_id)
        ->get();

        if($in_warehouse->count() > 0){
            $current_quantity = $in_warehouse[0]->quantity;
            $new_quantity = $current_quantity + $quantity;
            DB::table('product_warehouses')
                ->where('product_id', $product_id)
                ->where('warehouse_id',$warehouse_id)
                ->update(['quantity'=>$new_quantity]);
        }else{
            DB::table('product_warehouses')
                ->insert(['product_id'=>$product_id, 'warehouse_id'=>$warehouse_id, 'quantity'=>$quantity]);
        }
    }

    public function remove_quantity($product_id, $warehouse_id, $quantity){
        $current_quantity = 0;
        $new_quantity = 0;
        $in_warehouse = DB::table("product_warehouses")
        ->where('product_id', $product_id)
        ->where('warehouse_id',$warehouse_id)
        ->get();

        if($in_warehouse->count() > 0){
            $current_quantity = $in_warehouse[0]->quantity;
            $new_quantity = $current_quantity - $quantity;
            DB::table('product_warehouses')
                ->where('product_id', $product_id)
                ->where('warehouse_id',$warehouse_id)
                ->update(['quantity'=>$new_quantity]);
        }
    }
}
