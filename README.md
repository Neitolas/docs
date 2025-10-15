projeto_srp — pequena demo SRP (PHP)

Resumo rápido

Este repositório contém uma pequena aplicação PHP (sem framework) que demonstra princípios de separação de responsabilidades (SRP):

- Repositório de produtos: `src/Infra/FileProductRepository.php` (armazena em JSON em `storage/products.json`).
- Serviço de aplicação: `src/Application/ProductService.php` (validação + persistência).
- Validador: `src/Domain/SimpleProductValidator.php`.
- Páginas públicas: `public/index.php` (form), `public/create.php` (resultado), `public/products.php` (lista).

Como executar localmente

Pré-requisitos:

- PHP 8+
- Servidor web (XAMPP, Apache, Nginx) ou usar CLI para testes rápidos

1. Coloque o diretório do projeto no DocumentRoot do seu servidor (ex: /opt/lampp/htdocs/projeto_srp).
2. Abra no navegador:
   - Formulário: http://localhost/projeto_srp/public/index.php
   - Lista: http://localhost/projeto_srp/public/products.php

Comandos úteis (CLI)

- Regenerar autoload do Composer (se alterar `composer.json`):

  composer dump-autoload -o

- Verificar sintaxe de arquivos PHP:

  php -l public/index.php

- Teste rápido via CLI para criar produto (exemplo):

  php -r "require 'vendor/autoload.php'; $repo=new \App\Infra\FileProductRepository('storage/products.json'); $service=new \App\Application\ProductService($repo, new \App\Domain\SimpleProductValidator()); $service->create(['name'=>'Teste','price'=>12.5]); print_r($service->listProducts());"
