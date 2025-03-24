<?php

namespace App\Service;


use App\Entity\ProductList;

readonly class ProductFilterService
{

    public function __construct(
        private array $filterList
    ) {
    }

    public function filter(ProductList $productList): ProductList
    {
        $filteredList = new ProductList();
        foreach ($productList->getProducts() as $product) {
            $filterMatchFlag = true;
            foreach ($this->filterList as $filter) {
                if (!$filter->matchesFilter($product)) {
                    $filterMatchFlag = false;
                }
            }
            if ($filterMatchFlag) {
                $filteredList->addProduct($product);
            }
        }
        return $filteredList;
    }
}