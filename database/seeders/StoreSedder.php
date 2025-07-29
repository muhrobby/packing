<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'store_code' => 'A314',
            'store_name' => 'AZKO Mall Artha Gading'
        ]);
    }
}
