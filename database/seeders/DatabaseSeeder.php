<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        //     CategorySeeder::class,
        //     ProviderSeeder::class,
        //     ClientSeeder::class,
        //     MarcaSeeder::class,
        //     MedidaSeeder::class,
        //     ProductSeeder::class,
        PermissionSeeder::class,
        RoleSeeder::class,
        RoleHasPermissionSeeder::class,
        UserSeeder::class,
        //     WarehouseSeeder::class
        ]);
    }
}
