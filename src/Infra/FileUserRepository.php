<?php

declare(strict_types=1);

namespace App\Infra;

use App\Domain\UserRepository;

final class FileUserRepository implements UserRepository
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function save(array $user): void
    {
        $json = json_encode($user, JSON_UNESCAPED_UNICODE);

        file_put_contents($this->filename, $json . PHP_EOL, FILE_APPEND);
    }

    public function findAll(): array
    {
        if (!file_exists($this->filename)) {
            return [];
        }

        $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $users = [];

        foreach ($lines as $line) {
            $decoded = json_decode($line, true);

            if (is_array($decoded)) {
                $users[] = $decoded;
            }
        }

        return $users;
    }
}
