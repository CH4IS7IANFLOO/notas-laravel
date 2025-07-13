<?php

// Configuración para PHP CS Fixer
// Este archivo se usa en CI/CD pipeline
// Las dependencias se instalan automáticamente en GitHub Actions

return (new \PhpCsFixer\Config())
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
    ])
    ->setFinder(
        \PhpCsFixer\Finder::create()
            ->in(['app', 'config', 'database', 'routes', 'tests'])
            ->name('*.php')
            ->notName('*.blade.php')
    ); 