<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductWarehouses;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'name', 'stock', 'image', 'price', 'status', 'category_id', 'provider_id', 'marca_id','medida_id'];
    //'code',
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function add_stock($quantity)
    {
        /* $this->update([
            'stock' => DB::raw("stock + $quantity")
        ]); */

        $this->increment('stock', $quantity);
    }

    public function subtract_stock($quantity)
    {
        /* $this->update([
            'stock' => DB::raw("stock - $quantity")
        ]); */

        $this->decrement('stock', $quantity);
    }

    public function setTotalStock() {
        $prodWH = ProductWarehouses::where('product_id', $this->id)
            ->get();

        $quantity = 0;
        foreach($prodWH as $pwh) {
            $quantity += $pwh->quantity;
        }

        $this->stock = $quantity;
        $this->save();
    }

}
