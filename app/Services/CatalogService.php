<?php
namespace App\Services;
use App\Models\Attribute;
use App\Repositories\ProductRepository;

class CatalogService
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {}

    public function getFilteredProducts(array $filters, ?int $page = 1)
    {
        return $this->productRepository
            ->getProductsWithAttributes()
            ->filterByAttributes($filters)
            ->paginate(perPage: 40, page: $page);
    }

    public function getCatalogData(): array
    {
        $products = $this->productRepository
            ->getProductsWithAttributes()
            ->paginate(40);

        return [
            'products' => [
                'total' => $products->total(),
                'data' => $products->items(),
                'lastPage' => $products->lastPage(),
            ],
            'attributes' => Attribute::with('options')->get()
        ];
    }
}
