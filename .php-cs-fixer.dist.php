<?php

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = (new PhpCsFixer\Finder())->in(__DIR__ . '/src');

return (new PhpCsFixer\Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRules([
        '@PER-CS' => true,
        'protected_to_private' => true,
    ])
    ->setFinder($finder);
