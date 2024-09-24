<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Product A',
                'description' => 'Description for Product A',
                'price' => 99.99,
                'stock' => 50,
            ],
            [
                'name' => 'Product B',
                'description' => 'Description for Product B',
                'price' => 59.99,
                'stock' => 100,
            ],
            [
                'name' => 'Product C',
                'description' => 'Description for Product C',
                'price' => 19.99,
                'stock' => 200,
            ],
            [
                'name' => 'Product D',
                'description' => 'Description for Product D',
                'price' => 29.99,
                'stock' => 150,
            ],
            [
                'name' => 'Product E',
                'description' => 'Description for Product E',
                'price' => 49.99,
                'stock' => 75,
            ],
            [
                'name' => 'Product F',
                'description' => 'Description for Product F',
                'price' => 79.99,
                'stock' => 120,
            ],
        ]);
    }
}
