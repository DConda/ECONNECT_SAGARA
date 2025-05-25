<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a seller user if not exists
        $seller = User::firstOrCreate(
            ['email' => 'seller@econnect.com'],
            [
                'name' => 'Econnect Seller',
                'password' => bcrypt('password123'),
            ]
        );

        // Featured Categories Products
        Product::create([
            'name' => 'Recycled Plastic Materials',
            'description' => 'High-quality recycled plastic materials suitable for various applications.',
            'price' => 15000,
            'unit' => 'kg',
            'main_image' => 'images/Product Image.png',
            'seller_id' => $seller->id,
            'category' => 'Plastic Waste',
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Reclaimed Wood Pieces',
            'description' => 'Salvaged wood materials perfect for furniture and craft projects.',
            'price' => 25000,
            'unit' => 'kg',
            'main_image' => 'images/Product Image (1).png',
            'seller_id' => $seller->id,
            'category' => 'Wood Waste',
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Recycled Fabric Bundle',
            'description' => 'Mixed fabric and textile materials for creative reuse.',
            'price' => 12000,
            'unit' => 'kg',
            'main_image' => 'images/Product Image (2).png',
            'seller_id' => $seller->id,
            'category' => 'Fabric and Textile Waste',
            'stock' => 75,
        ]);

        // Popular Choices
        Product::create([
            'name' => 'Synthetic Leather Waste',
            'description' => 'High-quality synthetic leather scraps perfect for small projects.',
            'price' => 28000,
            'unit' => 'm',
            'main_image' => 'images/tekstil.png',
            'seller_id' => $seller->id,
            'category' => 'Fabric and Textile Waste',
            'stock' => 200,
        ]);

        Product::create([
            'name' => 'Used Glass Bottles',
            'description' => 'Clean, sorted glass bottles ready for recycling or creative projects.',
            'price' => 7500,
            'unit' => 'kg',
            'main_image' => 'images/Product Image (3).png',
            'seller_id' => $seller->id,
            'category' => 'Glass Waste',
            'stock' => 300,
        ]);

        Product::create([
            'name' => 'Ceramic Mosaic Remnants',
            'description' => 'Beautiful ceramic pieces perfect for mosaic art and decoration.',
            'price' => 20000,
            'unit' => 'kg',
            'main_image' => 'images/Product Image (4).png',
            'seller_id' => $seller->id,
            'category' => 'Ceramic Waste',
            'stock' => 150,
        ]);

        // New Products
        Product::create([
            'name' => 'Used Copper Cables',
            'description' => 'Recycled copper cables, cleaned and sorted by type.',
            'price' => 28000,
            'unit' => 'm',
            'main_image' => 'images/tembaga.png',
            'seller_id' => $seller->id,
            'category' => 'Metal Waste',
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Mixed Linen Fabric',
            'description' => 'Premium quality recycled linen fabric in various patterns.',
            'price' => 7500,
            'unit' => 'kg',
            'main_image' => 'images/Product Image (5).png',
            'seller_id' => $seller->id,
            'category' => 'Fabric and Textile Waste',
            'stock' => 250,
        ]);

        Product::create([
            'name' => 'Used Metal Can Lids',
            'description' => 'Clean metal can lids perfect for crafts and recycling projects.',
            'price' => 20000,
            'unit' => 'kg',
            'main_image' => 'images/Product Image (6).png',
            'seller_id' => $seller->id,
            'category' => 'Metal Waste',
            'stock' => 180,
        ]);
    }
}
