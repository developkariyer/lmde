<?php

namespace App\Service;

use App\Entity\Product;

readonly class PriceFilter implements FilterInterface
{
    public function __construct(
        private array $parameters
    ) {
    }

    public function getFilterName(): string
    {
        return "Price";
    }

    public function matchesFilter(Product $product): bool
    {
        $maxPrice = $this->parameters['maxPrice'] ?? 0;
        $minPrice = $this->parameters['minPrice'] ?? 0;
        if ($minPrice > $maxPrice) {
            [$minPrice, $maxPrice] = [$maxPrice, $minPrice];
        }
        return $this->isBetween($product->price, $minPrice, $maxPrice);
    }

    private function isBetween($price, $minPrice, $maxPrice): bool
    {
        return $price >= $minPrice && $price <= $maxPrice;
    }
}