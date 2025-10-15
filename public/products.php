<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;

$jsonFile = __DIR__ . '/../storage/products.json';
$dir = dirname($jsonFile);
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
if (!file_exists($jsonFile) || trim(file_get_contents($jsonFile)) === '') {
    file_put_contents($jsonFile, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

$repo = new FileProductRepository($jsonFile);
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$products = $service->listProducts();
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <title>Lista de Produtos</title>
    <style>
        :root{--bg:#071722;--card:#0f1724;--tile:#082b36;--accent:#ff6b6b;--muted:#9aa4a8}
        body{margin:0;font-family:Inter,system-ui,Arial;background:linear-gradient(180deg,#021018 0%,var(--bg) 60%);color:#e6eef2;min-height:100vh;padding:2.5rem}
        .wrap{max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 320px;gap:2rem}
        h1{margin:0 0 1rem;color:var(--accent);font-size:2rem}
        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem}
        .tile{background:var(--tile);padding:1rem;border-radius:12px;box-shadow:0 10px 30px rgba(2,6,23,0.6)}
        .tile h3{margin:0 0 .5rem}
        .tile .price{font-weight:700;color:var(--accent)}
        .sidebar{background:linear-gradient(180deg,#0b2b2b,#073033);padding:1rem;border-radius:12px;height:fit-content}
        .btn-back{display:inline-block;padding:.7rem 1rem;background:var(--accent);color:#07131a;border-radius:8px;text-decoration:none;font-weight:700}
        @media(max-width:900px){.wrap{grid-template-columns:1fr}.sidebar{order:2}}
    </style>
</head>
<body>
    <div class='wrap'>
        <div>
            <h1>Produtos</h1>
            <div class='grid'>
                <?php if (empty($products)): ?>
                    <div class='tile'>Nenhum produto cadastrado</div>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class='tile'>
                            <h3><?= htmlspecialchars($product['name'] ?? '') ?></h3>
                            <div class='price'>R$ <?= number_format((float)($product['price'] ?? 0), 2, ',', '.') ?></div>
                        </div>
                    <?php endforeach?>
                <?php endif?>
            </div>
        </div>
        <aside class='sidebar'>
            <h2>Controles</h2>
            <p class='summary'>Total: <strong><?= count($products) ?></strong></p>
            <p><a href='index.php' class='btn-back'>Voltar</a></p>
        </aside>
    </div>
</body>
</html>
