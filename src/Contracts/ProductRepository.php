<?php
declare(strict_types=1);

namespace App\Contracts;

interface ProductRepository
{
    public function saveProduct(array $product): void;

    public function findAll(): array;
}
