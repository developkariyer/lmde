<?php

namespace App\Entity;

class Product
{
    public function __construct(
        public int $id,
        public string $name,
        public string $brand,
        public float $price,
        public string $category
    ) {
    }

    // skipping getter/setter functions for this exercise
}