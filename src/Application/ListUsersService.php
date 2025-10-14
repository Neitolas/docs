<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\UserRepository;
use App\Domain\UserValidator;

final class ListUsersService
{
    private UserRepository $repository;
    private UserValidator $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function register(array $input): bool
    {
        $errors = $this->validator->validate($input);

        if ($errors !== []) {
            return false;
        }

        $user = [
            'name' => $input['name'] ?? 'Sem Nome',
            'email' => (string) ($input['email'] ?? ''),
            'password' => password_hash((string) ($input['password'] ?? ''), PASSWORD_DEFAULT),
        ];

        $this->repository->save($user);

        return true;
    }

    public function listAllUsers(): array
    {
        return $this->repository->findAll();
    }
}