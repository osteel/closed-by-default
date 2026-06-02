<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\SafeDeclareStrictTypesRector;

return RectorConfig::configure()
    ->withPaths([__DIR__.'/src'])
    ->withSets([
        SetList::TYPE_DECLARATION,
        LevelSetList::UP_TO_PHP_85,
    ])
    ->withRules([
        SafeDeclareStrictTypesRector::class,
    ]);
