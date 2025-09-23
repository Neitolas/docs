<?php

class UserManager {
    private array $users;

    public function __construct(array $initialUsers = []) {
        $this->users = $initialUsers;
    }

    private function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validatePassword(string $password): bool {
        return preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password) === 1;
    }

    private function findUserByEmail(string $email): ?array {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    private function findUserById(int $id): ?int {
        foreach ($this->users as $key => $user) {
            if ($user['id'] === $id) {
                return $key;
            }
        }
        return null;
    }

    public function registerUser(string $name, string $email, string $password): ?User {
        if (!$this->validateEmail($email)) {
            echo "<p>Invalid email.</p>";
            return null;
        }

        if (!$this->validatePassword($password)) {
            echo "<p>The password must have at least 8 characters, 1 number, and 1 uppercase letter.</p>";
            return null;
        }

        if ($this->findUserByEmail($email)) {
            echo "<p>Email is already in use.</p>";
            return null;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $id = count($this->users) > 0 ? end($this->users)['id'] + 1 : 1;

        $newUser = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];

        $this->users[] = $newUser;

        return new User($id, $name, $email, $hashedPassword);
    }

    public function login(string $email, string $password): bool {
        $user = $this->findUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }

        return false;
    }

    public function resetPassword(int $id, string $newPassword): bool {
        $userKey = $this->findUserById($id);

        if ($userKey === null) {
            echo "<p>User not found.</p>";
            return false;
        }

        if (!$this->validatePassword($newPassword)) {
            echo "<p>The new password does not meet the requirements.</p>";
            return false;
        }

        $this->users[$userKey]['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        return true;
    }
}