<?php

use PhpCsFixer\Config;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->exclude('var')
;

return (new Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setCacheFile('var/cache/.php-cs-fixer.cache')
    ->setFinder($finder)
;
