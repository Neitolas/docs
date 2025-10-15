<?php
$loader = require __DIR__ . '/../vendor/autoload.php';
var_export([$loader instanceof \Composer\Autoload\ClassLoader, class_exists('App\\Infra\\FileProductRepository', true), interface_exists('App\\Contracts\\ProductRepository', true)]);
