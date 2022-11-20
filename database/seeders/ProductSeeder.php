<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 11; $i++) {
            DB::table('products')->insert([
                'code' => 'abc-' . rand(100, 9999),
                'company' => 'Major Company' . rand(1, 3),
                'name' => 'New Product ' . rand(10, 99),
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'quantity' => rand(1, 50),
                'price' => rand(40, 500),
                'picture' => 'product_image_' . rand(1,7) . '.jpg'
            ]);

            DB::table('products')->insert([
                'code' => 'xyz-' . rand(100, 9999),
                'company' => 'Corporation ' . rand(1, 3),
                'name' => 'Amazing Product ' . rand(10, 99),
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'quantity' => rand(1, 50),
                'price' => rand(10, 80),
                'picture' => 'product_image_' . rand(1,7) . '.jpg'
            ]);
        }
    }
}
