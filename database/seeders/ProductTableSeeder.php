<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'apple',
            'available_stock' => 100
        ]);

        Product::create([
            'name' => 'banana',
            'available_stock' => 100
        ]);

        Product::create([
            'name' => 'grapes',
            'available_stock' => 5
        ]);
    }
}
