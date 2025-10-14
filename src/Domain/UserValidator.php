<?php

declare(strict_types=1);

namespace App\Domain;

final class UserValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = 'O nome é obrigatório.';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'E-mail inválido.';
        }

        if (empty($data['password']) || strlen((string) $data['password']) < 4) {
            $errors[] = 'A senha deve ter pelo menos 4 caracteres.';
        }

        return $errors;
    }
}
