<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'warehouse_id', 'product_id', 'quantity', 'price', 'destino', 'talonario'];
    //'discount'
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse2() {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function product2() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
