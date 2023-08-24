<?php

declare(strict_types=1);

namespace Optimacros\Command;

interface CommandInterface
{
    public static function getName(): string;

    public function execute(): void;
}
