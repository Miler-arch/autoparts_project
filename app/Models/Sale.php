<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'user_id', 'sale_date', 'total','status', 'number_box', 'transport', 'encargado', 'fech_venc', 'credit_days'];
    //, 'tax'
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetails::class)->with('warehouse2','product2');
    }

    public function updated_stock($id, $quantity, $warehouse_id) // 777 aumente 3er parametro
    {
        $product = Product::find($id);
        $product->subtract_stock($quantity);

        $productWarehouses = ProductWarehouses::where([['product_id','=',$id], ['warehouse_id','=',$warehouse_id]])->first();

        if ($productWarehouses) {
            $productWarehouses->subtract_stock($quantity);
        } else {
            $productWarehouses = ProductWarehouses::create([
                'warehouse_id' => $warehouse_id,
                'product_id' => $id,
                'quantity' => $quantity * (-1)
            ]);
        }
    }

}
