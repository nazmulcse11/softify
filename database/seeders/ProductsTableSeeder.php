<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['product_name'=>'T-shirt','product_code'=>'T-oo56','product_color'=>'Green',
            'product_price'=>'240'],
            ['product_name'=>'Red T-shirt','product_code'=>'T-oo56','product_color'=>'Green',
            'product_price'=>'240'],
            ['product_name'=>'Casual T-shirt','product_code'=>'T-oo56','product_color'=>'Green',
            'product_price'=>'240'],
            ['product_name'=>'Formal T-shirt','product_code'=>'T-oo56','product_color'=>'Green',
            'product_price'=>'240'],
        ];
        Product::insert($products);
    }
}
