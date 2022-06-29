<?php

namespace Database\Seeders;

use App\Models\Admin\Ramo;
use App\Models\Insurance\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::updateOrCreate(['name' => 'Default', 'ramo_id' => 1,  'company_id' => 1], []);
        $product->capitals()->sync([1, 2, 3]);
        $product = Product::updateOrCreate(['name' => 'Titanium', 'ramo_id' => 1,  'company_id' => 1], []);
        $product->capitals()->sync([1, 4, 5]);
    }
}
