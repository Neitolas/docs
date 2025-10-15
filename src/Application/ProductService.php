<?php
declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

final class ProductService
{
    public function __construct(
        private ProductRepository $repo,
        private ProductValidator $validator
    ) {
    }

    public function create(array $input): bool
    {
        $errors = $this->validator->validate($input);
        if ($errors !== []) {
            return false;
        }

        $name = trim((string) ($input['name'] ?? 'Sem nome'));
        $price = isset($input['price']) ? (float) $input['price'] : 0.0;
        $price = round($price, 2);

        $product = [
            'name' => $name,
            'price' => $price,
        ];

        $this->repo->saveProduct($product);
        return true;
    }

    public function listProducts(): array
    {
        return $this->repo->findAll();
    }
}
