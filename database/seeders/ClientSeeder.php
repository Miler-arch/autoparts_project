<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Miller Arnez Ponce',
            'dni' => '7911041',
            'address' => 'Av. Villazon',
            'phone' => '76469149',
            'email' => 'miller4290@gmail.com',
        ]);

   
    }
}
