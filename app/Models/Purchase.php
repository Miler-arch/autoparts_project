<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'warehouse_id', 'provider_id', 'purchase_date', 'tax', 'total','status', 'image', 'nro_compra'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class)->with('product2', 'purchase2');
    }

    public function updated_stock($id, $quantity, $warehouse_id) // 777 aumente 3er parametro
    {
        $product = Product::find($id);
        $product->add_stock($quantity);

        $productWarehouses = ProductWarehouses::where([['product_id','=',$id], ['warehouse_id','=',$warehouse_id]])->first();

        if ($productWarehouses) {
            $productWarehouses->add_stock($quantity);
        } else {
            $productWarehouses = ProductWarehouses::create([
                'warehouse_id' => $warehouse_id,
                'product_id' => $id,
                'quantity' => $quantity
            ]);
        }
    }
}
