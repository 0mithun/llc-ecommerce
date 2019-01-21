<?php

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
        factory(Product::class, 20)->create();


        $products = Product::select('id')->get();

        foreach ($products as $product ) {
            $product->addMediaFromUrl('https://lorempixel.com/640/480/?75802')
                    ->toMediaCollection('products');
        }
    }
}
