<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/lib',
        __DIR__ . '/test',
    ])
    // Don't touch generated/auxiliary files that aren't real source.
    ->withSkip([
        __DIR__ . '/vendor',
        __DIR__ . '/build',
        __DIR__ . '/docs',
    ])
    // Min supported runtime is PHP 8.0 (see composer.json) — do not emit newer syntax.
    ->withPhpSets(php80: true)
    ->withSets([
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
        LevelSetList::UP_TO_PHP_80,
    ])
    ->withImportNames(importShortClasses: false);
