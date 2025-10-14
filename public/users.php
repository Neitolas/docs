<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileUserRepository;
use App\Domain\UserValidator;
use App\Application\ListUsersService;

$file = __DIR__ . '/../storage/users.txt';

$service = new ListUsersService(
    new FileUserRepository($file),
    new UserValidator()
);

$users = $service->listAllUsers();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 60%; margin: 2rem auto; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Usuários Cadastrados</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Senha</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars((string) ($user['name'] ?? '')); ?></td>
                <td><?= htmlspecialchars((string) ($user['email'] ?? '')); ?></td>
                <td><?= htmlspecialchars((string) ($user['password'] ?? '')); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php">Voltar</a></p>
</body>
</html>