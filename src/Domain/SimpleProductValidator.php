<?php
declare(strict_types=1);

namespace App\Domain;

use App\Contracts\ProductValidator;

final class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];

        $name = trim((string) ($input['name'] ?? ''));
        $price = $input['price'] ?? null;

        if ($name === '') {
            $errors[] = 'Nome é obrigatório';
        }
        if ($name !== '' && strlen($name) < 2) {
            $errors[] = 'Nome muito pequeno';
        }
        if ($name !== '' && strlen($name) > 100) {
            $errors[] = 'Nome muito grande';
        }

        if ($price === null || $price === '') {
            $errors[] = 'Preço é obrigatório';
        }
        if ($price !== null && $price !== '' && !is_numeric($price)) {
            $errors[] = 'Preço deve ser numérico';
        }
        if ($price !== null && $price !== '' && is_numeric($price) && $price < 0) {
            $errors[] = 'Preço negativo';
        }

        return $errors;
    }
}

