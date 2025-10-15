<?php
declare(strict_types=1);

namespace App\Contracts;

interface ProductValidator
{
    public function validate(array $input): array;
}
