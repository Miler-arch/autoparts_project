<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouses extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'warehouse_id', 'quantity'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'quantity_original',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function add_stock($quantity)
    {
        /* $this->update([
            'stock' => DB::raw("stock + $quantity")
        ]); */

        $this->increment('quantity', $quantity);
    }

    public function subtract_stock($quantity)
    {
        /* $this->update([
            'stock' => DB::raw("stock - $quantity")
        ]); */

        $this->decrement('quantity', $quantity);
    }
}
