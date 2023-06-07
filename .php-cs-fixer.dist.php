<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('config')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony'  => true,
        '@PSR12'    => true,
    ])
    ->setFinder($finder)
;
