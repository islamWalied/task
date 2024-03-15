<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image = fake()->image;
            Product::create([
                'name' => 'Computer',
                'quantity' => '15',
                'image' => $image,
        ]);
    }
}
