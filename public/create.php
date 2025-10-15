<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$file = __DIR__ . '/../storage/products.json';

$service = new ProductService(new FileProductRepository($file), new SimpleProductValidator());

$response = $service->create($_POST ?? []);
$message = $response ? 'Produto cadastrado com sucesso!' : 'Falha no cadastro: dados inválidos';
$success = (bool) $response;
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <title>Resultado Cadastro</title>
    <style>
        :root{--bg:#081018;--card:#12212a;--ok:#16a34a;--err:#ef4444;--accent:#f59e0b}
        body{margin:0;min-height:100vh;background:linear-gradient(120deg,#031219 0%,var(--bg) 60%);font-family:Inter,system-ui,Arial;color:#e6eef2;display:flex;align-items:center;justify-content:center}
    .result{background:var(--card);padding:2rem;border-radius:14px;box-shadow:0 12px 40px rgba(2,6,23,0.7);width:380px;text-align:left}
        h1{margin:0 0 0.75rem;color:var(--accent)}
        p.msg{font-size:1rem;margin:0 0 1rem;color:var(--ok)}
        p.msg.err{color:var(--err)}
        .actions{display:flex;gap:8px}
        .btn{flex:1;padding:0.8rem;border-radius:10px;text-decoration:none;color:#07131a;background:var(--accent);text-align:center;font-weight:700}
        .btn.secondary{background:transparent;border:1px solid rgba(255,255,255,0.06);color:#cfe9f0}
    </style>
</head>
<body>
    <div class='result'>
        <h1>Cadastro</h1>
        <p class='msg <?= $success ? '' : 'err' ?>'><?= htmlspecialchars($message) ?></p>
        <div class='actions'>
            <a href='index.php' class='btn secondary'>Voltar</a>
            <a href='products.php' class='btn'>Ver Produtos</a>
        </div>
    </div>
</body>
</html>
