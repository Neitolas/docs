<?php

declare(strict_types=1);

namespace App\Domain;

interface UserRepository
{
    public function save(array $user): void;

    public function findAll(): array;
}
