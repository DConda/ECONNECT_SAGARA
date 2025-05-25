<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

        // Ensure the storage directory exists
        Storage::disk('public')->makeDirectory('products');

        // Copy images from public to storage if they exist
        $this->copyImageToStorage('images/Product Image.png', 'products/plastic-materials.png');
        $this->copyImageToStorage('images/Product Image (1).png', 'products/wood-pieces.png');
        $this->copyImageToStorage('images/Product Image (2).png', 'products/fabric-bundle.png');
        $this->copyImageToStorage('images/tekstil.png', 'products/leather-waste.png');
        $this->copyImageToStorage('images/Product Image (3).png', 'products/glass-bottles.png');
        $this->copyImageToStorage('images/Product Image (4).png', 'products/ceramic-mosaic.png');
        $this->copyImageToStorage('images/tembaga.png', 'products/copper-cables.png');
        $this->copyImageToStorage('images/Product Image (5).png', 'products/linen-fabric.png');
        $this->copyImageToStorage('images/Product Image (6).png', 'products/metal-lids.png');

        // Featured Categories Products
        Product::create([
            'name' => 'Recycled Plastic Materials',
            'description' => 'High-quality recycled plastic materials suitable for various applications.',
            'price' => 15000,
            'unit' => 'kg',
            'main_image' => 'products/plastic-materials.png',
            'seller_id' => $seller->id,
            'category' => 'Plastic Waste',
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Reclaimed Wood Pieces',
            'description' => 'Salvaged wood materials perfect for furniture and craft projects.',
            'price' => 25000,
            'unit' => 'kg',
            'main_image' => 'products/wood-pieces.png',
            'seller_id' => $seller->id,
            'category' => 'Wood Waste',
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Recycled Fabric Bundle',
            'description' => 'Mixed fabric and textile materials for creative reuse.',
            'price' => 12000,
            'unit' => 'kg',
            'main_image' => 'products/fabric-bundle.png',
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
            'main_image' => 'products/leather-waste.png',
            'seller_id' => $seller->id,
            'category' => 'Fabric and Textile Waste',
            'stock' => 200,
        ]);

        Product::create([
            'name' => 'Used Glass Bottles',
            'description' => 'Clean, sorted glass bottles ready for recycling or creative projects.',
            'price' => 7500,
            'unit' => 'kg',
            'main_image' => 'products/glass-bottles.png',
            'seller_id' => $seller->id,
            'category' => 'Glass Waste',
            'stock' => 300,
        ]);

        Product::create([
            'name' => 'Ceramic Mosaic Remnants',
            'description' => 'Beautiful ceramic pieces perfect for mosaic art and decoration.',
            'price' => 20000,
            'unit' => 'kg',
            'main_image' => 'products/ceramic-mosaic.png',
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
            'main_image' => 'products/copper-cables.png',
            'seller_id' => $seller->id,
            'category' => 'Metal Waste',
            'stock' => 100,
        ]);

        Product::create([
            'name' => 'Mixed Linen Fabric',
            'description' => 'Premium quality recycled linen fabric in various patterns.',
            'price' => 7500,
            'unit' => 'kg',
            'main_image' => 'products/linen-fabric.png',
            'seller_id' => $seller->id,
            'category' => 'Fabric and Textile Waste',
            'stock' => 250,
        ]);

        Product::create([
            'name' => 'Used Metal Can Lids',
            'description' => 'Clean metal can lids perfect for crafts and recycling projects.',
            'price' => 20000,
            'unit' => 'kg',
            'main_image' => 'products/metal-lids.png',
            'seller_id' => $seller->id,
            'category' => 'Metal Waste',
            'stock' => 180,
        ]);
    }

    /**
     * Copy an image from public directory to storage
     */
    private function copyImageToStorage($sourcePath, $destinationPath)
    {
        if (file_exists(public_path($sourcePath))) {
            $contents = file_get_contents(public_path($sourcePath));
            Storage::disk('public')->put($destinationPath, $contents);
        }
    }
}
