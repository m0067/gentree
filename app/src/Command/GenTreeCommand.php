<?php

declare(strict_types=1);

namespace App\Command;

use App\Repository\InMemoryTreeRepository;
use App\Service\GenTreeService;

class GenTreeCommand implements CommandInterface
{
    public static function getName(): string
    {
        return 'gen-tree';
    }

    public function execute(array $params): void
    {
        $genTree = new GenTreeService(new InMemoryTreeRepository());
        $genTree->generate($params[0], $params[1]);

        echo 'Done!' . PHP_EOL;
    }
}
