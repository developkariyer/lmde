<?php

namespace App\Service;

use App\Entity\Product;
use App\Service\FilterInterface;

class CategoryFilter implements FilterInterface
{
    public function __construct(
        private Array $parameters
    ) {
    }

    public function getFilterName(): string
    {
        return "Category";
    }

    public function matchesFilter(Product $product): bool
    {
        $category = reset($this->parameters);
        if ($product->category === $category) {
            return true;
        }
        return false;
    }
}