<?php

namespace App\Tests;

use App\Entity\Product;
use App\Entity\ProductList;
use App\Service\CategoryFilter;
use App\Service\PriceFilter;
use App\Service\ProductFilterService;
use PHPUnit\Framework\TestCase;

class ProductFilterTest extends TestCase
{

    public function test_filter_filled()
    {
        $productList = new ProductList();

        $iphone = new Product(1, "iPhone 15", "Apple", 699, "phone");
        $ipad = new Product(2, "iPad", "Apple", 610, "tablet");
        $laptop = new Product(3, "Latitude G510", "Dell", 300, "notebook");
        $monitor = new Product(4, "DW289", "Asus", 299, "monitor");

        $productList->addProduct($iphone);
        $productList->addProduct($ipad);
        $productList->addProduct($laptop);
        $productList->addProduct($monitor);

        $filter = new ProductFilterService([
            new PriceFilter(['minPrice'=>200, 'maxPrice'=>300]),
            new CategoryFilter(['monitor'])
        ]);

        $expectedFilter = new ProductList();
        $expectedFilter->addProduct($monitor);

        $this->assertEquals($expectedFilter, $filter->filter($productList));
    }

    public function test_filter_empty()
    {
        $productList = new ProductList();

        $iphone = new Product(1, "iPhone 15", "Apple", 699, "phone");
        $ipad = new Product(2, "iPad", "Apple", 610, "tablet");
        $laptop = new Product(3, "Latitude G510", "Dell", 300, "notebook");
        $monitor = new Product(4, "DW289", "Asus", 299, "monitor");

        $productList->addProduct($iphone);
        $productList->addProduct($ipad);
        $productList->addProduct($laptop);
        $productList->addProduct($monitor);

        $filter = new ProductFilterService([
            new PriceFilter(['minPrice'=>200, 'maxPrice'=>300]),
            new CategoryFilter(['somethingels'])
        ]);

        $expectedFilter = new ProductList();

        $this->assertEquals($expectedFilter, $filter->filter($productList));
    }

}