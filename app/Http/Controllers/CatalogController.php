<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedRequest;

use App\Services\CatalogService;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class CatalogController
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {}

    public function getFilteredProducts(FeedRequest $request): JsonResponse
    {
        $products = $this->catalogService->getFilteredProducts(
            $request->input('attributes', []),
            $request->page
        );

        return response()->json([
            'products' => $products,
        ]);
    }

    public function render(): Response
    {
        $catalogData = $this->catalogService->getCatalogData();

        return Inertia::render('Catalog/Catalog', $catalogData);
    }
}
