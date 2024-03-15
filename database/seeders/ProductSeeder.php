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
        $image = fake()->imageUrl;
        Product::create([
            'name' => 'Computer',
            'quantity' => '15',
            'image' => $image,
        ]);
        Product::create([
            'name' => 'TV',
            'quantity' => '10',
            'image' => $image,
        ]);
        Product::create([
            'name' => 'Mobile',
            'quantity' => '20',
            'image' => $image,
        ]);
        Product::create([
            'name' => 'Chair',
            'quantity' => '30',
            'image' => $image,
        ]);
        Product::create([
            'name' => 'Laptop',
            'quantity' => '5',
            'image' => $image,
        ]);
    }
}
