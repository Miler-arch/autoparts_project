<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'location' => 'Al norte de la ciudad',
            'name' => 'NORTE',
        ]);
        Warehouse::create([
            'location' => 'Al sur de la ciudad',
            'name' => 'SUR',
        ]);
    }
}
