<?php
declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products SRP DEMO</title>
    <style>
        :root{
            --bg: #0f1724;
            --card: #0ea5a4;
            --accent: #f97316;
            --muted: #a3a3a3;
        }
        *{box-sizing:border-box}
        body {
            font-family: Inter, system-ui, Arial, sans-serif;
            background: radial-gradient(circle at 20% 10%, #082032 0%, var(--bg) 40%);
            color:#f8fafc;
            margin: 0;
            min-height:100vh;
            display:flex;
            align-items:stretch;
        }
        .sidebar{
            width:320px;
            background:linear-gradient(180deg,var(--card),#057d79);
            padding:2rem;
            display:flex;
            flex-direction:column;
            gap:1rem;
            align-items:flex-start;
            justify-content:center;
        }
        .brand{font-size:1.6rem;font-weight:700;color:#071a1a}
        .content{flex:1;display:flex;align-items:center;justify-content:center;padding:3rem}
        .form-wrap{background:#07131a;padding:2rem;border-radius:12px;width:420px;box-shadow:0 10px 40px rgba(2,6,23,0.6)}
        .form-wrap h1{margin:0 0 1rem;color:var(--card)}
        label{font-size:0.9rem;color:var(--muted);display:block;margin-top:0.8rem}
        input{width:100%;padding:0.75rem;border-radius:8px;border:1px solid rgba(255,255,255,0.06);background:transparent;color:#fff}
        button{margin-top:1rem;padding:0.9rem 1.2rem;border-radius:10px;border:none;background:var(--accent);color:#07131a;font-weight:700;cursor:pointer}
        footer{position:fixed;right:18px;bottom:18px;color:var(--muted);font-size:0.85rem}
        @media(max-width:800px){.sidebar{display:none}.form-wrap{width:100%}}
    </style>
</head>
<body>
    <form action="create.php" method="POST">
        <h1>Cadastro de Produto</h1>
        <label>Nome</label>
        <input name="name" required>
        <label>Preço</label>
        <input name="price" type="number" step="0.01" required>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
