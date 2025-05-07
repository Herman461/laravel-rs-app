<?php

namespace Database\Seeders;

use App\Models\AttributeOption;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(500)->create();

        $attributeOptions = AttributeOption::all()->pluck('id');

        $products->each(function (Product $product) use ($attributeOptions) {
            $selectedOptions = $attributeOptions->random(rand(0, 5));

            if ($selectedOptions->count() > 0)
            {
                $product->attributeOptions()->attach($selectedOptions->toArray());
            }
        });
    }
}
