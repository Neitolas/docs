<?php
declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;

final class FileProductRepository implements ProductRepository
{
    public function __construct(private string $filePath)
    {
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }

    public function saveProduct(array $product): void
    {
        $data = file_get_contents($this->filePath);
        $products = json_decode($data, true) ?: [];

        $product['id'] = $products ? (int) max(array_column($products, 'id')) + 1 : 1;

        $products[] = $product;

        file_put_contents($this->filePath, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function findAll(): array
    {
        $data = file_get_contents($this->filePath);
        $products = json_decode($data, true);
        return $products ?: [];
    }
}
