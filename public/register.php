<?php

declare(strict_types=1);

use App\Application\ListUsersService;
use App\Domain\UserValidator;
use App\Infra\FileUserRepository;

require __DIR__ . '/../vendor/autoload.php';

$service = new ListUsersService(
    new FileUserRepository(__DIR__ . '/../storage/users.txt'),
    new UserValidator()
);

$message = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $data = [
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => $_POST['password'] ?? '',
    ];

    try {
        $ok = $service->register($data);

        if ($ok) {
            $message = 'Usuário cadastrado com sucesso!';
        } else {
            $message = 'Erro na validação dos dados.';
        }
    } catch (Throwable $e) {
        $message = 'Erro: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        form { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 12px; padding: 10px; width: 100%; background: #28a745; color: white; border: none; border-radius: 6px; }
        button:hover { background: #218838; }
        .msg { margin-top: 15px; color: #007bff; }
    </style>
</head>
<body>
    <h1>Cadastrar Usuário</h1>
    <?php if ($message): ?>
        <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
    <label>Senha:</label>
    <input type="password" name="password" required>
        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="index.php">Voltar</a></p>
</body>
</html>