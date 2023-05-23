<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouses';

    protected $fillable = ['name','location'];

    public function products(){
        return $this->belongsToMany('App\Models\Product','product_warehouses','warehouse_id','product_id')->withPivot('quantity');
    }
}
