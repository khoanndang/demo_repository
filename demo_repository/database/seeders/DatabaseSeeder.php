<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Product::factory(10)->create();
        $data = [];
        for ($i=1; $i<=10; $i++){
            $data[] = [
                'product_name' => "Product $i version 2",
                'status' => rand(1,3)
            ];
        }
        Product::insert($data);
    }
}
