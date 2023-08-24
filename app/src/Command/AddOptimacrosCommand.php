<?php

declare(strict_types=1);

namespace Optimacros\Command;

class AddOptimacrosCommand implements CommandInterface
{
    public static function getName(): string
    {
        return 'add-optimacros';
    }

    public function execute(): void
    {
        echo \json_encode([], \JSON_UNESCAPED_UNICODE).PHP_EOL;
    }
}
