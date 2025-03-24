<?php

namespace App\Service;

use App\Entity\Product;

interface FilterInterface
{
    public function __construct(array $parameters);
    public function getFilterName(): string;
    public function matchesFilter(Product $product): bool;
}