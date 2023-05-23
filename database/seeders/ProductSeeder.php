<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'code' => '12345678',
            'price' => '250',
            'name' => 'Resorte',
            'codigo' => 'LB1233',
            'stock' => '100',
            'image' => 'Resorte.png',
            'status' => 'ACTIVE',
            'marca_id' => 1,
            'medida_id' => 1,
            'category_id' => 1,
            'provider_id' => 1,
        ]);
    }
}
