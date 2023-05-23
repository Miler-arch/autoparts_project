<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferProduct extends Model
{
    use HasFactory;

    protected $table = "transfer_products";

    public function warehouse_from(){
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_from_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function warehouse_to(){
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_to_id', 'id');
    }

}
