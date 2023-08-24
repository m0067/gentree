<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TreeNode;

interface TreeRepositoryInterface
{
    public function save(string $id, TreeNode $data): bool;

    public function find(string $id): ?TreeNode;

    /**
     * @return TreeNode[]
     */
    public function findAllRoot(): array;
}
