<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    public function getProductsWithAttributes(): Builder
    {
        return Product::with([
            'attributes',
            'attributeOptions' => fn($query) => $query->with(['attribute', 'option'])
        ]);
    }
}
