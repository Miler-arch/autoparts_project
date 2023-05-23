<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'product_id', 'quantity', 'price'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function purchase2() {
        return $this->hasOne(Purchase::class, 'id', 'purchase_id');
    }

    public function product2() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
